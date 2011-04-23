<?php

class News extends BaseNews
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
	
    public function getTitle($culture = null) {
		return trim(parent::getTitle($culture));
	}
	
	/*public function getTitle() {
		
		return parent::getTitle();
	}*/
	
	public function getBodyPrepared() {
		//return $this->prepareText( $this->getBody() );
		return TextPeer::prepareText( $this->getBody() );
	}

	public function geShortbodyPrepared() {
		return nl2br( $this->getShortbody() );
	}
	
	public function getOriginalPrepared() {
		return TextPeer::prepareText( $this->getOriginal() );
	}	
	
	/*public function prepareText($text) {
		$text = nl2br($text);
		$text = str_ireplace( '<br />', '&nbsp;</p><p>', $text );
		return $text;
	}	*/
	
	/*
	public function getCommentsCount()
	{		
		return (int)CommentsPeer::getCommentsCount( ItemtypesPeer::ITEM_TYPE_NAME_NEWS, $this->getId() );
	}*/
		
	
	/**
	 * Получение ID стрницы для системы комментариев
	 *
	 * @param unknown_type $culture
	 * @return unknown
	 */
	public function getCommentsIdentifier($culture = '') {
	  if (empty($culture)){
		$culture = sfContext::getInstance()->getUser()->getCulture();
	  }
	  return CommentsPeer::getCommentsIdentifier($culture, 'news', 'show', array('id' => $this->getId()));	  
	}
	
	
	
	public function getTypeName()
	{
	  return NewstypesPeer::getTypeName( $this->getType() );
	}
	
	public function getTypeNameCapital()
	{
	  return ucfirst(NewstypesPeer::getTypeName( $this->getType() ));
	}
    
    /**
     * Является ли новость Учением
     */
	public function isTypeTeachings() {
	  if ($this->getType() == NewstypesPeer::NEWS_TYPE_TEACHINGS) {
        return true;
      } else {
        return false;
      }
	}
    
    /**
     * Является ли новость Обычной новостью
     */
	public function isTypeNews() {
	  if ($this->getType() == NewstypesPeer::NEWS_TYPE_NEWS) {
        return true;
      } else {
        return false;
      }
	}
	
    /**
     * Получение ссылки на изображение
     */
	public function getFullUrl() {
	  $path = $this->getFullPath();
	  $file = $this->getImg();

	  if ($path && $file) {
	    //return PhotoPeer::remoteStorageGetUrl( $this->getThumbPath(), $this->getImg() );
	    //return UserPeer::SITE_PROTOCOL . '://' . $_SERVER['HTTP_HOST'] . '/' . UploadPeer::DIR . '/' . NewsPeer::PHOTO_DIR . '/' . $path . '/' . $file;
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
	    //return UserPeer::SITE_PROTOCOL . '://' . $_SERVER['HTTP_HOST'] . '/' . UploadPeer::DIR . '/' . NewsPeer::PHOTO_DIR . '/' . $path . '/' . $file;
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
	    return sfConfig::get('sf_upload_dir') . "/" . NewsPeer::FULL_DIR . "/" . $path . "/" . $file;
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
	    return sfConfig::get('sf_upload_dir') . "/" . NewsPeer::THUMB_DIR . "/" . $path . "/" . $file;
	  } else {
	    return '';	
	  }
	}
	
	
    /**
     * Получение ссылки на новость
     */
	public function getUrl($culture = '') {
	  if (empty($culture)){
		$culture = sfContext::getInstance()->getUser()->getCulture();
	  }
	  $module = $this->getTypeName();
	  
	  $url = UserPeer::SITE_PROTOCOL  . '://' . UserPeer::SITE_ADDRESS . '/' . $culture . '/' . $module . '/show/id/' . $this->getId();	  
	  
	  $title_translit = TextPeer::urlTranslit($this->getTitle( $culture ), $culture );
	  if (!empty($title_translit)) {
	    $url .= '/title/' . $title_translit;
	  }
	  return $url;
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
	  return $this->getShortbody();
	}
	
	/**
	 * Дата публикации для RSS.
	 *
	 * @return unknown
	 */
	public function getRssPubDate() {
	  return max($this->getUpdatedAt(), $this->getUpdatedAtExtra());
	}
	
	/**
	 * Расширенный метод для получения заголовка.
	 * Если $use_default_culture_if_empty, то возвращается значение на языке по умолчанию.
	 */	
	public function getLink($culture = null, $use_default_culture_if_empty = false)
	{
	  $link = parent::getLink($culture);

	  if ($use_default_culture_if_empty) {
        if (!$link) {
          $link = $this->getLink(UserPeer::DEFAULT_CULTURE);
        }
	  }
      return trim($link);
	}
}
