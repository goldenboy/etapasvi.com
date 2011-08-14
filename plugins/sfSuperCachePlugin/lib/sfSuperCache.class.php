<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// без этого не вызывается refreshCacheChildSignalHandler
declare(ticks=1);

/**
 * sfSuperCache base class.
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfSuperCache.class.php 8446 2008-04-14 14:31:09Z fabien $
 */
class sfSuperCache
{
    
  // расширение файла кэша    
  const CACHE_FILE_EXT = 'i.html';    
  
  // строка запуска PHP
  const PHP_RUN_COMMAND = '/usr/local/bin/php-5.3 -c /etc/php53/php.ini';    
  
  // количество потоков для обновления кэша при обновлении кэша в многопоточном режиме
  const REFRESH_CACHE_THREADS_COUNT = 5;    
  
  // коды возврата при обновлении кэша в многопоточном режиме
  const REFRESH_CACHE_EXIT_STATUS_OK    = 0;    
  const REFRESH_CACHE_EXIT_STATUS_ERROR = 1;    

  // список процессов при обновлении кэша в многопоточном режиме
  private static $refersh_cache_process_list = array();
  // очередь сигналов при обновлении кэша в многопоточном режиме
  private static $refersh_cache_queue        = array();
  
    
  /**
   * Clears the super cache by listening to the task.cache.clear event.
   *
   * @param sfEvent An sfEvent instance
   */
  static public function clearCacheFull(sfEvent $event)
  {
    $config = sfFilterConfigHandler::getConfiguration($event['app']->getConfigPaths('config/filters.yml'));

    $event->getSubject()->logSection('cache', 'Clearing super cache');

    // find super cache configuration
    $found = false;
    $cacheDir = 'cache';
    foreach ($config as $value)
    {
      if ('sfSuperCacheFilter' == $value['class'])
      {
        $found = true;
        if (isset($value['param']['cache_dir']))
        {
          $cacheDir = $value['param']['cache_dir'];
        }

        break;
      }
    }

    if ($found)
    {
      // clear the cache
      $cacheDir = sfConfig::get('sf_web_dir').'/'.$cacheDir;
      if (is_dir($cacheDir))
      {
        // remove cache files
        //$event->getSubject()->getFilesystem()->remove(sfFinder::type('file')->ignore_version_control()->discard('.sf')->in($cacheDir));
      }
    }
  }
   
  /**
   * Очистка кэша по пути:
   * *
   * http://www.etapasvi.com/ru/
   * http://www.etapasvi.com/ru/photo/show/id/586/title/*
   * /en/text/disqusembed
   *
   * @param unknown_type $request
   */
  public static function clearCacheByPath($path = '', $all_cultures = true, $all_domains = true)
  {
  	$result = array();  		
	
	// заменяем язык в пути на sf_culture
	if ($all_cultures ) {
	  // удаляем для всех языков
	  $culture_list = UserPeer::getCultures();	  
	} else {
	  $culture_list = array('fake');
	}
	
	foreach ($culture_list as $culture ) { 		
	  if ($all_domains) {
	  	// очищаем кэш для каждого домена
	  	foreach (UserPeer::$domain_name_list as $domain_name) {
	  	  // получаем путь на диске к файлу кэша
	  	  $path_translated 		= self::urlToFile($path, $domain_name);
	  	  if ($all_cultures) {
	  	    // подменяем язык в пути к файлу кэша на нужный
  	  	    //$path_translated 		= preg_replace("/\/[^\/]+\//", '/'.$culture.'/', $path); 
	  	    $path_translated 		= preg_replace(
	  	      "/" . strtr(self::getCacheDir().'/'.$domain_name."/", array('/'=>'\/', '.'=>'\.'))."[^\/]+\//", 
 	  	      self::getCacheDir().'/'.$domain_name."/".$culture.'/', 
	  	      $path_translated
	  	    ); 
	  	  }
	  	  
          self::removeCacheFile( $path_translated );
          $result[] = $path_translated;	
	  	}
	  } else {
	  	// получаем путь на диске к файлу кэша
	  	$path_translated 				= self::urlToFile($path);
	  	self::removeCacheFile( $path_translated );
	  	$result[] = $path_translated;	
	  }	  
	}
	return $result;
  }
  
