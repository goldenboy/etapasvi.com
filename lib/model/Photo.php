<?php

class Photo extends BasePhoto
{
	/**
	 * Handle I18n DB fields in Admin Generator
	 *
	 * @param string $method
	 * @param mixed $arguments
	 * @return mixed
	 */
	public function __call($method, $arguments)
	{
	  $data = split('I18n', $method, 2);
	
	  if( count($data) != 2 )
	  {
	    // original call for support sfPropelBehavior
	    return parent::__call($method, $arguments);
	  }
	
	  list( $method, $culture ) = $data;
	
	  if (4 == strlen($culture))
	  {
	    $culture = strtolower(substr($culture, 0, 2)) . '_' . strtoupper(substr($culture, 2, 2));
	  }
	  else
	  {
	    $culture = strtolower($culture);
	  }
	
	  $this->setCulture( $culture );
	
	  return call_user_func_array(array($this, $method), $arguments);
	}	

	public function __toString() {
		return $this->getTitle();
	}
    
	/**
	 * Расширенный метод для получения заголовка.
	 * Если $use_default_culture_if_empty, то возвращается значение на языке по умолчанию.
	 */	
	public function getTitle($culture = null, $use_default_culture_if_empty = false)
	{
	  $title = parent::getTitle($culture);

	  if ($use_default_culture_if_empty) {
        if (!$title) {
          $title = $this->getTitle(UserPeer::DEFAULT_CULTURE);
        }
	  }
      return trim($title);
	}
	
	/**
	 * Расширенный метод для получения автора.
	 * Если $use_default_culture_if_empty, то возвращается значение на языке по умолчанию.
	 * Если у фото не указан автор, то ищется в Фотоальбоме
	 */	
	public function getAuthor($culture = null, $use_default_culture_if_empty = false)
	{
	  $author     = parent::getAuthor($culture);
	  	  
	  if ($use_default_culture_if_empty) {
	    $photoalbum = $this->getPhotoalbum();
	    $culture    = sfContext::getInstance()->getUser()->getCulture();
	  
	    if ($this->getAuthor()) {
            $author = $this->getAuthor();
	    } elseif ($culture != UserPeer::DEFAULT_CULTURE && !$this->getAuthor() && $this->getAuthor(UserPeer::DEFAULT_CULTURE)) {
            $author = $this->getAuthor(UserPeer::DEFAULT_CULTURE);
	    } elseif ($culture != UserPeer::DEFAULT_CULTURE && $photoalbum && !$photoalbum->getAuthor() && $photoalbum->getAuthor(UserPeer::DEFAULT_CULTURE)) {
            $author = $photoalbum->getAuthor(UserPeer::DEFAULT_CULTURE);
	    } elseif ($photoalbum && $photoalbum->getAuthor()) {
            $author = $photoalbum->getAuthor();
	    } else {
            $author = '';
	    }
	  }
      return $author;
	}
	
	public function getCommentsCount()
	{		
		return (int)CommentsPeer::getCommentsCount( ItemtypesPeer::ITEM_TYPE_NAME_PHOTO, $this->getId() );
	}
	public function getBodyPrepared() {
		/*$body = $this->getBody();
		$body = nl2br($body);
		$body = str_ireplace( '<br />', '&nbsp;</p><p>', $body );
		return $body;*/
		return TextPeer::prepareText( $this->getBody() );
	}
    public function getPreview()
    {
        return '/'.sfConfig::get('sf_upload_dir_name').'/photo/preview/'.$this->getImg();
    }
    public function getThumb()
    {
        return '/'.sfConfig::get('sf_upload_dir_name').'/photo/thumb/'.$this->getImg();
    }
    
    /**
     * Получение ссылки на фото
     */
	public function getUrl($culture = '') {
	  if (empty($culture)){
		$culture = sfContext::getInstance()->getUser()->getCulture();
	  }	 
	  
	  /*$url = UserPeer::SITE_PROTOCOL  . '://' . UserPeer::SITE_ADDRESS . '/' . $culture . '/photo/show/id/' . $this->getId();
	  $title_translit = TextPeer::urlTranslit($this->getTitle($culture), $culture);
	  if (!empty($title_translit)) {
	    $url .= '/title/' . $title_translit;
	  }*/
	  
      $url_pattern = 'photo/show?id=' . $this->getId();
	  
	  $title_translit = TextPeer::urlTranslit($this->getTitle( $culture ), $culture );
	  if (!empty($title_translit)) {
	    $url_pattern .= '&title=' . $title_translit;
	  }

	  $url = sfContext::getInstance()->getController()->genUrl($url_pattern, true, $culture);
	  return $url;
	}
	
