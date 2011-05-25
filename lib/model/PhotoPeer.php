<?php

class PhotoPeer extends BasePhotoPeer
{
  const IMG_THUMB_WIDTH 		= 150;	
  const IMG_THUMB_HEIGHT 		= 150; 
  const IMG_PREVIEW_WIDTH 		= 500;	
  const IMG_PREVIEW_HEIGHT 		= 500;    
  const ITEMS_PER_PAGE 			= 10000; //12;
  const LATEST_COUNT 			= 3;
  
  const FULL_QUALITY    		= 100;
  const PREVIEW_QUALITY    		= 100;
  const THUMB_QUALITY    		= 100;  
  
  const PHOTO_DIR 			    = 'photo';
  
  // директории на сервере
  // и одновременно названия альбомов в удалённом хранилище
  const FULL_DIR 			    = 'photo';
  const PREVIEW_DIR 			= 'photo/preview';
  const THUMB_DIR 			    = 'photo/thumb';
  
  const ORIGINAL_DIR 			= 'photo/original';
  
  // Получить ID альбома: Албомы -> Каналы RSS (справа)
  static $dir_to_remote_storage_id = array(
  
  	PhotoPeer::FULL_DIR		 => '5578477663008447297',
  	PhotoPeer::PREVIEW_DIR	 => '5578477885599823617',
  	PhotoPeer::THUMB_DIR	 => '5578478022997420321',
  	
  	NewsPeer::FULL_DIR       => '5578758290556545217',
  	NewsPeer::THUMB_DIR      => '5578758340610983169'
  );
  
  const REMOTE_STORAGE_USERNAME = 'etapasvi';
  const REMOTE_STORAGE_URL      = 'http://lh3.ggpht.com/';
  
  public static $remote_storage;
  
  /**
   * Проверка есть ли контент на определённом языке
   *
   * @param unknown_type $item_id
   * @param unknown_type $item_lang
   */
  public static function hasCultureContent($item_id, $item_lang)
  {
    return true;
  }
  
  /**
   * Добавляет условие, при котором элемент отображается на языке пользователя
   *
   * @param unknown_type $c
   */
  public static function addVisibleCriteria($c)
  {  
    $c->add( PhotoPeer::SHOW, 1 );
    $c->add( PhotoPeer::IMG, '', Criteria::NOT_EQUAL );
    $c->add( PhotoPeer::FULL_PATH, '', Criteria::NOT_EQUAL );
    $c->add( PhotoPeer::PREVIEW_PATH, '', Criteria::NOT_EQUAL );
    $c->add( PhotoPeer::THUMB_PATH, '', Criteria::NOT_EQUAL );
  }
  
  /**
   * Для RSS: добавляет условие, при котором элемент отображается на языке пользователя
   *
   * @param unknown_type $c
   */
  public static function addRssVisibleCriteria($c)
  {  
    self::addVisibleCriteria($c);
    $c->add( PhotoI18nPeer::TITLE, '', Criteria::NOT_EQUAL );
  }
  
  /**
   * Преобразование директории в назание удалённого альбома
   *
   * @param unknown_type $dir
   * @return unknown
   */
  public static function dirToRemoteStorageAlbumName($dir)
  {  
    return str_replace('/', '_', $dir);
  }
  
  /**
   * Получение ID альбома удалённого хранилища по названию директории
   *
   * @param unknown_type $dir
   * @return unknown
   */
  public static function dirToRemoteStorageAlbumId($dir)
  {  
    return self::$dir_to_remote_storage_id[ $dir ];
  }
  
  /**
   * Оъект для работы с удалённым хранилищем
   *
   * @return unknown
   */
  public static function getRemoteStorage()
  {  
    if (!self::$remote_storage) {
      try {
      	// создание хранилища
        self::$remote_storage = new Picasa(null, Picasa::$AUTH_TYPE_AUTH_SUB);	

        // проверка авторизации в нём
        PhotoPeer::remoteStorageCheckAutenthication();
      } catch (Exception $e) {
      	return false;
      }
    }
    return self::$remote_storage;    
  }
  