  /**
   * Удаление файла кэша. Поддерживает маски
   *
   * @param unknown_type $file_path
   * @return unknown
   */
  public static function removeCacheFile($file_path)
  {
  	if (!$file_path) {  		
  	  return false;
  	}
  	shell_exec('rm -rf ' . $file_path); 
  	return true;
  }
  
  /**
   * Кэширование страницы
   *
   * @param string $url адрес страницы
   * @param bool $console выполнять обращение не через браузер, а через консоль
   * @return bool результат обновления кэша
   */
  public static function cacheUrl($url, $console = true)
  {
    if (!$url) {
    	return false;
    }  	
    
    if ($console) {
      // обращение через консоль
      $path_info = parse_url($url);
      //$html = shell_exec('php ' . $_SERVER['PWD'] . '/www/frontend_prodprod.php ' . $path_info['path']);
      $html = shell_exec(
        self::PHP_RUN_COMMAND . ' ' . sfConfig::get('sf_web_dir') . '/' . UserPeer::getApplicationScript(self::getDomainHameFromPath($url)) . ' ' . $path_info['path']
      );
    } else {
      // обращение через браузер
      $ch = curl_init();

      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
      curl_setopt($ch, CURLOPT_TIMEOUT, 10);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
      // не получаем тело ответа
      // не сработало
      //curl_setopt($ch, CURLOPT_NOBODY, true);	

      $html = curl_exec($ch);

      curl_close($ch);      
    }
	
    if ($html) {
  	  return true;
    } else {
  	  return false;
    }
  }
  
  /**
   * Получение директории, где хранится кэш.
   * 
   * @param string $domain_name домен, для которого выполняется подсчёт
   *
   */
  public static function getCacheDir($domain_name = '')
  {
	$cacheDir = sfConfig::get('sf_web_dir').'/cache';
	
	if ($domain_name) {
		$cacheDir .= '/' . $domain_name;
	}
	
	return $cacheDir;
  }
  
  /**
   * Получение информации об объёме кэша на диске
   *
   */
  public static function getInfo($domain_name = '')
  {
  	$cacheDir = self::getCacheDir($domain_name);  	
  	
  	// объём кэша на диске
  	// [vaduz]$ du -ch /home/saynt2day20/etapasvi.com/www/cache | grep total
	// 20M     total
  	$size = shell_exec('du -ch ' . $cacheDir . ' | grep total');
  	
  	// количество файлов (минус .htaccess)
	// [vaduz]$ find /home/saynt2day20/etapasvi.com/www/cache -type f | wc -l
	// 15
  	$files = shell_exec('find ' . $cacheDir . '  -type f | wc -l') - 1;

  	return array(
	  'size'  => $size,
	  'files' => $files
  	);
  }
  
  /**
   * Получение адреса страницы для файла кэша
   *
   * @param string $file_path путь к файлу на диске
   * @return string адрес страницы
   */
  public static function fileToUrl($file_path, $relative = false)
  {
    $cacheDir = self::getCacheDir();
    if (!strstr($file_path, $cacheDir)) {
      return '';
    }
    
    // получаем домен из пути
    $domain_name = self::getDomainHameFromPath($file_path);
    
    $url = str_replace(self::CACHE_FILE_EXT, '', str_replace($cacheDir . '/' . $domain_name, '', $file_path));
    
    if (!$relative) {
    	$url = sfConfig::get('app_protocol'). '://' . $domain_name . $url;
    }
    return $url;
  } 
  
