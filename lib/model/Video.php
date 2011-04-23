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
	
	public function getCommentsCount()
	{		
		return (int)CommentsPeer::getCommentsCount( ItemtypesPeer::ITEM_TYPE_NAME_VIDEO, $this->getId() );
	}
	public function getBodyPrepared() {
		/*$body = $this->getBody();
		$body = nl2br($body);
		$body = str_ireplace( '<br />', '&nbsp;</p><p>', $body );
		return $body;*/
		return TextPeer::prepareText( $this->getBody() );
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
	  
	  $url = UserPeer::SITE_PROTOCOL  . '://' . UserPeer::SITE_ADDRESS . '/' . $culture . '/video/show/id/' . $this->getId();
	  $title_translit = TextPeer::urlTranslit($this->getTitle($culture), $culture);
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
	  return TextPeer::subStr($this->getBody(), NewsPeer::RSS_DESCRIPTION_LENGTH);
	}
	
	/**
	 * Дата публикации для RSS.
	 *
	 * @return unknown
	 */
	public function getRssPubDate() {
	  return max($this->getUpdatedAt(), $this->getUpdatedAtExtra());
	}
}
