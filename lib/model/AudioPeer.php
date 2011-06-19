<?php

class AudioPeer extends BaseAudioPeer
{
	
  const LATEST_COUNT 			= 1;
  
  // ссылка на файл в удалённом хранилище
  const REMOTE_URL 		= 'http://k002.kiwi6.com/uploads/hotlink/';
  
  // ссылка на скачивание из удалённого хранилища
  const REMOTE_DOWNLOAD_URL		= 'http://k002.kiwi6.com/download/';
  
  /**
   * Добавляет условие, при котором элемент отображается на языке пользователя
   *
   * @param unknown_type $c
   */
  public static function addVisibleCriteria($c)
  {  
    $c->add( AudioPeer::SHOW, 1 );
    $c->add( AudioPeer::REMOTE, '', Criteria::NOT_EQUAL );
    $c->add( AudioPeer::FILE, '', Criteria::NOT_EQUAL );
  }
  
  /**
   * Для RSS: добавляет условие, при котором элемент отображается на языке пользователя
   *
   * @param unknown_type $c
   */
  public static function addRssVisibleCriteria($c)
  {  
    self::addVisibleCriteria($c);
  }
  
  
	/*
  public static function getRandom()
  {
  	$audio = array();
  	$culture = sfContext::getInstance()->getUser()->getCulture();
  	
    if ( empty($_SESSION['audio_list']) || $_SESSION['audio_culture'] != $culture ) {              
        
  	  $c = new Criteria();
  	  $c->add( AudioPeer::SHOW, 1 );
  	  $c->add( AudioI18nPeer::TITLE, '', Criteria::NOT_EQUAL );
  	  //$c->add( AudioI18nPeer::CULTURE, $culture );

  	  $audio_list = AudioPeer::doSelectWithI18n( $c );  	    	  
  	  //$songs = AudioI18nPeer::doSelect( $c );  	    	  
  	  
	  $_SESSION['audio_list']      = $audio_list;
	  $_SESSION['audio_culture']   = $culture;
	  
  	} else {
  	  $audio_list = $_SESSION['audio_list'];
  	}      
  	
    //print_r( $audio_list );
	if (!empty($audio_list)) {
	  mt_srand( time() );
	  $i = mt_rand( 0, count($audio_list) - 1 );	
	  $audio = $audio_list[ $i ];
	} else {
	  $audio = false;
	}

	return $audio;  			
  }*/
}