  /**
   * Получение пути к файлу кэша по URL.
   * Если в URL передана *, возвращается путь со *, иначе возвращается прямой путь к файлу
   *
   * @param unknown_type $url
   */
  public static function urlToFile($url, $domain = UserPeer::DOMAIN_NAME_MAIN)
  {  	
  	// предварительная обработка пути
	$path 		= str_replace('..', '', $url);
	$parse_url  = parse_url($path);
	$path 		= $parse_url['path'];

	// получаем полный путь на диске
	if ($domain) {
	  $path = self::getCacheDir().'/'.$domain.'/'.$path;
	} else {
	  $path = self::getCacheDir().'/'.$parse_url['host'].'/'.$path;
	}
	// несколько слэшей земеняем на один
	$path = preg_replace("/\/+/", '/', $path);
	
	// если в URL передана *, возвращается путь со *
	// иначе возвращается прямой путь к файлу
	if (substr($path, strlen($path)-1, 1) != '*') {	
	  $path = $path . self::CACHE_FILE_EXT;		
	}		
	return $path;
  }
   
  
  /**
   * Обновление кэша: удаление файлов кэша и открытие страниц сайта, чтобы создался новый файл
   * @todo сделать защёлку
   *
   * @param unknown_type $multi_process мультипроцессорный режим
   * @param unknown_type $threads_count кол-во потоков в мультипроцессорном режиме
   * @param unknown_type $domain_name доменное имя, для которого очищается кэш
   * @param unknown_type $console запускать открытие страницы через консоль
   * @return unknown
   */
  public static function refreshCache($multi_process = false, $threads_count = self::REFRESH_CACHE_THREADS_COUNT, $domain_name = '', $console = true)
  { 
  	// максимальное время работы скрипта - сутки 	
  	ini_set('max_execution_time', 60*60*24);
  	
  	$result = array(
  	  // в многопоточном режиме не подсчитывается
  	  //'files' => 0,
  	  'error' => ''
  	);  	
  	
  	$cacheDir = self::getCacheDir($domain_name);
  	if (!$cacheDir) {
  	    return $result;
  	}
  	
  	// получение списка файлов кэша
  	$command = 'find ' . $cacheDir . '  -type f -name "*' . self::CACHE_FILE_EXT . '"';
  	$file_list_str = shell_exec($command);  	  	

  	$file_list = explode("\n", $file_list_str);  	
  	
  	if ($multi_process) {
  	  pcntl_signal(SIGCHLD, array(__CLASS__, "refreshCacheChildSignalHandler"));
  	}
  	
  	// лог
  	$log_name   = self::refreshCacheGetLogPath();
  	$log_handle = fopen($log_name, "w+");
  	
  	// удаление и создание кэша страниц  	  	
  	foreach ($file_list as $file_path) {

  	  if ($multi_process) {
        // ожидание, пока количество процессов уменьшится и можно будет создать новый
        while(count(self::$refersh_cache_process_list) >= $threads_count){    
          sleep(1);
        }

        $pid = pcntl_fork();
        // генерация ID задачи
        $job_id = rand(2000, 10000000000000);
                
        if ($pid == -1) {
          // Ошибка при запуске процесса   
          $result['error'] = 'Ошибка при запуске процесса';
          
          // кэширование файла кэша в основном процессе
      	  self::refreshCacheFile($file_path, $console);
          
          exit(self::REFRESH_CACHE_EXIT_STATUS_ERROR);
        } else if ($pid){
          // Родительский процесс
          // добавляем процесс в список
          self::$refersh_cache_process_list[$pid] = $job_id;
        
          // In the event that a signal for this pid was caught before we get here, it will be in our signalQueue array
          // So let's go ahead and process it now as if we'd just received the signal
          if (isset(self::$refersh_cache_queue[$pid])){
            self::refreshCacheChildSignalHandler(SIGCHLD, $pid, self::$refersh_cache_queue[$pid]);
            unset(self::$refersh_cache_queue[$pid]);
          }
        } else {
          // кэширование файла кэша
          self::refreshCacheFile($file_path, $console);
          exit(self::REFRESH_CACHE_EXIT_STATUS_OK);
        }
  	  } else {
  	    
        // кэширование файла кэша
      	$refresh_result = self::refreshCacheFile($file_path, $console);      	  
      	/*if ($refresh_result) {
    	  $result['files']++;
      	}*/
  	  }
  	  // пишем в лог
      fputs($log_handle, $file_path . "\r\n");
    }
    fclose($log_handle);
    
    // в многопоточном режиме ожидаем, пока все процессы закончат свою работу
    if ($multi_process) {
      while(count(self::$refersh_cache_process_list)){
        sleep(1);
      }
    }
  	 	
	return $result;
  }
  
  /**
   * Кэширование файла кэша
   *
   * @param string $file_path локальный путь к файлу
   * @return bool результат обновления файла кэша
   */
  public static function refreshCacheFile($file_path, $console = true)
  {
    // удаление файла кэша
    $remove_result = self::removeCacheFile($file_path);

    if ($remove_result) {
      // кэширование страницы
      $cache_result = self::cacheUrl( self::fileToUrl($file_path), $console );
      if ($cache_result) {
  	    return true;
      }
    }
    return false;
  }
  