    /**
     * Получение ссылки на изображение
     */
	public function getFullUrl() {
	  $path = $this->getFullPath();
	  $file = $this->getImg();

	  if ($path && $file) {
	    //return PhotoPeer::remoteStorageGetUrl( $this->getThumbPath(), $this->getImg() );
	    //return UserPeer::SITE_PROTOCOL . '://' . $_SERVER['HTTP_HOST'] . '/' . UploadPeer::DIR . '/' . PhotoPeer::PHOTO_DIR . '/' . $path . '/' . $file;
	    return PhotoPeer::REMOTE_STORAGE_URL . $path . '/' . $file;
	  } else {
	    return '';	
	  }
	}
	
    /**
     * Получение ссылки на изображение
     */
	public function getPreviewUrl() {
	  $path = $this->getPreviewPath();
	  $file = $this->getImg();

	  if ($path && $file) {
	    //return PhotoPeer::remoteStorageGetUrl( $this->getThumbPath(), $this->getImg() );
	    //return UserPeer::SITE_PROTOCOL . '://' . $_SERVER['HTTP_HOST'] . '/' . UploadPeer::DIR . '/' . PhotoPeer::PHOTO_DIR . '/' . $path . '/' . $file;
	    return PhotoPeer::REMOTE_STORAGE_URL . $path . '/' . $file;
	  } else {
	    return '';	
	  }
	}
	
    /**
     * Получение ссылки на изображение
     */
	public function getThumbUrl() {
	  $path = $this->getThumbPath();
	  $file = $this->getImg();

	  if ($path && $file) {
	    //return PhotoPeer::remoteStorageGetUrl( $this->getThumbPath(), $this->getImg() );
	    //return UserPeer::SITE_PROTOCOL . '://' . $_SERVER['HTTP_HOST'] . '/' . UploadPeer::DIR . '/' . PhotoPeer::PHOTO_DIR . '/' . $path . '/' . $file;
	    return PhotoPeer::REMOTE_STORAGE_URL . $path . '/' . $file;
	  } else {
	    return '';	
	  }
	}
	
    /**
     * Получение локального пути к изображению
     */    
	public function getFullLocal() {
	  $path = $this->getFullPath();
	  $file = $this->getImg();

	  if ($path && $file) {	    	    
	    return sfConfig::get('sf_upload_dir') . "/" . PhotoPeer::FULL_DIR . "/" . $path . "/" . $file;
	  } else {
	    return '';	
	  }
	}
	
    /**
     * Получение локального пути к изображению
     */    
	public function getPreviewLocal() {
	  $path = $this->getPreviewPath();
	  $file = $this->getImg();

	  if ($path && $file) {	    	    
	    return sfConfig::get('sf_upload_dir') . "/" . PhotoPeer::PREVIEW_DIR . "/" . $path . "/" . $file;
	  } else {
	    return '';	
	  }
	}
	
    /**
     * Получение локального пути к изображению
     */    
	public function getThumbLocal() {
	  $path = $this->getThumbPath();
	  $file = $this->getImg();

	  if ($path && $file) {	    	    
	    return sfConfig::get('sf_upload_dir') . "/" . PhotoPeer::THUMB_DIR . "/" . $path . "/" . $file;
	  } else {
	    return '';	
	  }
	}
	
	/**
	 * Заголовок для RSS
	 *
	 * @return unknown
	 */
	public function getRssTitle() {
	  return $this->getTitle();
	}
	
	/**
	 * Ссылка для RSS
	 *
	 * @return unknown
	 */
	public function getRssLink() {
	  return $this->getUrl();
	}
	
	/**
	 * Описание для RSS
	 *
	 * @return unknown
	 */
	public function getRssDescription() {
	  //return TextPeer::subStr($this->getBody(), NewsPeer::RSS_DESCRIPTION_LENGTH);
	  return '<img src="' . $this->getThumbUrl() . '">';
	}
	
	/**
	 * Дата публикации для RSS
	 *
	 * @return unknown
	 */
	public function getRssPubDate() {
	  return max($this->getUpdatedAt(), $this->getUpdatedAtExtra());
	}
	
	/**
	 * Расширенный метод получения даты.
	 * Если передан $derive_from_photoalbum = true, и у фото не установлена дата, дата берётся из фотоальбома.
	 * Get the [optionally formatted] temporal [created_at] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCreatedAt($format = 'Y-m-d H:i:s', $derive_from_photoalbum = false)
	{
	    $created_at = parent::getCreatedAt($format);
	    
	    // если дата не уставнолена, берём из фотоальбома
	    if ($derive_from_photoalbum && empty($created_at)) {
	        $photoalbum = $this->getPhotoalbum();
	        if ($photoalbum) {
	            $created_at = $photoalbum->getCreatedAt();
	        }
	    }
	    
	    return $created_at;
	}
}
