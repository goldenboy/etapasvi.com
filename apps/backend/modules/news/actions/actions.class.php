<?php
ini_set( 'error_reporting', 'E_ALL' );
ini_set( 'display_errors', 'on' );
error_reporting(E_ALL);

/**
 * news actions.
 *
 * @package    sf_sandbox
 * @subpackage news
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 5125 2007-09-16 00:53:55Z dwhittle $
 */
class newsActions extends autonewsActions
{

  protected function updateNewsFromRequest()
  {
    $news = $this->getRequestParameter('news');

    $this->news->setShow(isset($news['show']) ? $news['show'] : 0);
    if (isset($news['order']))
    {
      $this->news->setOrder($news['order']);
    }
    if (isset($news['date']))
    {
      if ($news['date'])
      {
        try
        {
          $dateFormat = new sfDateFormat($this->getUser()->getCulture());
                              if (!is_array($news['date']))
          {
            $value = $dateFormat->format($news['date'], 'i', $dateFormat->getInputPattern('d'));
          }
          else
          {
            $value_array = $news['date'];
            $value = $value_array['year'].'-'.$value_array['month'].'-'.$value_array['day'].(isset($value_array['hour']) ? ' '.$value_array['hour'].':'.$value_array['minute'].(isset($value_array['second']) ? ':'.$value_array['second'] : '') : '');
          }
          $this->news->setDate($value);
        }
        catch (sfException $e)
        {
          // not a date
        }
      }
      else
      {
        $this->news->setDate(null);
      }
    }

    
    $full_local    = $this->news->getFullLocal();    
    $thumb_local   = $this->news->getThumbLocal();
        
    // удаляем изображения
    if (!$this->getRequest()->hasErrors() && isset($news['img_remove']))
    {
      $this->news->setImg('');
      $this->news->setFullPath('');
      $this->news->setThumbPath('');
      // full
      if (is_file($full_local))
      {
        unlink($full_local);
      }   
      // thumb      
      if (is_file($thumb_local))
      {
        unlink($thumb_local);
      } 
    }
        

    if (!$this->getRequest()->hasErrors() && $this->getRequest()->getFileSize('news[img]'))
    {
      $fileName = $this->news->getId();
      
      // если новость создаётся, ID ещё неизвестен
      if (!$fileName) {
      	$this->news->save();
      	$fileName = $this->news->getId();
      }
      
      $ext = $this->getRequest()->getFileExtension('news[img]');
      
      $tmp_full    = sfConfig::get('sf_upload_dir')."/".NewsPeer::FULL_DIR."/".$fileName.$ext;     
      $tmp_thumb   = sfConfig::get('sf_upload_dir')."/".NewsPeer::THUMB_DIR."/".$fileName.$ext;
      
      $this->getRequest()->moveFile('news[img]', $tmp_full);
      $this->news->setImg($fileName.$ext);
      
	  try {
		// создание иконки
		$img = new sfImage( $tmp_full );
		$img->thumbnail( NewsPeer::THUMB_WIDTH, NewsPeer::THUMB_HEIGHT, 'scale' );  
		$img->setQuality(100);
		$img->saveAs( $tmp_thumb );  
		
		// уменьшаем основное изображение
		$img = new sfImage( $tmp_full );	   
		if ( $img->getWidth() > NewsPeer::IMG_WIDTH || $img->getHeight() > NewsPeer::IMG_HEIGHT ) {
		    $img->thumbnail( NewsPeer::IMG_WIDTH, NewsPeer::IMG_HEIGHT, 'scale');  
		}
		// водяной знак   	  
		if (isset($news['watermark'])) {	    
		    $img->overlay(new sfImage(sfConfig::get('sf_web_dir') . '/i/watermark.png'), 'bottom-right'); // or you can use coords array($x,$y)
		}      
		$img->save();  	  
        
        // to Picasa
        try
		{		
		  $title = $fileName . ($news['title_i18n_en'] !='' ? ' - ' . $news['title_i18n_en'] : '');	
		  
		  // full
		  $remote_post_result = PhotoPeer::remoteStoragePostImage(
		  	NewsPeer::FULL_DIR, 
		  	$tmp_full,
		  	$img->getMIMEType(),
		  	$fileName.$ext,
		  	$title
		  );
		  if ($remote_post_result['error']) {
		  	echo $remote_post_result['error'];
		  	exit();
		  }
		  $this->news->setFullPath( $remote_post_result['url'] );
		  // перемещение файла в локальную директорию, аналогичнцю удалённой
		  PhotoPeer::moveFile( 
		    $tmp_full, 
		    sfConfig::get('sf_upload_dir')."/".NewsPeer::PHOTO_DIR."/".$remote_post_result['url']."/".$fileName.$ext
  	      );		  		  
		  
		  // thumb
		  $remote_post_result = PhotoPeer::remoteStoragePostImage(
		  	NewsPeer::THUMB_DIR,
		  	$tmp_thumb,
		  	$img->getMIMEType(),
		  	$fileName.$ext,
		  	$title
		  );

		  if ($remote_post_result['error']) {
		  	echo $remote_post_result['error'];
		  	exit();
		  }
		  $this->news->setThumbPath( $remote_post_result['url'] );
		  // перемещение файла в локальную директорию, аналогичнцю удалённой
		  PhotoPeer::moveFile( 
		    $tmp_thumb, 
		    sfConfig::get('sf_upload_dir')."/".NewsPeer::PHOTO_DIR."/".$remote_post_result['url']."/".$fileName.$ext
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
		if (is_file($thumb_local))
		{
			unlink($thumb_local);
		} 
      
      } catch (Exception $e) {
      	
      }         
    } elseif (!isset($news['img_remove'])) {
	  if (isset($news['full_path']))
	  {
	    $this->news->setFullPath($news['full_path']);
	  }	    
	  if (isset($news['thumb_path']))
	  {
	    $this->news->setThumbPath($news['thumb_path']);
	  }
    }
    if (isset($news['type']))
    {
      $this->news->setType($news['type'] ? $news['type'] : null);
    }
    if (isset($news['original']))
    {
      $this->news->setOriginal($news['original']);
    }    
    if (isset($news['title_i18n_en']))
    {
      $this->news->setTitleI18nEn($news['title_i18n_en']);
    }
    if (isset($news['extradate_i18n_en']))
    {
      $this->news->setExtradateI18nEn($news['extradate_i18n_en']);
    }
    if (isset($news['shortbody_i18n_en']))
    {
      $this->news->setShortbodyI18nEn($news['shortbody_i18n_en']);
    }
    if (isset($news['body_i18n_en']))
    {
      $this->news->setBodyI18nEn($news['body_i18n_en']);
    }
    if (isset($news['author_i18n_en']))
    {
      $this->news->setAuthorI18nEn($news['author_i18n_en']);
    }
    if (isset($news['translated_by_i18n_en']))
    {
      $this->news->setTranslatedByI18nEn($news['translated_by_i18n_en']);
    }
    if (isset($news['link_i18n_en']))
    {
      $this->news->setLinkI18nEn($news['link_i18n_en']);
    }
    if (isset($news['title_i18n_ru']))
    {
      $this->news->setTitleI18nRu($news['title_i18n_ru']);
    }
    if (isset($news['extradate_i18n_ru']))
    {
      $this->news->setExtradateI18nRu($news['extradate_i18n_ru']);
    }
    if (isset($news['shortbody_i18n_ru']))
    {
      $this->news->setShortbodyI18nRu($news['shortbody_i18n_ru']);
    }
    if (isset($news['body_i18n_ru']))
    {
      $this->news->setBodyI18nRu($news['body_i18n_ru']);
    }
    if (isset($news['author_i18n_ru']))
    {
      $this->news->setAuthorI18nRu($news['author_i18n_ru']);
    }
    if (isset($news['translated_by_i18n_ru']))
    {
      $this->news->setTranslatedByI18nRu($news['translated_by_i18n_ru']);
    }
    if (isset($news['link_i18n_ru']))
    {
      $this->news->setLinkI18nRu($news['link_i18n_ru']);
    }
    if (isset($news['title_i18n_cs']))
    {
      $this->news->setTitleI18nCs($news['title_i18n_cs']);
    }
    if (isset($news['extradate_i18n_cs']))
    {
      $this->news->setExtradateI18nCs($news['extradate_i18n_cs']);
    }
    if (isset($news['shortbody_i18n_cs']))
    {
      $this->news->setShortbodyI18nCs($news['shortbody_i18n_cs']);
    }
    if (isset($news['body_i18n_cs']))
    {
      $this->news->setBodyI18nCs($news['body_i18n_cs']);
    }
    if (isset($news['author_i18n_cs']))
    {
      $this->news->setAuthorI18nCs($news['author_i18n_cs']);
    }
    if (isset($news['translated_by_i18n_cs']))
    {
      $this->news->setTranslatedByI18nCs($news['translated_by_i18n_cs']);
    }
    if (isset($news['link_i18n_cs']))
    {
      $this->news->setLinkI18nCs($news['link_i18n_cs']);
    }
    if (isset($news['title_i18n_hu']))
    {
      $this->news->setTitleI18nHu($news['title_i18n_hu']);
    }
    if (isset($news['extradate_i18n_hu']))
    {
      $this->news->setExtradateI18nHu($news['extradate_i18n_hu']);
    }
    if (isset($news['shortbody_i18n_hu']))
    {
      $this->news->setShortbodyI18nHu($news['shortbody_i18n_hu']);
    }
    if (isset($news['body_i18n_hu']))
    {
      $this->news->setBodyI18nHu($news['body_i18n_hu']);
    }
    if (isset($news['author_i18n_hu']))
    {
      $this->news->setAuthorI18nHu($news['author_i18n_hu']);
    }
    if (isset($news['translated_by_i18n_hu']))
    {
      $this->news->setTranslatedByI18nHu($news['translated_by_i18n_hu']);
    }
    if (isset($news['link_i18n_hu']))
    {
      $this->news->setLinkI18nHu($news['link_i18n_hu']);
    }
    if (isset($news['title_i18n_pl']))
    {
      $this->news->setTitleI18nPl($news['title_i18n_pl']);
    }
    if (isset($news['extradate_i18n_pl']))
    {
      $this->news->setExtradateI18nPl($news['extradate_i18n_pl']);
    }
    if (isset($news['shortbody_i18n_pl']))
    {
      $this->news->setShortbodyI18nPl($news['shortbody_i18n_pl']);
    }
    if (isset($news['body_i18n_pl']))
    {
      $this->news->setBodyI18nPl($news['body_i18n_pl']);
    }
    if (isset($news['author_i18n_pl']))
    {
      $this->news->setAuthorI18nPl($news['author_i18n_pl']);
    }
    if (isset($news['translated_by_i18n_pl']))
    {
      $this->news->setTranslatedByI18nPl($news['translated_by_i18n_pl']);
    }
    if (isset($news['link_i18n_pl']))
    {
      $this->news->setLinkI18nPl($news['link_i18n_pl']);
    }
    if (isset($news['title_i18n_fr']))
    {
      $this->news->setTitleI18nFr($news['title_i18n_fr']);
    }
    if (isset($news['extradate_i18n_fr']))
    {
      $this->news->setExtradateI18nFr($news['extradate_i18n_fr']);
    }
    if (isset($news['shortbody_i18n_fr']))
    {
      $this->news->setShortbodyI18nFr($news['shortbody_i18n_fr']);
    }
    if (isset($news['body_i18n_fr']))
    {
      $this->news->setBodyI18nFr($news['body_i18n_fr']);
    }
    if (isset($news['author_i18n_fr']))
    {
      $this->news->setAuthorI18nFr($news['author_i18n_fr']);
    }
    if (isset($news['translated_by_i18n_fr']))
    {
      $this->news->setTranslatedByI18nFr($news['translated_by_i18n_fr']);
    }
    if (isset($news['link_i18n_fr']))
    {
      $this->news->setLinkI18nFr($news['link_i18n_fr']);
    }
    if (isset($news['title_i18n_zh_cn']))
    {
      $this->news->setTitleI18nZhCN($news['title_i18n_zh_cn']);
    }
    if (isset($news['extradate_i18n_zh_cn']))
    {
      $this->news->setExtradateI18nZhCN($news['extradate_i18n_zh_cn']);
    }
    if (isset($news['shortbody_i18n_zh_cn']))
    {
      $this->news->setShortbodyI18nZhCN($news['shortbody_i18n_zh_cn']);
    }
    if (isset($news['body_i18n_zh_cn']))
    {
      $this->news->setBodyI18nZhCN($news['body_i18n_zh_cn']);
    }
    if (isset($news['author_i18n_zh_cn']))
    {
      $this->news->setAuthorI18nZhCN($news['author_i18n_zh_cn']);
    }
    if (isset($news['translated_by_i18n_zh_cn']))
    {
      $this->news->setTranslatedByI18nZhCN($news['translated_by_i18n_zh_cn']);
    }
    if (isset($news['link_i18n_zh_cn']))
    {
      $this->news->setLinkI18nZhCN($news['link_i18n_zh_cn']);
    }
    if (isset($news['title_i18n_vi']))
    {
      $this->news->setTitleI18nVi($news['title_i18n_vi']);
    }
    if (isset($news['extradate_i18n_vi']))
    {
      $this->news->setExtradateI18nVi($news['extradate_i18n_vi']);
    }
    if (isset($news['shortbody_i18n_vi']))
    {
      $this->news->setShortbodyI18nVi($news['shortbody_i18n_vi']);
    }
    if (isset($news['body_i18n_vi']))
    {
      $this->news->setBodyI18nVi($news['body_i18n_vi']);
    }
    if (isset($news['author_i18n_vi']))
    {
      $this->news->setAuthorI18nVi($news['author_i18n_vi']);
    }
    if (isset($news['translated_by_i18n_vi']))
    {
      $this->news->setTranslatedByI18nVi($news['translated_by_i18n_vi']);
    }
    if (isset($news['link_i18n_vi']))
    {
      $this->news->setLinkI18nVi($news['link_i18n_vi']);
    }
    if (isset($news['title_i18n_de']))
    {
      $this->news->setTitleI18nDe($news['title_i18n_de']);
    }
    if (isset($news['extradate_i18n_de']))
    {
      $this->news->setExtradateI18nDe($news['extradate_i18n_de']);
    }
    if (isset($news['shortbody_i18n_de']))
    {
      $this->news->setShortbodyI18nDe($news['shortbody_i18n_de']);
    }
    if (isset($news['body_i18n_de']))
    {
      $this->news->setBodyI18nDe($news['body_i18n_de']);
    }
    if (isset($news['author_i18n_de']))
    {
      $this->news->setAuthorI18nDe($news['author_i18n_de']);
    }
    if (isset($news['translated_by_i18n_de']))
    {
      $this->news->setTranslatedByI18nDe($news['translated_by_i18n_de']);
    }
    if (isset($news['link_i18n_de']))
    {
      $this->news->setLinkI18nDe($news['link_i18n_de']);
    }
    if (isset($news['title_i18n_it']))
    {
      $this->news->setTitleI18nIt($news['title_i18n_it']);
    }
    if (isset($news['extradate_i18n_it']))
    {
      $this->news->setExtradateI18nIt($news['extradate_i18n_it']);
    }
    if (isset($news['shortbody_i18n_it']))
    {
      $this->news->setShortbodyI18nIt($news['shortbody_i18n_it']);
    }
    if (isset($news['body_i18n_it']))
    {
      $this->news->setBodyI18nIt($news['body_i18n_it']);
    }
    if (isset($news['author_i18n_it']))
    {
      $this->news->setAuthorI18nIt($news['author_i18n_it']);
    }
    if (isset($news['translated_by_i18n_it']))
    {
      $this->news->setTranslatedByI18nIt($news['translated_by_i18n_it']);
    }
    if (isset($news['link_i18n_it']))
    {
      $this->news->setLinkI18nIt($news['link_i18n_it']);
    }
 	if (isset($news['title_i18n_ja']))
    {
      $this->news->setTitleI18nJa($news['title_i18n_ja']);
    }
    if (isset($news['extradate_i18n_ja']))
    {
      $this->news->setExtradateI18nJa($news['extradate_i18n_ja']);
    }
    if (isset($news['shortbody_i18n_ja']))
    {
      $this->news->setShortbodyI18nJa($news['shortbody_i18n_ja']);
    }
    if (isset($news['body_i18n_ja']))
    {
      $this->news->setBodyI18nJa($news['body_i18n_ja']);
    }
    if (isset($news['author_i18n_ja']))
    {
      $this->news->setAuthorI18nJa($news['author_i18n_ja']);
    }
    if (isset($news['translated_by_i18n_ja']))
    {
      $this->news->setTranslatedByI18nJa($news['translated_by_i18n_ja']);
    }
    if (isset($news['link_i18n_ja']))
    {
      $this->news->setLinkI18nJa($news['link_i18n_ja']);
    }
    if (isset($news['title_i18n_es']))
    {
      $this->news->setTitleI18nEs($news['title_i18n_es']);
    }
    if (isset($news['extradate_i18n_es']))
    {
      $this->news->setExtradateI18nEs($news['extradate_i18n_es']);
    }
    if (isset($news['shortbody_i18n_es']))
    {
      $this->news->setShortbodyI18nEs($news['shortbody_i18n_es']);
    }
    if (isset($news['body_i18n_es']))
    {
      $this->news->setBodyI18nEs($news['body_i18n_es']);
    }
    if (isset($news['author_i18n_es']))
    {
      $this->news->setAuthorI18nEs($news['author_i18n_es']);
    }
    if (isset($news['translated_by_i18n_es']))
    {
      $this->news->setTranslatedByI18nEs($news['translated_by_i18n_es']);
    }
    if (isset($news['link_i18n_es']))
    {
      $this->news->setLinkI18nEs($news['link_i18n_es']);
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
  	exit();
  	$c = new Criteria();
  	$c->add(NewsPeer::SHOW, 1);
  	$c->add(NewsPeer::IMG, '', Criteria::NOT_EQUAL);
  	//$c->setLimit(2);
  	$news_list = NewsPeer::doSelect($c);
  	
  	foreach ($news_list as $news) {  		  	
  		
  		echo $news->getId() . '<br>';  		
  		
  		$full_old_path = sfConfig::get('sf_upload_dir')."/".NewsPeer::FULL_DIR."/".$news->getImg();
  		
  		$title    = $news->getId() . ($news->getTitle() !='' ? ' - ' . $news->getTitle() : '');	  		
  		$pathinfo = pathinfo($full_old_path);
  		$ext      = $pathinfo['extension'];
  		if (!$ext) {
  			echo 'no ext';
  			echo '<br><br>';
  			continue;
  		}
  		$filename = $news->getId() . '.' . $ext;
  		
  		if ( file_exists($news->getFullLocal()) && file_exists($news->getThumbLocal()) ) {
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
			NewsPeer::FULL_DIR, 
			$full_old_path,
			$mime_type,
			$filename,
			$title
		);
		if ($remote_post_result['error']) {
			echo $remote_post_result['error'] . '<br>';
		}
		$news->setFullPath( $remote_post_result['url'] );
		// перемещение файла в локальную директорию, аналогичнцю удалённой
		PhotoPeer::moveFile( 
			$full_old_path, 
			sfConfig::get('sf_upload_dir')."/".NewsPeer::PHOTO_DIR."/".$remote_post_result['url']."/".$filename
		);		
		/*PhotoPeer::moveFile( 
			$full_old_path, 
			sfConfig::get('sf_upload_dir')."/".NewsPeer::FULL_DIR."/".$filename
		);*/
		echo $remote_post_result['url'] . '<br>';		  		
		
  		// thumb
  		echo 'thumb<br>';
  		$thumb_old_path = sfConfig::get('sf_upload_dir')."/".NewsPeer::THUMB_DIR."/".$news->getImg();
  		
		$remote_post_result = PhotoPeer::remoteStoragePostImage(
			NewsPeer::THUMB_DIR, 
			$thumb_old_path,
			$mime_type,
			$filename,
			$title
		);
		if ($remote_post_result['error']) {
			echo $remote_post_result['error'] . '<br>';
		}
		$news->setThumbPath( $remote_post_result['url'] );
		// перемещение файла в локальную директорию, аналогичнцю удалённой
		PhotoPeer::moveFile( 
			$thumb_old_path, 
			sfConfig::get('sf_upload_dir')."/".NewsPeer::PHOTO_DIR."/".$remote_post_result['url']."/".$filename
		);		
		echo $remote_post_result['url'] . '<br>';
		
		$news->setPrevImg( $filename );
		$news->save();
		
		echo '<br><br>';		
  	}

  }
  
  /**
   * Очистка кэша
   *
   * @param unknown_type $request
   */
  public function executeCache($request)
  {
    // обновление кэша
    $this->refresh_processes = sfSuperCache::listRefreshProcesses();
    
    // запуск обновления кэша
    if (!empty($_POST['refresh_cache'])) {
    	
      sfSuperCache::runRefreshCacheTask();      
    }
      
    // очистка кэша
  	if (!empty($_POST['path'])) {
  	  if (!empty($_POST['al_cultures'])) {
  	    $all_cultures = true;
  	  } else {
  	  	$all_cultures = false;
  	  }
	  $this->clear_pathes = sfSuperCache::clearCacheByPath($_POST['path'], $all_cultures);		
  	}  	  	
  	
  	// информация об объёме и кол-ве файлов
  	if (!empty($_POST['info'])) {
	  $this->cache_info = sfSuperCache::getInfo();	
  	}
  }
  
}
