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
  const CACHE_FILE_EXT 		   = 'i.html';    
  // расширение файла кэша, помеченного удалённым
  const CACHE_FILE_DELETED_EXT = 'd.html';    
  
  // строка запуска PHP
  //const PHP_RUN_COMMAND = '/usr/local/bin/php-5.3 -c /etc/php53/php.ini';
  const PHP_RUN_COMMAND = '/usr/local/bin/php-5.3';    
  
  // количество потоков для обновления кэша при обновлении кэша в многопоточном режиме
  const REFRESH_CACHE_THREADS_COUNT = 5;    
  
  // коды возврата при обновлении кэша в многопоточном режиме
  const REFRESH_CACHE_EXIT_STATUS_OK    = 0;    
  const REFRESH_CACHE_EXIT_STATUS_ERROR = 1;    

  // список процессов при обновлении кэша в многопоточном режиме
  private static $refersh_cache_process_list = array();
  // очередь сигналов при обновлении кэша в многопоточном режиме
  private static $refersh_cache_queue        = array();
  
  // список команд на удаление кэша
  private static $remove_file_path_list        = array();
  
    
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
  public static function alterCacheByPath($delete = true, $path = '', $all_cultures = true, $all_domains = true, $only_remembed_remove_paths = true)
  {
    // максимальное время работы скрипта - сутки 	
  	ini_set('max_execution_time', 60*60*24);
  	
  	$path_translated_list = array();  		
	
	// заменяем язык в пути на sf_culture
	if ($all_cultures ) {
	  // удаляем для всех языков
	  $culture_list = UserPeer::getCultures();	  
	} else {
	  $culture_list = array('all');
	}
	
	// формирование списка путей
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
          $path_translated_list[] = $path_translated;	
	  	}
	  } else {
	  	// получаем путь на диске к файлу кэша
	  	$path_translated 				= self::urlToFile($path);

	  	$path_translated_list[] = $path_translated;	
	  }	  
	}
	
	// запуск удаления/восстановления файлов кэша
  	if ($delete) {
  	  // удаление
  	  if ($only_remembed_remove_paths) {
        self::addRemoveFilePathToList( $path_translated_list );
  	  } else {
  	    self::removeCacheFile( $path_translated_list );
  	  }
  	} else {
  	  // восстановление
  	  self::restoreCacheFile( $path_translated_list );
  	}
  	
	return $path_translated_list;
  }  
  
  /**
   * Удаление страниц кэша, которое необходимо выполнять при добавлении/изменении любого окнтента.
   *
   * @param unknown_type $culture язык
   * @return unknown список путей, по которым запущено удаление файлов
   */
  public static function clearCacheOnAnyContentChange($culture = 'all')
  {
  	$urls_for_clearing = array();
  	$path_translated_list = array();
  	
	$routing = UserPeer::getRouting();
	//$routing->generate('article', array('id' => $id));

  	// Главная страница
  	$urls_for_clearing[] = $routing->generate('main', array('sf_culture'=>$culture));  	
  	// Лента обновлений
  	$urls_for_clearing[] = $routing->generate('feed', array('sf_culture'=>$culture)) . '*';
  	// RSS
  	$urls_for_clearing[] = $routing->generate('news_rss', array('sf_culture'=>$culture)) . '*';
  	
  	if ($culture == 'all') {
  	  $all_cultures = true;
  	} else {
  	  $all_cultures = false;
  	}
	// удаление файлов кэша
  	foreach ($urls_for_clearing as $url) {
	  $path_translated_list = array_merge($path_translated_list, self::alterCacheByPath(true, $url, $all_cultures, true));
  	}
  	// запуск удаления запомненных путей
  	self::executRemoveFilePathListProcess();  	
  	return $path_translated_list;
  }
  
  /**
   * Удаление страниц элемента контента и страниц всех связанных с ним элементов.
   *
   * @param unknown_type $item_id
   * @param unknown_type $item_type
   * @param unknown_type $culture
   * @return unknown список путей, по которым запущено удаление файлов
   */
  public static function clearCacheOfItem($item_id, $item_type_name, $culture = 'all')
  {
  	$path_translated_list = array();
  	if (!$item_id || !$item_type_name) {
  	  return $path_translated_list;
  	}  	  	
  	// получаем URL элемента
  	$item = Item2itemPeer::getItem($item_type_name, $item_id);
  	if (!$item) {
  	  return $path_translated_list;
  	}

  	// получаем связанные элементы
  	$items   = Item2itemPeer::getAllRelatedObjects($item_type_name, $item_id);
  	// фото будет удалена вместе с фотографиями её альбома
  	if ($item_type_name != ItemtypesPeer::ITEM_TYPE_NAME_PHOTO) {
  	  $items[] = $item;
  	}

  	// получаем URL данного и связанных элементов
  	foreach ($items as $item_for_clearing) {
  	  try {
  	    $url = $item_for_clearing->getUrl(); 	       	      
  	    $urls_for_clearing[] = $url;
  	  } catch (Exception $e) {
  	  	echo $e->getMessage();
  	  }
  	}
  	
  	// удаление ряда страниц в зависимости от типа элемента
  	$routing = UserPeer::getRouting();
  	
  	// очищается список элементов
  	// для Photo порядок очистки особый
  	if ($item_type_name != ItemtypesPeer::ITEM_TYPE_NAME_PHOTO) {
	  $urls_for_clearing[] = $routing->generate(strtolower($item_type_name) . '_index', array('sf_culture'=>$culture)) . '*';
  	}
  	
  	// Новость
  	if ($item_type_name == ItemtypesPeer::ITEM_TYPE_NAME_NEWS) {
  	  // удаление страниц списка новостей в зависимости от типа данной новости
  	  $urls_for_clearing[] = $routing->generate(strtolower($item->getTypeName()) . '_index', array('sf_culture'=>$culture)) . '*';
  	}
  	// Фото
  	if ($item_type_name == ItemtypesPeer::ITEM_TYPE_NAME_PHOTO) {
  	  // очистка фотоальбома, которому принадлежит фото
  	  $photoalbum = $item->getPhotoalbum();

  	  // очищается фотоальбом
  	  $urls_for_clearing[] = $photoalbum->getUrl();
  	  // все фото в фотоальбоме
  	  $c = new Criteria();
  	  $c->add(PhotoPeer::PHOTOALBUM_ID, $photoalbum->getId());
  	  $photoalbum_photos = PhotoPeer::doSelect($c);
  	  foreach ($photoalbum_photos as $photo) {
  	  	$photo_url = sfRoute::urlRewriteCompress( $photo->getUrl(), true );
  	  	$urls_for_clearing[] = $photo_url;
  	  	// плюс ссылка на контент
  	  	// http://www.etapasvi.com/en/photo/content/1243  	  	
  	  	$urls_for_clearing[] = str_replace('/photo/', '/photo/content/', $photo_url);
  	  }
  	}
    
  	// Фотоальбом
  	if ($item_type_name == ItemtypesPeer::ITEM_TYPE_NAME_PHOTOALBUM) {
  	  // все фото в фотоальбоме
  	  $c = new Criteria();
  	  $c->add(PhotoPeer::PHOTOALBUM_ID, $item->getId());
  	  $photoalbum_photos = PhotoPeer::doSelect($c);
  	  foreach ($photoalbum_photos as $photo) {
  	  	$photo_url = sfRoute::urlRewriteCompress( $photo->getUrl(), true );
  	  	$urls_for_clearing[] = $photo_url;
  	  	// плюс ссылка на контент
  	  	// http://www.etapasvi.com/en/photo/content/1243  	  	
  	  	$urls_for_clearing[] = str_replace('/photo/', '/photo/content/', $photo_url);
  	  }
  	}
  	
  	if ($culture == 'all') {
  	  $all_cultures = true;
  	} else {
  	  $all_cultures = false;
  	}
  	
	// удаление файлов кэша
  	foreach ($urls_for_clearing as $url) {
	  // вручную удаляем всё, кроме пути
      $url_parts = parse_url($url);
      $url = preg_replace("/.*\.php(.*)/", "$1", $url_parts['path']);
      // вручную добавляем язык в начале
      if (!preg_match("/^\/{$culture}\/.*/", $url)) {
        $url = '/' . $culture . $url;  	    
      }
      // принудительно выполняется перезапись URL, т.к. для backend она отключена
      $url = sfRoute::urlRewriteCompress($url, true);
      
      // заменяем названия элементов на *
      // считаем, что первая цифра в URL - это первая цифра ID
      $url = preg_replace("/([^\d]+\/\d+).*/", "$1*", $url);
          
	  $path_translated_list = array_merge($path_translated_list, self::alterCacheByPath(true, $url, $all_cultures, true));
  	}
  	// запуск удаления запомненных путей
  	self::executRemoveFilePathListProcess();
  	return $path_translated_list;
  }
  
  /**
   * Добавление пути или путей для удаления кэша в список.
   *
   * @param unknown_type $file_path
   */
  public static function addRemoveFilePathToList($file_path)
  {
  	if (is_array($file_path)) {
  	  self::$remove_file_path_list = array_merge(self::$remove_file_path_list, $file_path);
  	} else {
  	  self::$remove_file_path_list[] = $file_path;
  	}
  }
  
  /**
   * Запуск удаления запомненных путей.
   *
   */
  public static function executRemoveFilePathListProcess()
  {
  	self::removeCacheFile(self::$remove_file_path_list);
  }
  
  /**
   * Удаление файла кэша - i.html заменяется на d.html
   * Поддерживает маски.
   * Также выполняет удаление кэша на бэкендах.
   *
   * @param unknown_type $file_path
   * @return unknown
   */
  public static function removeCacheFile($file_path, $all_backends = true)
  {
  	if (!$file_path) {
  	  return false;
  	}
  	 
  	// find /home/saynt2day20/etapasvi.com/www/cache/www.etapasvi.com/ru/photo/64* -name '*i.html' -type f -exec rename 's/i.html/d.html/' {} \;
  	if (is_array($file_path)) {
      	$command = "find " . implode(' ' , $file_path) . " -name '*".self::CACHE_FILE_EXT.
      	           "' -type f -exec rename -f 's/".self::CACHE_FILE_EXT."/".self::CACHE_FILE_DELETED_EXT."/' {} \;".
      	           " > /dev/null 2>&1 &";
      	$remote_command = "find " . implode(' ' , $file_path) . " -name '*".self::CACHE_FILE_EXT.
      	           "' -type f -exec rm -f {} \;".
      	           " > /dev/null 2>&1 &";
  	} else {
  	    $command = "find {$file_path} -name '*".self::CACHE_FILE_EXT.
      	           "' -type f -exec rename -f 's/".self::CACHE_FILE_EXT."/".self::CACHE_FILE_DELETED_EXT."/' {} \;".
      	           " > /dev/null 2>&1 &";
  	    $remote_command = "find {$file_path} -name '*".self::CACHE_FILE_EXT.
      	           "' -type f -exec rm -f {} \;".
      	           " > /dev/null 2>&1 &";
  	}

  	// страница браузера ждёт и скрипт обрывается через некоторое время
  	// запускаем обработку файлов отдельным процессом
  	pclose(popen($command, "r"));
  	//shell_exec($command); 
  	//shell_exec('rm -rf ' . $file_path); 
  	
  	// запуск удаления кэша на бэкендах
  	// Файлы кэша с бэкендов переносятся на основной через определённые промежутки (replicate_cache.sh). 
  	// При запуске удаления кэша в админке на основном бэкенде, 
  	// PHP инициирует удаление кэша на всех неосновных бэкендах. 
  	// При это удаление на неосновных бэкендах выполняется физически, а не переименование в d.html
  	if ($all_backends) {
	  	foreach (UserPeer::$backends as $backend) {
	  		// на самом себе не запускаем
	  		if (empty($backend['web_dir']) || empty($backend['user']) 
	  			|| empty($backend['host']) || $_SERVER['SERVER_ADDR'] == $backend['host']) {
	  			continue;
	  		}
	  		$command_backend = "ssh {$backend['user']}@{$backend['host']} \"" . 
	  							str_replace(sfConfig::get('sf_web_dir'), $backend['web_dir'], $remote_command) . "\"";		
	  		pclose(popen($command_backend, "r"));
	  	}
  	}
  	
  	return true;
  }
  
  /**
   * Удаление удалённого файла кэша
   *
   * @param unknown_type $file_path
   */
  public static function unlinkDeletedCacheFile($file_path)
  { 
    // если передан не удалённый файл кэша (d.html), а рабочий (i.html)
    if (!strstr($file_path, self::CACHE_FILE_DELETED_EXT)) {
        $file_path = str_replace(self::CACHE_FILE_EXT , self::CACHE_FILE_DELETED_EXT, $file_path);
    }
    
    // удаляем файл "d.html"
    return @unlink($file_path);
  }
  
  /**
   * Удаление файла кэша (i.html) с диска
   *
   * @param unknown_type $file_path
   */
  public static function unlinkCacheFile($file_path)
  { 
    // если передано неверное имя файла кэша (не i.html), выходим
    if (!strstr($file_path, self::CACHE_FILE_EXT)) {
      return false;
    }
    
    // удаляем файл "i.html"
    return @unlink($file_path);
  }
  
  /**
   * Восстановление файлов кэша - d.html заменяется на i.html
   * Поддерживает маски.
   *
   * @param unknown_type $file_path
   * @return unknown
   */
  public static function restoreCacheFile($file_path)
  {
  	if (!$file_path) {  		
  	  return false;
  	}
  	 
  	// find /home/saynt2day20/etapasvi.com/www/cache/www.etapasvi.com/ru/photo/64* -name '*i.html' -type f -exec rename 's/i.html/d.html/' {} \;
  	if (is_array($file_path)) {
      	$command = "find " . implode(' ' , $file_path) . " -name '*".self::CACHE_FILE_DELETED_EXT.
      	           "' -type f -exec rename 's/".self::CACHE_FILE_DELETED_EXT."/".self::CACHE_FILE_EXT."/' {} \;".
      	           " > /dev/null 2>&1 &";
  	} else {
  	    $command = "find {$file_path} -name '*".self::CACHE_FILE_DELETED_EXT.
      	           "' -type f -exec rename 's/".self::CACHE_FILE_DELETED_EXT."/".self::CACHE_FILE_EXT."/' {} \;".
      	           " > /dev/null 2>&1 &";
  	}
  	// страница браузера ждёт и скрипт обрывается через некоторое время
  	// запускаем обработку файлов отдельным процессом  	
  	pclose(popen($command, "r"));
  	//shell_exec($command); 
  	//shell_exec('rm -rf ' . $file_path); 
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
  public static function getInfo($domain_name = '', $path_filter = '')
  {
  	$cacheDir = self::getCacheDir($domain_name);  	
  	
  	// объём кэша на диске
  	// [vaduz]$ du -ch /home/saynt2day20/etapasvi.com/www/cache | grep total
	// 20M     total
  	$size = shell_exec('du -ch ' . $cacheDir . ' | grep total');
  	
  	// фильтр по имени файла
  	if (!empty($path_filter)) {
  	    $path_filter = '-path "' . $path_filter . '"';
  	} else {
  	    $path_filter = '';
  	}
  	
  	// количество файлов (минус .htaccess)
	// [vaduz]$ find /home/saynt2day20/etapasvi.com/www/cache -type f | wc -l
	// 15
	$files_command = 'find ' . $cacheDir . ' ' . $path_filter . ' -name \'*' . self::CACHE_FILE_EXT . '\' -type f | wc -l';
  	$files        = shell_exec($files_command); // - 1;
  	
  	// кол-во удалённых файлов
	$files_deleted_command = 'find ' . $cacheDir . ' ' . $path_filter . ' -name \'*' . self::CACHE_FILE_DELETED_EXT . '\' -type f | wc -l';

  	$files_deleted = shell_exec($files_deleted_command); // - 1;

  	return array(
	  'size'                   => $size,
	  'files'                  => $files,
	  'files_deleted'          => $files_deleted,
	  'command_files'          => $files_command,
	  'command_files_deleted'  => $files_deleted_command
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
  public static function urlToFile($url, $domain)
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
   * Обновляются файлы кэша, помеченные удалёнными (d.html).
   * Обновление кэша: удаление файлов кэша и открытие страниц сайта, при этом помеченный удалённым файл 
   * автоматически удаляется и создаётся обычный файл i.html
   *
   * @param unknown_type $multi_process мультипроцессорный режим
   * @param unknown_type $threads_count кол-во потоков в мультипроцессорном режиме
   * @param unknown_type $domain_name доменное имя, для которого очищается кэш
   * @param unknown_type $console запускать открытие страницы через консоль
   * @param unknown_type $exclude_path_regexp регулярное выражение, исключающее пути из обработки
   * @param unknown_type $include_path_regexp регулярное выражение, включающее пути в обработку
   * @return unknown
   */
  public static function refreshCache($multi_process = false, $threads_count = self::REFRESH_CACHE_THREADS_COUNT, $domain_name = '', $console = true, $exclude_path_regexp = '', $include_path_regexp = '')
  { 
  	// максимальное время работы скрипта - сутки 	
  	ini_set('max_execution_time', 60*60*24);
  
  	$result = array(
  	  // в многопоточном режиме не подсчитывается
  	  //'files' => 0,
  	  'error' => ''
  	);  
  	
  	$exclude_path_regexp = trim($exclude_path_regexp);
  	$include_path_regexp = trim($include_path_regexp);
  	$multi_process       = (bool)$multi_process; 	
  	
  	// лог
  	$log_name   = self::refreshCacheGetLogPath();
  	// если нет директории - создаём
  	if (!is_dir(dirname($log_name))) {
  		mkdir(dirname($log_name));
  	}
  	$log_handle = fopen($log_name, "w+");
  	
  	// получение пути к директории с кэшем
  	$cacheDir = self::getCacheDir($domain_name);
  	if (!$cacheDir) {
  	  $result['error'] = 'Не удалось пулучить путь к директории с кэшем';
  	  fputs($log_handle, 'error: ' . $result['error']);
  	  return $result;
  	}
  	
  	// проверка PID-файла
  	if (self::refreshCacheIsDaemonActive()) {
  	  // демон уже запущен
      $result['error'] = 'Процесс обновления кэша уже запущен';
      fputs($log_handle, 'error: ' . $result['error']);
      return $result;
  	} else {
      // процесса нет 
      if (file_exists(self::refreshCacheGetPidFilePath()) && !self::refreshCacheDeletePidFile()) {
        // не могу уничтожить pid-файл. ошибка
        $result['error'] = 'Невозможно удалить PID-файл ' . self::refreshCacheGetPidFilePath();
        fputs($log_handle, 'error: ' . $result['error']);
        return $result;
      }
  	}

    // запись PID в файл
    file_put_contents(self::refreshCacheGetPidFilePath(), getmypid());
    chmod(self::refreshCacheGetPidFilePath(), 0666);
  	
  	// получение списка файлов кэша (d.html)
  	$command = 'find ' . $cacheDir . '  -type f -name "*' . self::CACHE_FILE_DELETED_EXT . '"';
  	$file_list_str = shell_exec($command);  	  	

  	$file_list = explode("\n", $file_list_str);  	
  	
  	if ($multi_process) {
  	  pcntl_signal(SIGCHLD, array(__CLASS__, "refreshCacheChildSignalHandler"));
  	}  	
  	
  	fputs($log_handle, 
  		'date:' . date("Y-m-d H:i:s") . 
  		'; total:' . count($file_list) . 
  		'; multi_process:' . (int)$multi_process .
  		'; threads_count:' . (int)$threads_count .
  		'; domain_name:' . $domain_name .
  		'; console:' . (int)$console .
  		'; exclude_path_regexp:' . $exclude_path_regexp .
  		'; include_path_regexp:' . $include_path_regexp .
  		"\r\n"
  	);

  	// удаление и создание кэша страниц  	
  	foreach ($file_list as $file_index=>$file_path) {
  		
  	  // объект исключён
  	  if (!empty($exclude_path_regexp) && preg_match("/" . $exclude_path_regexp . "/", $file_path)) {
  	  	continue;
  	  }
  	  
  	  // обрабатываются только включённые объекты
  	  if (!empty($include_path_regexp) && !preg_match("/" . $include_path_regexp . "/", $file_path)) {
  	  	continue;
  	  }

  	  if ($multi_process) {
  	  	// многопоточный режим
  	  	
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
  	  	// однопоточный режим  
        // кэширование файла кэша

      	$refresh_result = self::refreshCacheFile($file_path, $console);
  	  }
  	  // пишем в лог
  	  $log_line = $file_index . ':' . $file_path . "\r\n";
  	  echo $log_line;
      fputs($log_handle, $log_line);
    }
    fclose($log_handle);
    
    // в многопоточном режиме ожидаем, пока все процессы закончат свою работу
    if ($multi_process) {
      while(count(self::$refersh_cache_process_list)){
        sleep(1);
      }
    }
    
    // удаление файла с PID
    self::refreshCacheDeletePidFile();
  	 	
	return $result;
  }
  
  /**
   * Получение пути к файлу с PID демона обновления кэша
   *
   * @return unknown
   */
  public static function refreshCacheGetPidFilePath()
  {
  	return sfConfig::get('sf_log_dir') . '/refresh_cache.pid';
  }
  
  /**
   * Проверка, запущен ли демон обновления кэша
   *
   * @return unknown
   */
  public static function refreshCacheIsDaemonActive()
  {  	
  	if (is_file(self::refreshCacheGetPidFilePath()) ) {
  	  try {
        $pid = file_get_contents(self::refreshCacheGetPidFilePath());
  	  } catch (Exception $e) {
  	  	return true;
  	  }
      // проверяем на наличие процесса
      if (posix_kill($pid,0)) {
        // демон уже запущен
        return true;
      } else {
        return false;
      }
    }
  }
  
  /**
   * Получение пути к файлу с PID демона обновления кэша
   *
   * @return unknown
   */
  public static function refreshCacheDeletePidFile()
  {
  	return @unlink(self::refreshCacheGetPidFilePath());
  }    
  
  /**
   * Кэширование файла кэша
   *
   * @param string $file_path локальный путь к файлу
   * @return bool результат обновления файла кэша
   */
  public static function refreshCacheFile($file_path, $console = true)
  {
    // если передан файл, помеченный удалённым (d.html), заменяем название обычным
    if (strstr($file_path, self::CACHE_FILE_DELETED_EXT)) {
        $file_path = str_replace(self::CACHE_FILE_DELETED_EXT , self::CACHE_FILE_EXT, $file_path);
    }
      
    // удаление файла кэша
    $remove_result = self::removeCacheFile($file_path, false);

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
    // обработка сигнала убийства
    /*if ($signo == SIGTERM) {
        exit();
    }*/
      
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
   * @param unknown_type $exclude_path_regexp регулярное выражение, исключающее пути из обработки
   * @param unknown_type $include_path_regexp регулярное выражение, включающее пути в обработку
   */
  public static function runRefreshCacheTask($domain_name = '', $multi_process, $console, $exclude_path_regexp = '', $include_path_regexp = '')
  {
  	// если уже идёт обновление кэша, выходим
  	if (self::refreshCacheIsDaemonActive()) {
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
  	
  	if ($exclude_path_regexp) {
  		$exclude_path_regexp_param = ' --exclude_path_regexp=' . base64_encode($exclude_path_regexp) . '';
  	} else {
  		$exclude_path_regexp_param = ' ';
  	}
  	
  	if ($include_path_regexp) {
  		$include_path_regexp_param = ' --include_path_regexp=' . base64_encode($include_path_regexp) . '';
  	} else {
  		$include_path_regexp_param = ' ';
  	}
  	
  	// Если запускать обновление по следующей схеме:
	// - runRefreshCacheTask
	// - popen запускает ./symfony project:refreshcache
	// то в процессах будет висеть " sh -c ... ./symfony project:refreshcache", который рано или поздно убивается
	// поэтому решено не запускать Таск симфони, а создавать дочерний процесс, который запустит функцию обновления кэша
	// http://bsds.etapasvi.com/issues/107
	
  	// cd /home/saynt2day20/etapasvi.com && 
  	// ./symfony project:refreshcache --multi_process=0 --console=1 --exclude_path_regexp=XC9waG90b1wvKD8hYWxidW0p 
  	// --include_path_regexp=XC9lblwvcGhvdG9cLzQwMA== > /dev/null 2>&1 &
  	$command = 'cd ' . sfConfig::get('sf_root_dir') . ' && ' 
  				. self::getRefreshCacheTaskCommand() 
  				. $domain_name_param 
  				. $multi_process_param
  				. $console_param
  				. $exclude_path_regexp_param
  				. $include_path_regexp_param
  				. ' > /dev/null 2>&1 &';  			
  	// запуск команды, не дожидаясь завершения
    pclose(popen($command, "r"));
    
    // не запускает таск
    //passthru("sh -c {$command}", $return_vat);
    
    // обработчик сигналов
    //pcntl_signal(SIGCHLD, array(__CLASS__, "refreshCacheChildSignalHandler"));
    /*
	$child_pid = pcntl_fork();

	if( !$child_pid ) {	   
	  // дальше идёт дочерний процесс, который запускает обновление кэша
      sfSuperCache::refreshCache(
        $multi_process, 
        sfSuperCache::REFRESH_CACHE_THREADS_COUNT, 
        $domain_name, 
        $console,
        $exclude_path_regexp,
        $include_path_regexp
      );
      exit();
	}*/
	
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
  /*
  public static function listRefreshProcesses()
  {
    $process_list = array();
    // команда для поиска команды, обновляющей кэш  
    $grep_command = 'grep "' . self::getRefreshCacheTaskCommand() . '"';

  	$process_list_str = shell_exec('ps aux | ' . $grep_command);
  	
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
      $process_list[ $k ][ 'done' ] = self::refreshCacheGetLogDone($pid);
  	}
  	
	return $process_list;
  }*/
  
  /**
   * Получение информации о демоне и прогрессе обновления лога
   *
   * @return unknown
   */
  public static function refreshCacheGetDaemonInfo()
  {
  	$daemon_info = array();
  	
  	if (!self::refreshCacheIsDaemonActive()) {
  	  return $daemon_info;
  	}
  	
  	if ( is_file(self::refreshCacheGetPidFilePath()) ) {
      $pid = file_get_contents(self::refreshCacheGetPidFilePath());
      // проверяем на наличие процесса
      if (posix_kill($pid,0)) {      	
      	$daemon_info = self::refreshCacheGetLogInfo($pid);
      } else {
        // pid-файл есть, но процесса нет         
      }
    }
        
	return $daemon_info;
  }
  
  /**
   * Получение кол-ва обработанных объектов по логу
   *
   * @param unknown_type $pid
   * @return unknown
   */
  public static function refreshCacheGetLogInfo($pid, $log_content = '')
  {
  	$log_info = array();
  	
  	if (!$pid) {
  	  return $log_info;
  	}
  	
    // 1-я строка со служебной информацией
    if (!$log_content) {
      $log_content = self::refreshCacheGetLogContent($pid);
    }
    
    // 1-я строка содержит служебную информацию
    // date: 2011-08-21 14:18:29; files: 21200; multi_process=0; threads_count=5; domain_name=; console=1; exclude_path_regexp=; include_path_regexp=
    $log_content_lines = explode("\r\n", $log_content);
    if (empty($log_content_lines[0])) {
      return $log_info;
    }
    $log_info_list = explode(";", $log_content_lines[0]);
    foreach ($log_info_list as $log_info_item) {
      $log_info_item_list = explode(':', $log_info_item);
      if (isset($log_info_item_list[0]) && isset($log_info_item_list[1])) {
        $log_info[ $log_info_item_list[0] ] = $log_info_item_list[1];	
      }
    }

    /*$log_info['date']   		      = $log_info_list['0'];
    $log_info['total']  		      = $log_info_list['1'];
    $log_info['multi_process']        = $log_info_list['2'];
    $log_info['threads_count']  	  = $log_info_list['3'];
    $log_info['domain_name']    	  = $log_info_list['4'];
    $log_info['console']        	  = $log_info_list['5'];
    $log_info['exclude_path_regexp']  = $log_info_list['6'];
    $log_info['include_path_regexp']  = $log_info_list['7'];*/
    $log_info['pid']    		      = $pid;
    $log_info['done'] 				  = abs(count($log_content_lines)  - 2); // 1-я строка со служебной информацией
    
    return $log_info;
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
  	//return dirname( tempnam("dummy","") ) . '/refresh_cache_' . $pid . '.log';
  	return sfConfig::get('sf_log_dir') . '/refresh_cache/refresh_cache_' . $pid . '.log';
  }
  
  /**
   * Получение информации из логов обновления кэша
   *
   * @param unknown_type $max максимальное кол-во обрабатываемых логов
   * @return unknown
   */
  public static function refreshCacheGetLogList($max = 5)
  {
    $log_list = array();
      
    // получаем список файлов
    // -rw-r--r-- 1 saynt2day20 pg2567308  28523 2011-06-15 13:37 /tmp/refresh_cache_4729.log
  	$log_files_row_info      = shell_exec('ls -lat ' . self::refreshCacheGetLogPath('*'));  	  	
  	$log_files_row_info_list = explode("\n", $log_files_row_info);  	  
  	
  	// вытаскиваем информацию о логах
  	foreach ($log_files_row_info_list as $log_files_row_info_index => $log_files_row_info_item) {
  	    
  	  if ($log_files_row_info_index >= $max) {
  	      break;
  	  }
  	  $matches = array();
  	  preg_match("/^(?:\S){10} \S+ \S+ \S+\s+(\d+) ([^\/]+) \/.*_(\d+)\.log/", $log_files_row_info_item, $matches);
  	    
  	  if (!empty($matches['1']) && !empty($matches['2']) && !empty($matches['3'])) {
        $log_list[] = self::refreshCacheGetLogInfo($matches['3']);
  	  }  	    
  	  
  	}

  	return $log_list;
  }
  
  /**
   * Получение содрежимого лога обновления кэша по PID
   *
   * @param unknown_type $pid ID главного процесса
   * @return unknown
   */
  public static function refreshCacheGetLogContent($pid)
  {
  	if (!$pid) {
  	  return '';
  	}
  	return file_get_contents(self::refreshCacheGetLogPath($pid));
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
  	  "/href=\"((http:\/\/(?:" . sfConfig::get('app_domain_name_full') ."|" . sfConfig::get('app_domain_name_mobile') . ")\/[^\/\"]+\/)[^\"]+)\"/ism", 
	  preg_replace("/.*(<div.*id=\"(?:lang_list|culture_list)\".*?<\/div>).*/ism", "$1", $cache_file), 
	  $matches);
	
	if (!empty($matches[1]) && !empty($matches[2])) {
	  // текущий путь без языка
	  $cur_parh_without_lang = preg_replace("/^\/[^\/]+\//", "", $cur_path);
	  foreach ($matches[1] as $i=>$match) {
	    $replacement[$match] = $matches[2][$i] . $cur_parh_without_lang;
	  }		  
	  $cache_file = strtr($cache_file, $replacement);
	}
	
	// footer
	// заменяем ссылки в переключателе языка и ссылке на мобильную версию
	if ( sfContext::getInstance()->getConfiguration()->getEnvironment() == 'mobile' ) {
	  // мобильная версия
	  preg_match_all(
  	    "/\"((http:\/\/(?:" . sfConfig::get('app_domain_name_full') ."|" . sfConfig::get('app_domain_name_mobile') . "))\/[^\"]+)\"/ism", 	
	    preg_replace("/.*(Copyright &copy;.*?_trackPageview).*/ism", "$1", $cache_file), 
	    $matches
	  );
	} else {
	  // полная версия
	  preg_match_all(
  	    "/\"((http:\/\/(?:" . sfConfig::get('app_domain_name_full') ."|" . sfConfig::get('app_domain_name_mobile') . "))\/[^\"]+)\"/ism", 	
	    preg_replace("/.*(<div.*id=\"footer\".*?(bubble_click)).*/ism", "$1", $cache_file), 
	    $matches
	  );
	}
  	
	if (!empty($matches[1]) && !empty($matches[2])) {
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
  
  /**
   * Показать ошибку 404 из кэша
   *
   */
  public static function showError404()
  {
    // http://bsds.etapasvi.com/issues/65
    // получаем файл 404 ошибки из кэша
    $cache_file_content = sfSuperCache::getError404Content();
      
    // удаляем файл d.html со всех доменов, чтобы они не накапливались, когда страница перестаёт существовать
    $cache_file = sfSuperCache::urlToFile(sfContext::getInstance()->getRequest()->getUri(), sfConfig::get('app_domain_name'));

    sfSuperCache::unlinkDeletedCacheFile( $cache_file );
    //sfSuperCache::unlinkCacheFile( $cache_file );
       
    if ($cache_file_content) {      	
      $response = sfContext::getInstance()->getResponse();
      $response->setStatusCode(404);
      $response->setContent($cache_file_content);
      $response->send();
      exit;
    } else {
      return false;
    }
  }
  
  
}
