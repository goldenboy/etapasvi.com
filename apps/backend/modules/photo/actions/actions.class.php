<?php
//phpinfo();
//exit();
ini_set( 'error_reporting', 'E_ALL' );
ini_set( 'display_errors', 'on' );
error_reporting(E_ALL);


ini_set('max_execution_time', '3600');

/*
ini_set( 'error_reporting', 'E_ALL' );
ini_set( 'display_errors', 'on' );
error_reporting(E_ALL);*/
/**
 * photo actions.
 *
 * @package    sf_sandbox
 * @subpackage photo
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 5125 2007-09-16 00:53:55Z dwhittle $
 */
class photoActions extends autophotoActions
{
	
  protected function updatePhotoFromRequest()
  {
    $photo = $this->getRequestParameter('photo');
    
    if (isset($photo['photoalbum_id']))
    {
    $this->photo->setPhotoalbumId($photo['photoalbum_id'] ? $photo['photoalbum_id'] : null);
    }

    $this->photo->setShow(isset($photo['show']) ? $photo['show'] : 0);
    if (isset($photo['order']))
    {
      $this->photo->setOrder($photo['order']);
    }
    
    $full_local    = $this->photo->getFullLocal();
    $preview_local = $this->photo->getPreviewLocal();
    $thumb_local   = $this->photo->getThumbLocal();
    
    // удаляем файлы, если выбрали remove или загружают новые
    if (!$this->getRequest()->hasErrors() && isset($photo['img_remove']))
    {
      $this->photo->setImg('');
      $this->photo->setFullPath('');
      $this->photo->setPreviewPath('');
      $this->photo->setThumbPath('');           

      if (is_file($full_local))
      {
        unlink($full_local);
      }
      // thumb      
      if (is_file($preview_local))
      {
        unlink($preview_local);
      }      
      // preview      
      if (is_file($thumb_local))
      {
        unlink($thumb_local);
      }   
    }

    
    if (isset($photo['created_at']))
    {
      if ($photo['created_at'])
      {
        try
        {
          $dateFormat = new sfDateFormat($this->getUser()->getCulture());
          if (!is_array($photo['created_at']))
          {
            $value = $dateFormat->format($photo['created_at'], 'I', $dateFormat->getInputPattern('g'));
          }
          else
          {
            $value_array = $photo['created_at'];
            $value = $value_array['year'].'-'.$value_array['month'].'-'.$value_array['day'].(isset($value_array['hour']) ? ' '.$value_array['hour'].':'.$value_array['minute'].(isset($value_array['second']) ? ':'.$value_array['second'] : '') : '');
          }
          $this->photo->setCreatedAt($value);
        }
        catch (sfException $e)
        {
          // not a date
        }
      }
      else
      {
        $this->photo->setCreatedAt(null);
      }
    }
    if (isset($photo['link']))
    {
      $this->photo->setLink($photo['link']);
    }
    if (isset($photo['width']))
    {
      $this->photo->setWidth($photo['width']);
    }
    if (isset($photo['height']))
    {
      $this->photo->setHeight($photo['height']);
    }    
    // culture
    if (isset($photo['title_i18n_en']))
    {
      $this->photo->setTitleI18nEn($photo['title_i18n_en']);
    }
    if (isset($photo['body_i18n_en']))
    {
      $this->photo->setBodyI18nEn($photo['body_i18n_en']);
    }
    if (isset($photo['author_i18n_en']))
    {
      $this->photo->setAuthorI18nEn($photo['author_i18n_en']);
    }
    if (isset($photo['title_i18n_ru']))
    {
      $this->photo->setTitleI18nRu($photo['title_i18n_ru']);
    }
    if (isset($photo['body_i18n_ru']))
    {
      $this->photo->setBodyI18nRu($photo['body_i18n_ru']);
    }
    if (isset($photo['author_i18n_ru']))
    {
      $this->photo->setAuthorI18nRu($photo['author_i18n_ru']);
    }
    if (isset($photo['title_i18n_cs']))
    {
      $this->photo->setTitleI18nCs($photo['title_i18n_cs']);
    }
    if (isset($photo['body_i18n_cs']))
    {
      $this->photo->setBodyI18nCs($photo['body_i18n_cs']);
    }
    if (isset($photo['author_i18n_cs']))
    {
      $this->photo->setAuthorI18nCs($photo['author_i18n_cs']);
    }
    if (isset($photo['title_i18n_hu']))
    {
      $this->photo->setTitleI18nHu($photo['title_i18n_hu']);
    }
    if (isset($photo['body_i18n_hu']))
    {
      $this->photo->setBodyI18nHu($photo['body_i18n_hu']);
    }
    if (isset($photo['author_i18n_hu']))
    {
      $this->photo->setAuthorI18nHu($photo['author_i18n_hu']);
    }
    if (isset($photo['title_i18n_pl']))
    {
      $this->photo->setTitleI18nPl($photo['title_i18n_pl']);
    }
    if (isset($photo['body_i18n_pl']))
    {
      $this->photo->setBodyI18nPl($photo['body_i18n_pl']);
    }
    if (isset($photo['author_i18n_pl']))
    {
      $this->photo->setAuthorI18nPl($photo['author_i18n_pl']);
    }
    if (isset($photo['title_i18n_fr']))
    {
      $this->photo->setTitleI18nFr($photo['title_i18n_fr']);
    }
    if (isset($photo['body_i18n_fr']))
    {
      $this->photo->setBodyI18nFr($photo['body_i18n_fr']);
    }
    if (isset($photo['author_i18n_fr']))
    {
      $this->photo->setAuthorI18nFr($photo['author_i18n_fr']);
    }
    if (isset($photo['title_i18n_zh_cn']))
    {
      $this->photo->setTitleI18nZhCN($photo['title_i18n_zh_cn']);
    }
    if (isset($photo['body_i18n_zh_cn']))
    {
      $this->photo->setBodyI18nZhCN($photo['body_i18n_zh_cn']);
    }
    if (isset($photo['author_i18n_zh_cn']))
    {
      $this->photo->setAuthorI18nZhCN($photo['author_i18n_zh_cn']);
    }
    if (isset($photo['title_i18n_vi']))
    {
      $this->photo->setTitleI18nVi($photo['title_i18n_vi']);
    }
    if (isset($photo['body_i18n_vi']))
    {
      $this->photo->setBodyI18nVi($photo['body_i18n_vi']);
    }
    if (isset($photo['author_i18n_vi']))
    {
      $this->photo->setAuthorI18nVi($photo['author_i18n_vi']);
    }
    if (isset($photo['title_i18n_de']))
    {
      $this->photo->setTitleI18nDe($photo['title_i18n_de']);
    }
    if (isset($photo['body_i18n_de']))
    {
      $this->photo->setBodyI18nDe($photo['body_i18n_de']);
    }
    if (isset($photo['author_i18n_de']))
    {
      $this->photo->setAuthorI18nDe($photo['author_i18n_de']);
    }
    if (isset($photo['title_i18n_ja']))
    {
      $this->photo->setTitleI18nJa($photo['title_i18n_ja']);
    }
    if (isset($photo['body_i18n_ja']))
    {
      $this->photo->setBodyI18nJa($photo['body_i18n_ja']);
    }
    if (isset($photo['author_i18n_ja']))
    {
      $this->photo->setAuthorI18nJa($photo['author_i18n_ja']);
    }
    if (isset($photo['title_i18n_es']))
    {
      $this->photo->setTitleI18nEs($photo['title_i18n_es']);
    }
    if (isset($photo['body_i18n_es']))
    {
      $this->photo->setBodyI18nEs($photo['body_i18n_es']);
    }
    if (isset($photo['author_i18n_es']))
    {
      $this->photo->setAuthorI18nEs($photo['author_i18n_es']);
    }
    if (isset($photo['title_i18n_it']))
    {
      $this->photo->setTitleI18nIt($photo['title_i18n_it']);
    }
    if (isset($photo['body_i18n_it']))
    {
      $this->photo->setBodyI18nIt($photo['body_i18n_it']);
    }
    if (isset($photo['author_i18n_it']))
    {
      $this->photo->setAuthorI18nIt($photo['author_i18n_it']);
    }
	if (isset($photo['title_i18n_et']))
    {
      $this->photo->setTitleI18nEt($photo['title_i18n_et']);
    }
    if (isset($photo['body_i18n_et']))
    {
      $this->photo->setBodyI18nEt($photo['body_i18n_et']);
    }
    if (isset($photo['author_i18n_et']))
    {
      $this->photo->setAuthorI18nEt($photo['author_i18n_et']);
    }
    if (isset($photo['title_i18n_ne']))
    {
      $this->photo->setTitleI18nNe($photo['title_i18n_ne']);
    }
    if (isset($photo['body_i18n_ne']))
    {
      $this->photo->setBodyI18nNe($photo['body_i18n_ne']);
    }
    if (isset($photo['author_i18n_ne']))
    {
      $this->photo->setAuthorI18nNe($photo['author_i18n_ne']);
    }
    if (isset($photo['title_i18n_bn']))
    {
      $this->photo->setTitleI18nBn($photo['title_i18n_bn']);
    }
    if (isset($photo['body_i18n_bn']))
    {
      $this->photo->setBodyI18nBn($photo['body_i18n_bn']);
    }
    if (isset($photo['author_i18n_bn']))
    {
      $this->photo->setAuthorI18nBn($photo['author_i18n_bn']);
    }
    if (isset($photo['title_i18n_he']))
    {
      $this->photo->setTitleI18nHe($photo['title_i18n_he']);
    }
    if (isset($photo['body_i18n_he']))
    {
      $this->photo->setBodyI18nHe($photo['body_i18n_he']);
    }
    if (isset($photo['author_i18n_he']))
    {
      $this->photo->setAuthorI18nHe($photo['author_i18n_he']);
    }
    if (isset($photo['title_i18n_zh_tw']))
    {
      $this->photo->setTitleI18nZhTw($photo['title_i18n_zh_tw']);
    }
    if (isset($photo['body_i18n_zh_tw']))
    {
      $this->photo->setBodyI18nZhTw($photo['body_i18n_zh_tw']);
    }
    if (isset($photo['author_i18n_zh_tw']))
    {
      $this->photo->setAuthorI18nZhTw($photo['author_i18n_zh_tw']);
    }
    
    // заключаем в try...catch, чтобы не было 500-й ошибки при сохранении фото с повторным ORDER в альбоме
    try {
    	$this->photo->save();
  	} catch (Exception $e) {
    	$this->getRequest()->setError('edit', $e->getMessage());
    	echo $e->getMessage();
    	exit();
    }    
    
	if (!$this->getRequest()->hasErrors() && $this->getRequest()->getFileSize('photo[img]'))
    {
      //$fileName = md5($this->getRequest()->getFileName('photo[img]').time().rand(0, 99999));
      $fileName = $this->photo->getId();
      
      // если фото создаётся, ID ещё неизвестен
      if (!$fileName) {
      	/*$c = new Criteria();
      	$c->addDescendingOrderByColumn(PhotoPeer::ID);
      	$last_record = PhotoPeer::doSelectOne($c);
      	$fileName = $last_record->getId() + 1;*/
      	
      	// устанавливаем дату
      	$this->photo->setCreatedAt( date("Y-m-d H:i:s") );
      	$this->photo->save();
      	$fileName = $this->photo->getId();
      }
      
      $ext = $this->getRequest()->getFileExtension('photo[img]');
      
      $tmp_full    = sfConfig::get('sf_upload_dir')."/".PhotoPeer::FULL_DIR."/".$fileName.$ext;      
      $tmp_preview = sfConfig::get('sf_upload_dir')."/".PhotoPeer::PREVIEW_DIR."/".$fileName.$ext;
      $tmp_thumb   = sfConfig::get('sf_upload_dir')."/".PhotoPeer::THUMB_DIR."/".$fileName.$ext;
     
      $this->getRequest()->moveFile('photo[img]', $tmp_full);
      $this->photo->setImg($fileName.$ext);
      
      // сохраняем исходное изображение (без каптчи)
      PhotoPeer::moveFile($tmp_full, sfConfig::get('sf_upload_dir')."/".PhotoPeer::ORIGINAL_DIR."/".$fileName.$ext);
      
      if ($photo['watermark_position']) {
		$watermark_position = $photo['watermark_position'];
	  } else {
		$watermark_position = 'bottom-right';
	  }
      
      try {
		// thumb      
        $img = new sfImage( $tmp_full );
        $img->thumbnail(PhotoPeer::IMG_THUMB_WIDTH, PhotoPeer::IMG_THUMB_HEIGHT, 'scale');     
        $img->setQuality( PhotoPeer::THUMB_QUALITY );
        $img->saveAs( $tmp_thumb );           
        
        // preview
        $img = new sfImage( $tmp_full );        
        if ( $img->getWidth() > PhotoPeer::IMG_PREVIEW_WIDTH || $img->getHeight() > PhotoPeer::IMG_PREVIEW_HEIGHT ) {
        	$img->thumbnail(PhotoPeer::IMG_PREVIEW_WIDTH, PhotoPeer::IMG_PREVIEW_HEIGHT, 'scale');  
        }                
        // водяной знак
        if (isset($photo['watermark'])) {
	      $img->overlay(new sfImage(sfConfig::get('sf_web_dir') . '/i/watermark.png'), $watermark_position);
        }
        $img->setQuality( PhotoPeer::PREVIEW_QUALITY );        
        $img->saveAs( $tmp_preview );         
        
        // full        
		$img = new sfImage( $tmp_full );	
        	      
		// исходный размер фото
		$this->photo->setWidth( $img->getWidth() );
		$this->photo->setHeight( $img->getHeight() );
		
		// водяной знак
        if (isset($photo['watermark'])) {          
	      $img->overlay(new sfImage(sfConfig::get('sf_web_dir') . '/i/watermark.png'), $watermark_position);
          $img->setQuality( PhotoPeer::FULL_QUALITY );
	      $img->save();
        }
        
        // to Picasa
        try
		{		
		  $title = $fileName . ($photo['title_i18n_en'] !='' ? ' - ' . $photo['title_i18n_en'] : '');
		  $title .= ' (' . UserPeer::DOMAIN_NAME_MAIN . ')';
		  // full
		  $remote_post_result = PhotoPeer::remoteStoragePostImage(
		  	PhotoPeer::FULL_DIR, 
		  	$tmp_full,
		  	$img->getMIMEType(),
		  	$fileName.$ext,
		  	$title
		  );
		  if ($remote_post_result['error']) {
		  	echo $remote_post_result['error'];
		  	exit();
		  }
		  $this->photo->setFullPath( $remote_post_result['url'] );
		  // перемещение файла в локальную директорию, аналогичнцю удалённой
		  PhotoPeer::moveFile( 
		    $tmp_full, 
		    sfConfig::get('sf_upload_dir')."/".PhotoPeer::PHOTO_DIR."/".$remote_post_result['url']."/".$fileName.$ext
  	      );
		  
		  // preview
		  $remote_post_result = PhotoPeer::remoteStoragePostImage(
		  	PhotoPeer::PREVIEW_DIR, 
		  	$tmp_preview,
		  	$img->getMIMEType(),
		  	$fileName.$ext,
		  	$title
		  );
		  if ($remote_post_result['error']) {
		  	echo $remote_post_result['error'];
		  	exit();
		  }
		  $this->photo->setPreviewPath( $remote_post_result['url'] );
		  // перемещение файла в локальную директорию, аналогичнцю удалённой
		  PhotoPeer::moveFile( 
		    $tmp_preview, 
		    sfConfig::get('sf_upload_dir')."/".PhotoPeer::PHOTO_DIR."/".$remote_post_result['url']."/".$fileName.$ext
  	      );
		  
		  // thumb
		  $remote_post_result = PhotoPeer::remoteStoragePostImage(
		  	PhotoPeer::THUMB_DIR,
		  	$tmp_thumb,
		  	$img->getMIMEType(),
		  	$fileName.$ext,
		  	$title
		  );

		  if ($remote_post_result['error']) {
		  	echo $remote_post_result['error'];
		  	exit();
		  }
		  $this->photo->setThumbPath( $remote_post_result['url'] );
		  // перемещение файла в локальную директорию, аналогичнцю удалённой
		  PhotoPeer::moveFile( 
		    $tmp_thumb, 
		    sfConfig::get('sf_upload_dir')."/".PhotoPeer::PHOTO_DIR."/".$remote_post_result['url']."/".$fileName.$ext
  	      );
		} catch( Exception $e ) {
		  echo $e->getMessage();
		  exit();
		}
		
		// удаляем временные файлы
        if (is_file($tmp_full))
        {
            unlink($tmp_full);
        }     
        // preview      
        if (is_file($tmp_preview))
        {
            unlink($tmp_preview);
        } 
        // thumb      
        if (is_file($tmp_thumb))
        {
            unlink($tmp_thumb);
        }
        
        // удаляем прошлые файлы
		if (is_file($full_local))
		{
			unlink($full_local);
		}
		// thumb      
		if (is_file($preview_local))
		{
			unlink($preview_local);
		}      
		// preview      
		if (is_file($thumb_local))
		{
			unlink($thumb_local);
		} 
      
      } catch (Exception $e) {
      	echo $e->getMessage();
      	exit();
      }    
    } elseif (!isset($photo['img_remove'])) {
	    if (isset($photo['full_path']))
	    {
	      $this->photo->setFullPath($photo['full_path']);
	    }
	    /*if (isset($photo['full_link']))
	    {
	      $this->photo->setFullLink($photo['full_link']);
	    }*/
	    if (isset($photo['preview_path']))
	    {
	      $this->photo->setPreviewPath($photo['preview_path']);
	    }
	    /*
	    if (isset($photo['preview_link']))
	    {
	      $this->photo->setPreviewLink($photo['preview_link']);
	    }*/
	    if (isset($photo['thumb_path']))
	    {
	      $this->photo->setThumbPath($photo['thumb_path']);
	    }
	    /*
	    if (isset($photo['thumb_link']))
	    {
	      $this->photo->setThumbLink($photo['thumb_link']);
	    }*/
    }
  }
  