  /**
   * Обработка сигналов дочерним поцессом обновления кэша
   *
   * @param unknown_type $signo
   * @param unknown_type $pid
   * @param unknown_type $status
   * @return unknown
   */
  public static function refreshCacheChildSignalHandler($signo, $pid = null, $status = null)
  {      
    // If no pid is provided, that means we're getting the signal from the system.  Let's figure out
    // which child process ended
    if (!$pid){
      $pid = pcntl_waitpid(-1, $status, WNOHANG);
    }
    
    //$log = file_get_contents('/home/saynt2day20/tmp/refresh_cache_signals.txt');
    //file_put_contents('/home/saynt2day20/tmp/refresh_cache_signals.txt', $log . "\r\nsigno=" . $signo . ', pid=' . $pid . ', status=' . $status );

    // Make sure we get all of the exited children
    while ($pid > 0) {
      if ($pid && isset(self::$refersh_cache_process_list[$pid])) {
        $exitCode = pcntl_wexitstatus($status);
        if ($exitCode != 0){
          //echo "$pid exited with status ".$exitCode."\n";
        }
        unset(self::$refersh_cache_process_list[$pid]);
      } elseif ($pid) {
        // Oh no, our job has finished before this parent process could even note that it had been launched!
        // Let's make note of it and handle it when the parent process is ready for it
        //echo "..... Adding $pid to the signal queue ..... \n";
        self::$refersh_cache_queue[$pid] = $status;
      }
      $pid = pcntl_waitpid(-1, $status, WNOHANG);
    }
    return true;
  }
  
  /**
   * Запуск задачи на обновления кэша в фоне
   *
   * @param string $domain_name доменное имя, кэш которого обновляется
   * @param bool $multi_process обновлять в многопоточном режиме
   * @param bool $console обращаться к страницам через консоль
   */
  public static function runRefreshCacheTask($domain_name = '', $multi_process = true, $console = true)
  {
  	// если уже идёт обновление кэша, выходим
  	if (count(self::listRefreshProcesses())) {
  	  return;
  	}
  	
  	if ($domain_name) {
  		$domain_name_param = ' --domain_name=' . $domain_name;
  	} else {
  		$domain_name_param = ' ';
  	}
  	
  	if ($multi_process) {
  		$multi_process_param = ' --multi_process=1';
  	} else {
  		$multi_process_param = ' --multi_process=0';
  	}
  	
  	if ($console) {
  		$console_param = ' --console=1';
  	} else {
  		$console_param = ' --console=0';
  	}
  	
  	$command = 'cd ' . sfConfig::get('sf_root_dir') . ' && ' 
  				. self::getRefreshCacheTaskCommand() 
  				. $domain_name_param 
  				. $multi_process_param
  				. $console_param
  				. ' > /dev/null 2>&1 &';

  	// запуск команды, не дожидаясь завершения
    pclose(popen($command, "r"));
  }
  
  /**
   * Остановка задачи, обновляющей кэш в фоне
   *
   * @param int $pid PID процесса
   */
  public static function stopRefershCacheTask($pid)
  {
  	if (!$pid) {
  	  return;
  	}
  	$command = 'kill -s 9 ' . $pid;
    pclose(popen($command, "r"));
  }
  
  /**
   * Получение команды на запуск обновления кэша
   *
   * @return unknown
   */
  public static function getRefreshCacheTaskCommand()
  {
  	return './symfony project:refreshcache';
  }
  
  /**
   * Получение списка процессов, обновляющих кэш
   *
   * @return unknown
   */
  public static function listRefreshProcesses()
  {
    $process_list = array();
    // команда для поиска команды, обновляющей кэш  
    $grep_command = 'grep "' . self::getRefreshCacheTaskCommand() . '"';
    
  	//ob_clean();
  	//ob_start();
  	
  	$process_list_str = shell_exec('ps aux | ' . $grep_command);
  	//ob_clean();
  	
    $process_list = explode("\n", $process_list_str);    
    
    // убираем из списка процессов ищущий процесс
  	foreach ($process_list as $k=>$v) {
	  if ( (strstr($v, self::getRefreshCacheTaskCommand()) && strstr($v, 'sh -c') || strstr($v, 'grep')) || !$v) {
		unset($process_list[$k]);
		continue;
	  }	  

      $process_info = explode(" ", $v);
      if ($process_info[1]) {
        $pid = $process_info[1];
      } else {
        $pid = $process_info[2];
      }	
      
      $process_list[ $k ] = array();
      
      // PID
      $process_list[ $k ][ 'pid' ] = $pid;
      // Done
      $process_list[ $k ][ 'done' ] = count(@file(self::refreshCacheGetLogPath($pid)));
  	}
  	
	return $process_list;
  }
  
