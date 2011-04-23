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
          $title = $this->getTitle(UserPeer::DEFAULT_CULTURE);
        }
	  }
      return trim($title);
	}
}