  /**
   * Проверка, авторизрован ли пользователь в удалённом хранилище
   *
   * @return unknown
   */
  public static function remoteStorageCheckAutenthication()
  {  
  	try {
  	  PhotoPeer::getRemoteStorage()->authorizeFromCookie();
  	  if (PhotoPeer::getRemoteStorage()->isAuthenticated()) {
  	  	return true;
  	  } else {
  	  	// пробуем авторизоваться
  	  	if (!empty($_GET['token'])) {
  	  	  return (bool)PhotoPeer::autorizeInRemoteStorage();
  	    }
  	  }
    } catch (Exception $e) {
  	  return false;
    }
  }
  
  /**
   * Авторизация в удалённом хранилище
   *
   * @return unknown
   */
  public static function autorizeInRemoteStorage()
  {    	
  	try {
  	  return self::getRemoteStorage()->authorizeWithAuthSub();
    } catch (Exception $e) {
  	  return false;
    }
  }
  
  /**
   * Отправка изобажения в удалённое хранилище
   *
   * @param unknown_type $dir
   * @param unknown_type $local_path
   * @param unknown_type $mime_type
   * @param unknown_type $file_name
   * @param unknown_type $title
   * @return unknown
   */
  public static function remoteStoragePostImage($dir, $local_path, $mime_type, $file_name, $title)
  {    
  	$result = array(
  	  'url'   => '',
  	  'error' => ''
  	);
  	try {
  	  $image = PhotoPeer::getRemoteStorage()->postImage(
	  	PhotoPeer::REMOTE_STORAGE_USERNAME,
	  	PhotoPeer::dirToRemoteStorageAlbumId( $dir ),
	  	$local_path,
	  	$mime_type,
	  	$file_name,
	  	$title
	  );
	  if (!$image) {
	  	$result['error'] = true;
  	    return $result;
	  } else {
	  	$result['url'] = PhotoPeer::getPathFromRemoteStorageUrl( (string)$image->getContent() );
  	    return $result;
	  }
	  
    } catch (Exception $e) {
      $result['error'] = $e->getMessage();
  	  return $result;
    }
  }

  /**
   * Получение части пути к изображения по URL
   *
   * @param unknown_type $url
   * @return unknown
   */
  public static function getPathFromRemoteStorageUrl($url)
  {
  	$preg = strtr(PhotoPeer::REMOTE_STORAGE_URL, array(
  	  "/"=>"\/", "."=>"\.", "1"=>"[0-9]", "2"=>"[0-9]", "3"=>"[0-9]", "4"=>"[0-9]", "5"=>"[0-9]", "6"=>"[0-9]",
  	  "7"=>"[0-9]", "8"=>"[0-9]", "9"=>"[0-9]"
  	));
  	$url = preg_replace("/" . $preg . "/", '', $url);
  	$parts = preg_split("/\//", $url);
	unset($parts[ count($parts) - 1 ]);
	$url = implode($parts, "/");
  	
  	return $url;
  }
  
  /**
   * Получение адреса изображения в удалённом хранилище
   *
   * @param unknown_type $remote_path
   * @param unknown_type $file_name
   * @return unknown
   */
  public static function remoteStorageGetUrl($remote_path, $file_name)
  { 
  	return PhotoPeer::REMOTE_STORAGE_URL . $remote_path . '/' . $file_name;
  }
  
  /**
   * Премещение файла в указанную директорию
   *
   * @param unknown_type $source
   * @param unknown_type $destination
   * @param unknown_type $fileMode
   * @param unknown_type $create
   * @param unknown_type $dirMode
   * @return unknown
   */
  public static function moveFile($source, $dest, $fileMode = 0666, $create = true, $dirMode = 0777)
  {
    if (file_exists($source))
    {
      // get our directory path from the destination filename
      $directory = dirname($dest);

      if (!is_readable($directory))
      {
        $fmode = 0777;

        if ($create && !@mkdir($directory, $dirMode, true))
        {
          // failed to create the directory
          throw new sfFileException(sprintf('Failed to create file upload directory "%s".', $directory));
        }

        // chmod the directory since it doesn't seem to work on
        // recursive paths
        @chmod($directory, $dirMode);
      }
      else if (!is_dir($directory))
      {
        // the directory path exists but it's not a directory
        throw new sfFileException(sprintf('File upload path "%s" exists, but is not a directory.', $directory));
      }
      else if (!is_writable($directory))
      {
        // the directory isn't writable
        throw new sfFileException(sprintf('File upload path "%s" is not writable.', $directory));
      }

      if (@copy($source, $dest))
      {
        // chmod our file
        @chmod($file, $fileMode);

        return true;
      }
    }

    return false;
  }
  
}
