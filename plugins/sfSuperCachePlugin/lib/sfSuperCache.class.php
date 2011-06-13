<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
   * @param unknown_type $url
   * @return unknown
   */
  public static function cacheUrl($url)
  {
    if (!$url) {
    	return false;
    }
  	
	$ch = curl_init();
	
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
	// не получаем тело ответа
	//curl_setopt($ch, CURLOPT_NOBODY, true);	
	
	curl_exec($ch);
	
	curl_close($ch);
	
	return true;
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
  public static function fileToUrl($file_path)
  {
    $cacheDir = self::getCacheDir();
    if (!strstr($file_path, $cacheDir)) {
      return '';
    }
    return UserPeer::SITE_PROTOCOL . '://' . UserPeer::SITE_ADDRESS . str_replace(self::CACHE_FILE_EXT, '', str_replace($cacheDir, '', $file_path));
  } 
   
  
  /**
   * Обновление кэша: удаление файлов кэша и открытие страниц сайта, чтобы создался новый файл
   * @todo сделать защёлку
   *
   * @return unknown
   */
  public static function refreshCache()
  {
  	
  	$result = array(
  	  'files' => 0
  	);  	
  	
  	$cacheDir = self::getCacheDir();
  	if (!$cacheDir) {
  	    return $result;
  	}
  	
  	// получение списка файлов кэша
  	$command = 'find ' . $cacheDir . '  -type f -name "*' . self::CACHE_FILE_EXT . '"';
  	$file_list_str = shell_exec($command);  	  	

  	$file_list = explode("\n", $file_list_str);  	
  	
  	// удаление и создание кэша страниц
  	foreach ($file_list as $file_path) {

  	  // проверка расширения файла
  	  $remove_result = self::removeCacheFile($file_path);
  	  
  	  if ($remove_result) {
	  	  // кэширование страницы
	  	  $cache_result = self::cacheUrl( self::fileToUrl($file_path) );
	  	  if ($cache_result) {
	  	  	$result['files']++;
	  	  }
  	  }
    }
  	 	
	return $result;
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
	  if ( (strstr($v, self::getRefreshCacheTaskCommand()) && strstr($v, 'sh -c') || strstr($v, 'grep')) 
	  		|| !$v) {
		unset($process_list[$k]);
	  }
  	}
  	
	return $process_list;
  }
  
  
}