  public function executeEdit($request)
  {    	
  	parent::executeEdit($request);
  	
  	// проверка авторизации
  	if (!PhotoPeer::remoteStorageCheckAutenthication()) {
  	  $this->url_to_login_page = Picasa::getUrlToLoginPage($_SERVER['SCRIPT_URI']);  	  
  	} else {
  	  $this->url_to_login_page = '';
  	}
  }
  
  /**
   * Загрузка фото в удалённое хранилище (Picasa)
   *
   * @param unknown_type $request
   */
  public function executeToremotestorage($request)
  {
  	$c = new Criteria();
  	//$c->add(PhotoPeer::ID, 29);
  	//$c->setLimit(2);
  	$photo_list = PhotoPeer::doSelect($c);
  	
  	foreach ($photo_list as $photo) {  		  	
  		
  		echo $photo->getId() . '<br>';  		
  		
  		$full_old_path = sfConfig::get('sf_upload_dir')."/".PhotoPeer::FULL_DIR."/".$photo->getImg();
  		
  		$title    = $photo->getId() . ($photo->getTitle() !='' ? ' - ' . $photo->getTitle() : '');	  		
  		$pathinfo = pathinfo($full_old_path);
  		$ext      = $pathinfo['extension'];
  		if (!$ext) {
  			echo 'no ext';
  			echo '<br><br>';
  			continue;
  		}
  		$filename = $photo->getId() . '.' . $ext;
  		
  		if (file_exists(sfConfig::get('sf_upload_dir')."/".PhotoPeer::THUMB_DIR."/".$filename)
  			&& file_exists(sfConfig::get('sf_upload_dir')."/".PhotoPeer::PREVIEW_DIR."/".$filename)
  			&& file_exists(sfConfig::get('sf_upload_dir')."/".PhotoPeer::FULL_DIR."/".$filename)
  		) {
  			echo 'exists';
  			continue;
  		}  		
  		
  		//$mime_type = mime_content_type($full_old_path); //'image/jpeg';
  		switch (strtolower($ext)) {
  			case 'jpg':
  				$mime_type = 'image/jpeg';
  				break;
  			case 'gif':
  				$mime_type = 'image/gif';
  				break;
  			/*default:
  				$mime_type = 'image/jpeg';
  				break;  				*/
  		}
  		
  		// full  
  		echo 'full<br>';		  		
  		
		$remote_post_result = PhotoPeer::remoteStoragePostImage(
			PhotoPeer::FULL_DIR, 
			$full_old_path,
			$mime_type,
			$filename,
			$title
		);
		if ($remote_post_result['error']) {
			echo $remote_post_result['error'] . '<br>';
		}
		$photo->setFullPath( $remote_post_result['url'] );
		// перемещение файла в локальную директорию, аналогичнцю удалённой
		PhotoPeer::moveFile( 
			$full_old_path, 
			sfConfig::get('sf_upload_dir')."/".PhotoPeer::PHOTO_DIR."/".$remote_post_result['url']."/".$filename
		);		
		PhotoPeer::moveFile( 
			$full_old_path, 
			sfConfig::get('sf_upload_dir')."/".PhotoPeer::FULL_DIR."/".$filename
		);
		echo $remote_post_result['url'] . '<br>';
		
  		// preview
  		echo 'preview<br>';
  		$preview_old_path = sfConfig::get('sf_upload_dir')."/".PhotoPeer::PREVIEW_DIR."/".$photo->getImg();
  		
		$remote_post_result = PhotoPeer::remoteStoragePostImage(
			PhotoPeer::PREVIEW_DIR, 
			$preview_old_path,
			$mime_type,
			$filename,
			$title
		);
		if ($remote_post_result['error']) {
			echo $remote_post_result['error'] . '<br>';
		}
		$photo->setPreviewPath( $remote_post_result['url'] );
		// перемещение файла в локальную директорию, аналогичнцю удалённой
		PhotoPeer::moveFile( 
			$preview_old_path, 
			sfConfig::get('sf_upload_dir')."/".PhotoPeer::PHOTO_DIR."/".$remote_post_result['url']."/".$filename
		);
		PhotoPeer::moveFile( 
			$preview_old_path, 
			sfConfig::get('sf_upload_dir')."/".PhotoPeer::PREVIEW_DIR."/".$filename
		);
		echo $remote_post_result['url'] . '<br>';
		
  		// thumb
  		echo 'thumb<br>';
  		$thumb_old_path = sfConfig::get('sf_upload_dir')."/".PhotoPeer::THUMB_DIR."/".$photo->getImg();
  		
		$remote_post_result = PhotoPeer::remoteStoragePostImage(
			PhotoPeer::THUMB_DIR, 
			$thumb_old_path,
			$mime_type,
			$filename,
			$title
		);
		if ($remote_post_result['error']) {
			echo $remote_post_result['error'] . '<br>';
		}
		$photo->setThumbPath( $remote_post_result['url'] );
		// перемещение файла в локальную директорию, аналогичнцю удалённой
		PhotoPeer::moveFile( 
			$thumb_old_path, 
			sfConfig::get('sf_upload_dir')."/".PhotoPeer::PHOTO_DIR."/".$remote_post_result['url']."/".$filename
		);
		PhotoPeer::moveFile( 
			$thumb_old_path, 
			sfConfig::get('sf_upload_dir')."/".PhotoPeer::THUMB_DIR."/".$filename
		);
		echo $remote_post_result['url'] . '<br>';
		
		$photo->setPrevImg( $filename );
		$photo->save();
		
		echo '<br><br>';		
  	}
  	
  	/*
    $username = PhotoPeer::REMOTE_STORAGE_USERNAME;
	$album    = 'photo'; //PhotoPeer::getRemoteStorageAlbum( PhotoPeer::PREVIEW_DIR );
		
	try
	{
		
	  $pic = new Picasa();	  
	  $album = $pic->getAlbumById($username, $album);	  
	  $this->images = $album->getImages();
	  $this->title  = $album->getTitle();
 	  echo $this->images[0]->getContent();
 	  echo $this->images[0]->getLargeThumb();
 	  echo $this->images[0]->getMediumThumb();
 	  echo $this->images[0]->getSmallThumb();
	}
	catch( Exception $e )
	{
	  $this->images = array();
	  $this->title = '';
	  echo $e->getMessage();
	}*/
  }
  
