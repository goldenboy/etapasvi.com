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
  public static function clearCacheByPath($path = '', $all_cultures = true)
  {
  	$result = array();
  	
	// предварительная обработка пути
	$path 		= str_replace('..', '', $path);
	$parse_url  = parse_url($path);
	$path 		= $parse_url['path'];				
	
	if ($all_cultures ) {
		// удаляем для всех языков
		$culture_list = UserPeer::getCultures();
		$path 		= '/sf_culture/' . substr($path, 4, strlen($path));		
	} else {
		$culture_list = array('fake');
	}
	
	$full_path =  self::getCacheDir().'/'.$path;
	$full_path = preg_replace("/\/+/", '/', $full_path);
	
	foreach ($culture_list as $culture ) { 		
		$path_translated = str_replace('sf_culture', $culture, $full_path);
 					
		if (substr($path_translated, strlen($path_translated)-1, 1) == '*') {
			// удаляем по маске
			self::removeCacheFile( $path_translated );
			$result[] = $path_translated;			
		} else {  				
			// удаляем отдельный файл
 			self::removeCacheFile( $path_translated . self::CACHE_FILE_EXT );
			$result[] = $path_translated . self::CACHE_FILE_EXT;		
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
  public static function cacheUrl($url, $console = false)
  {
    if (!$url) {
    	return false;
    }  	
    
    if ($console) {
      // обращение через консоль
      // баг - в переключателе языка http://www.etapasvi.com/ru/frontfrontend.php/
      $path_info = parse_url($url);
      $html = shell_exec('php ' . $_SERVER['PWD'] . '/www/frontfrontend.php ' . $path_info['path']);
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
   * Получение директории, где хранится кэш
   *
   */
  public static function getCacheDir()
  {
	$cacheDir = sfConfig::get('sf_web_dir').'/cache';
	
	return $cacheDir;
  }
  
  /**
   * Получение информации об объёме кэша на диске
   *
   */
  public static function getInfo()
  {
  	$cacheDir = self::getCacheDir();
  	
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
    $url = str_replace(self::CACHE_FILE_EXT, '', str_replace($cacheDir, '', $file_path));
    if (!$relative) {
    	$url = UserPeer::SITE_PROTOCOL . '://' . UserPeer::SITE_ADDRESS . $url;
    }
    return $url;
  } 
   
  
  /**
   * Обновление кэша: удаление файлов кэша и открытие страниц сайта, чтобы создался новый файл
   * @todo сделать защёлку
   *
   * @return unknown
   */
  public static function refreshCache($multi_process = false, $threads_count = self::REFRESH_CACHE_THREADS_COUNT)
  {  	
  	$result = array(
  	  // в многопоточном режиме не подсчитывается
  	  //'files' => 0,
  	  'error' => ''
  	);  	
  	
  	$cacheDir = self::getCacheDir();
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
  	$log_name = self::refreshCacheGetLogPath();
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
      	  self::refreshCacheFile($file_path);
          
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
          self::refreshCacheFile($file_path);
          exit(self::REFRESH_CACHE_EXIT_STATUS_OK);
        }
  	  } else {
  	    
        // кэширование файла кэша
      	$refresh_result = self::refreshCacheFile($file_path);      	  
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
  public static function refreshCacheFile($file_path)
  {
    // удаление файла кэша
    $remove_result = self::removeCacheFile($file_path);

    if ($remove_result) {
      // кэширование страницы
      $cache_result = self::cacheUrl( self::fileToUrl($file_path), true );
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
   */
  public static function runRefreshCacheTask()
  {
  	// если уже идёт обновление кэша, выходим
  	if (count(self::listRefreshProcesses())) {
  	  return;
  	}
  	
  	$command = 'cd ' . sfConfig::get('sf_root_dir') . ' && ' . self::getRefreshCacheTaskCommand() . ' > /dev/null 2>&1 &';
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
  
  
}