  /**
   * Получение пути к логу обновления кэша.
   * Формат:
   * /tmp/refresh_cache_PID.log,
   * где PID - ID процесса
   *
   * @param unknown_type $pid
   * @return unknown
   */
  public static function refreshCacheGetLogPath($pid = '')
  {
  	if (!$pid) {
  	  $pid = getmypid();
  	}
  	return dirname( tempnam("dummy","") ) . '/refresh_cache_' . $pid . '.log';
  }
  
  /**
   * Получение доменного имени по пути к файлу кэша или адресу URL 
   */
  public static function getDomainHameFromPath($path)
  {
  	if (preg_match('/^http/', $path)) {
  	  // передан URL
  	  $parse_url = parse_url($path);
  	  return $parse_url['host'];
  	} else {
  	  // передан путь к кэшу на диске
  	  preg_match("/" . strtr(self::getCacheDir().'/', array('/'=>'\/', '.'=>'\.')) . "([^\/]+)\/.*/", $path, $matches);
  	  return $matches[1];
  	}
  }
  
  /**
   * Получение HTML страницы 404 из кэша
   */
  public static function getError404Content()
  {
    $cache_file_path = sfSuperCache::urlToFile( UserPeer::getError404Url(), sfConfig::get('app_domain_name') );
            
    if (!file_exists($cache_file_path)) {
    	return '';
    }
  	
  	// если 404 страница уже закэширована, получаем её из файла
  	$cache_file = file_get_contents($cache_file_path);  	  	
  	
  	// текущий путь, начинающийся со /
  	$cur_path = sfContext::getInstance()->getRequest()->getPathInfo();
  	
  	// lang_list
  	preg_match_all(
  	  "/\"((http:\/\/(?:" . sfConfig::get('app_domain_name_full') ."|" . sfConfig::get('app_domain_name_mobile') . ")\/[^\/\"]+\/)[^\"]+)\"/ism", 
	  preg_replace("/.*(<div.*id=\"lang_list\".*?<\/div>).*/ism", "$1", $cache_file), 
	  $matches);
	
	if ($matches[1] && $matches[2]) {
	  // текущий путь без языка
	  $cur_parh_without_lang = preg_replace("/\/[^\/]+\//", "", $cur_path);
	  foreach ($matches[1] as $i=>$match) {
	    $replacement[$match] = $matches[2][$i] . $cur_parh_without_lang;
	  }		  
	  $cache_file = strtr($cache_file, $replacement);
	}
	
	// footer
	// заменяем ссылки в переключателе языка и ссылке на мобильную версию
  	preg_match_all(
  	  "/\"((http:\/\/(?:" . sfConfig::get('app_domain_name_full') ."|" . sfConfig::get('app_domain_name_mobile') . "))\/[^\"]+)\"/ism", 
	  preg_replace("/.*(<div.*id=\"footer\".*?<\/div>).*/ism", "$1", $cache_file), 
	  $matches);
	if ($matches[1] && $matches[2]) {
	  foreach ($matches[1] as $i=>$match) {
	    $replacement[$match] = $matches[2][$i] . $cur_path;
	  }		  
	  $cache_file = strtr($cache_file, $replacement);
	}
	
	// Если мы находимся, например, в новостях http://www.etapasvi.com/ru/news/9555888, то title будет "Новости"
	// заменяем его на <title>Страница не найдена или не переведена - eTapasvi.com</title>
	$i18n       = sfContext::getInstance()->getI18N();
	$title      = $i18n->__('Page Not Found or Not Translated');	    
	$cache_file = preg_replace( "/<title>.*<\/title>/", "<title>" . $title . " - eTapasvi.com</title>", $cache_file);
	
	return $cache_file;
  }
  
  
}