  /**
   * Изменение путей к фотографиям в новостях
   *
   * @param unknown_type $request
   */
  public function executeChangephotoinnews($request)
  {
  	$c = new Criteria();
  	$c->add(NewsI18nPeer::BODY, '%/uploads/photo/preview/%', Criteria::LIKE);
  	//$c->setLimit(2);
  	$news_list = NewsI18nPeer::doSelect($c);
  	
  	foreach ($news_list as $news) {  	
  	    echo $news->getId() . ' ' . $news->getCulture() . '<br>';
  	    $body = $news->getBody();
  	    //echo htmlspecialchars( $body );
  	    
  	    preg_match_all("/(:?http:\/\/www.etapasvi.com)?\/uploads\/photo\/preview\/[A-z0-9]{32}\.[A-z]{3}/m", $body, $matches);
  	    
  	    foreach ($matches[0] as $old_path) {  	         	       
  	       $c = new Criteria();
  	       $c->add(PhotoPeer::IMG, basename($old_path) );
  	       $photo_item = PhotoPeer::doSelectOne($c);
  	       if ($photo_item) {
  	           $new_path = $photo_item->getPreviewUrl();  	           
  	       } else {
  	           echo 'photo not found: ' . $old_path;
  	           //exit();
  	       }
  	       $replaces[ $old_path ]     = $new_path;
  	    }
  	    $new_body = strtr($body, $replaces);
  	    $news->setBody($new_body);
  	    //$news->save();
  	    //echo htmlspecialchars($new_body);
  	    echo '<br><br>';
  	}
  }
  
