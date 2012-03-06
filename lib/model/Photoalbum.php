<?php

class Photoalbum extends BasePhotoalbum
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
		return date("Y.m.d", strtotime($this->getCreatedAt())) . ' - ' . $this->getTitle();
	}    
	
	/**
	 * Получение картинки альбома по первой фотогрфии
	 *
	 * @return unknown
	 */
	public function getImg() {
		$c = new Criteria();
	    $c->add( PhotoPeer::SHOW, 1);
	    $c->add( PhotoPeer::PHOTOALBUM_ID, $this->getId());
	    $c->addAscendingOrderByColumn( PhotoPeer::ORDER );		
		$first_photo = PhotoPeer::doSelectOne($c);
		
		if (!empty($first_photo) && $first_photo->getThumbUrl()) {
			return $first_photo->getThumbUrl();
		} else {
			return '';
		}
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
	 * Расширенный метод для получения текста.
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
      return trim($body);
	}
	
    /**
     * Получение ссылки на фотоальбом
     */
	public function getUrl($culture = '') {
	  if (empty($culture)){
		$culture = sfContext::getInstance()->getUser()->getCulture();
	  }	 
	  
      $url_pattern = 'photo/album?id=' . $this->getId();
	  
	  $title_translit = TextPeer::urlTranslit($this->getTitle( $culture ), $culture );
	  if (!empty($title_translit)) {
	    $url_pattern .= '&title=' . $title_translit;
	  }

	  $url = sfContext::getInstance()->getController()->genUrl($url_pattern, true, $culture);
	  return $url;
	}
	
	/**
	 * Получение авторов фото в фотоальбоме.
	 *
	 */
	public function getAllAuthors($culture = '', $photo_list = array()) 
	{
		$authors = array();
		// если список фото не передан, получаем фотографии
		// забиваем
		/*if (empty($photo_list)) {
			
		    $c = new Criteria();
		    $c->add( PhotoPeer::SHOW, 1);
		    $c->add( PhotoPeer::PHOTOALBUM_ID, $this->getId());
		    PhotoPeer::addVisibleCriteria($c);
		    
		    $photo_list = PhotoPeer::doSelectWithI18n($c);
		}*/
		//$authors = explode(',', $this->getAuthor($culture));
		foreach ($photo_list as $photo) {
			$author = trim($photo->getAuthor($culture, true));
			// skip unknown authors
			if ($author == '?') {
				continue;
			}
			if ($author && !in_array($author, $authors)) {
				$authors[] = $author;
			}
		}

		return implode(', ', $authors);
	}
}
