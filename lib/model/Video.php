<?php

class Video extends BaseVideo
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
	  $data = preg_split('/I18n/', $method, 2);
	
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
	
	public function getCommentsCount()
	{		
		return (int)CommentsPeer::getCommentsCount( ItemtypesPeer::ITEM_TYPE_NAME_VIDEO, $this->getId() );
	}
	public function getBodyPrepared($culture = null, $use_default_culture_if_empty = false) {
		/*$body = $this->getBody();
		$body = nl2br($body);
		$body = str_ireplace( '<br />', '&nbsp;</p><p>', $body );
		return $body;*/
		return TextPeer::prepareText( $this->getBody($culture = null, $use_default_culture_if_empty) );
	}	

	public function getTitlePrepared($title = '') {
		if (!$title) {
			$title = $this->getTitle();
		}
		return TextPeer::subStr($title, VideoPeer::TITLE_LENGTH);
	}	
	
    /**
     * Получение ссылки на видео
     */
	public function getUrl($culture = '') {
	  if (empty($culture)){
		$culture = sfContext::getInstance()->getUser()->getCulture();
	  }	 
	  
      $url_pattern = 'video/show?id=' . $this->getId();
	  
	  $title_translit = TextPeer::urlTranslit($this->getTitle( $culture ), $culture );
	  if (!empty($title_translit)) {
	    $url_pattern .= '&title=' . $title_translit;
	  }

	  $url = sfContext::getInstance()->getController()->genUrl($url_pattern, true, $culture);
	  
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
	  //return TextPeer::subStr($this->getBody(), NewsPeer::RSS_DESCRIPTION_LENGTH);
	  return '<img src="' . $this->getImgPrepared() . '">';
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
	 * Обработанный адрес img
	 *
	 * @param string $culture язык
	 * @param bool $use_default_culture_if_empty если true, то возвращается значение на языке по умолчанию.
	 * @param bool $hight_quality изображение высокого качества
	 * @return unknown
	 */
	public function getImgPrepared($culture = null, $use_default_culture_if_empty = false, $hight_quality = true) {
	  $img = $this->getImg($culture);	 	 
	  
	  if ($this->getAllCultures()) {
	  	$use_default_culture_if_empty = true;
	  }
	  
	  // берём картинку из языка по умолчанию
	  if (!$img) {
	    $img = $this->getImg($culture, $use_default_culture_if_empty);
	  }
	  
	  // берём img из code
	  if (!$img) {
	  	$img = $this->getCode($culture, $use_default_culture_if_empty);
	  }
	  
	  if (!$img) {
	  	return '';
	  }
	  
	  // YouTube
	  if (!strstr($img, 'http://')) {
	  	$img = 'http://i2.ytimg.com/vi/' . $img;
	  	if ($hight_quality) {
	  	    $img .= '/hqdefault.jpg';
	  	} else {
	  	    $img .= '/default.jpg';
	  	}
	  }
	  return $img;
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
          $title = $this->getTitle(sfConfig::get('sf_default_culture'));
        }
	  }
      return trim($title);
	}
	
	/**
	 * Расширенный метод для получения картинки.
	 * Если $use_default_culture_if_empty, то возвращается значение на языке по умолчанию.
	 */	
	public function getImg($culture = null, $use_default_culture_if_empty = false)
	{
	  $img = parent::getImg($culture);

	  if ($use_default_culture_if_empty) {
        if (!$img) {
          $img = $this->getImg(sfConfig::get('sf_default_culture'));
        }
	  }
      return $img;
	}
	
	/**
	 * Расширенный метод для получения картинки.
	 * Если $use_default_culture_if_empty, то возвращается значение на языке по умолчанию.
	 */	
	public function getCode($culture = null, $use_default_culture_if_empty = false)
	{
	  $code = parent::getCode($culture);

	  if ($use_default_culture_if_empty) {
        if (!$code) {
          $code = $this->getCode(sfConfig::get('sf_default_culture'));
        }
	  }
      return $code;
	}
	
	/**
	 * Расширенный метод для получения заголовка.
	 * Если $use_default_culture_if_empty, то возвращается значение на языке по умолчанию.
	 */	
	public function getBody($culture = null, $use_default_culture_if_empty = false)
	{
	  $body = parent::getBody($culture);

	  if ($use_default_culture_if_empty) {
        if (!$body) {
          $body = $this->getBody(sfConfig::get('sf_default_culture'));
        }
	  }
      return $body;
	}
	
	/**
	 * Расширенный метод для получения автора.
	 * Если $use_default_culture_if_empty, то возвращается значение на языке по умолчанию.
	 */	
	public function getAuthor($culture = null, $use_default_culture_if_empty = false)
	{
	  $author     = parent::getAuthor($culture);
	  	  
	  if ($use_default_culture_if_empty) {
        if (!$author) {
          $author = $this->getAuthor(sfConfig::get('sf_default_culture'));
        }
	  }
      return $author;
	}
}