  /**
   * Получение размеров полных фотографий (width, height) и сохраненеи в БД
   *
   * @param unknown_type $request
   */
  public function executeSetdimentions($request)
  {
  	ini_set('max_execution_time', 60*60*24);
  	ini_set('memory_limit', '128M');
  	
  	// для открытия некоторых sfImage не хватает памяти
  	$miss_ids = array(970 );
  	
  	//$count = 1400;
  	//$step  = 100;

  	//for ($i = 0; $i <= $count; $i = $i + $step ) {
  	$c = new Criteria();
  	$c->add(PhotoPeer::FULL_PATH, '', Criteria::NOT_EQUAL);
  	//$c->add(PhotoPeer::ID, 800, Criteria::GREATER_THAN);
  	//$c->setOffset($i);
  	//$c->setLimit($step);
  	
  	$list = PhotoPeer::doSelect($c);
  	
  	foreach ($list as $photo) {  	
  		
  		if (in_array($photo->getId(), $miss_ids)) {
  			continue;
  		}
  		
  		$full_local = $photo->getFullLocal();
  		
  	    echo $photo->getId() . ' ' . $full_local . ' ';
  	   
  	    $img = new sfImage( $full_local );	

  	    $width  = $img->getWidth();
  	    $height = $img->getHeight();
  	    
  	    echo ' width=' . $width . ' height=' . $height . ' ';
  	    
  	    if ($width && $height) {
			$photo->setWidth( $width );
			$photo->setHeight( $height );
			$photo->save();
  	    } else {
  	    	echo 'error';
  	    }
  	    echo '<br><br>';
  	}
  	unset($list);

  	//}
  }
  
}


