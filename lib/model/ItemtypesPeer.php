<?php
/**
 * Типы дублируются в БД
 *
 */
class ItemtypesPeer extends BaseItemtypesPeer
{
  // ID элементов
  const ITEM_TYPE_NEWS  	 = 1;
  const ITEM_TYPE_PHOTOALBUM = 2;
  const ITEM_TYPE_VIDEO 	 = 3;
  const ITEM_TYPE_PHOTO 	 = 4;
  //const ITEM_TYPE_MAIL 	     = 5;
  const ITEM_TYPE_AUDIO	     = 5;
  
  // названия элементов
  const ITEM_TYPE_NAME_NEWS  	  = 'News';
  const ITEM_TYPE_NAME_PHOTOALBUM = 'Photoalbum';
  const ITEM_TYPE_NAME_VIDEO 	  = 'Video';
  const ITEM_TYPE_NAME_PHOTO 	  = 'Photo';
  const ITEM_TYPE_NAME_AUDIO 	  = 'Audio';
  
  // Названия элементов
  static $item_type_names 	    = array(
  	self::ITEM_TYPE_NEWS 	   => self::ITEM_TYPE_NAME_NEWS,
  	self::ITEM_TYPE_PHOTOALBUM => self::ITEM_TYPE_NAME_PHOTOALBUM,
  	self::ITEM_TYPE_VIDEO      => self::ITEM_TYPE_NAME_VIDEO,
  	self::ITEM_TYPE_PHOTO      => self::ITEM_TYPE_NAME_PHOTO,
  	self::ITEM_TYPE_AUDIO      => self::ITEM_TYPE_NAME_AUDIO,
  );
  
  /**
   * Получение названия типа по ID.
   *
   * @param unknown_type $item_type_id
   * @return unknown
   */
  public static function getItemTypeName( $item_type_id )
  {
  	return self::$item_type_names[ $item_type_id ];
  }
  
  /**
   * Получение ID по названию типа.
   *
   * @param unknown_type $item_type_id
   * @return unknown
   */
  public static function getItemTypeId( $item_type_name )
  {
  	foreach (self::$item_type_names as $id=>$name) {
  	  if (strtolower($name) == strtolower($item_type_name)) {
  	  	return $id;
  	  }
  	}
  	return '';
  }
  
  public static function getItemTypeNameLower( $item_type_id )
  {
  	return strtolower(self::$item_type_names[ $item_type_id ]);
  }
  
//  /**
//   * URL элемента
//   *
//   * @param unknown_type $item_lang
//   * @param unknown_type $item_id
//   * @param unknown_type $item_type
//   * @return unknown
//   */
//  public static function getItemUrl( $item_lang, $item_id, $item_type )
//  {         	
//	$url = UserPeer::SITE_123PROTOCOL . '://' . UserPeer::SITE_XXX_ADDRESS . '/' 
//			. $item_lang . '/' . self::getItemTypeNameLower( $item_type ) 
//			. '/show/id/' . $item_id . '/';       
//	return $url;
//  }
  
//  public static function getItemTypeId( $item_type_name )
//  {
//    foreach (self::$item_type_names as $item_type => $name ) {
//  	  if (strtolower($name) == strtolower($item_type_name)) {
//
//  		return $item_type;
//  	  }
//    }
//    return 0;
//  }
  
//  /**
//   * Получение заголовка элемента по типу
//   *
//   * @param unknown_type $item_id
//   * @param unknown_type $item_type
//   * @param unknown_type $item_lang
//   * @return unknown
//   */
//  static public function getItemTitle( $item_id, $item_type, $item_lang )
//  {
//	// получение названия элемента		
//    $c = new Criteria();
//    
//	switch ($item_type) {
//        
//      case ItemtypesPeer::ITEM_TYPE_NEWS:          	
//      	$c->add( NewsI18nPeer::ID, $item_id );
//      	$c->add( NewsI18nPeer::CULTURE, $item_lang );
//      	$c->addSelectColumn( NewsI18nPeer::TITLE );
//      	$item = NewsI18nPeer::doSelectOne( $c );          	          
//        break;
//        
//      case ItemtypesPeer::ITEM_TYPE_PHOTO:
//      	$c->add( PhotoI18nPeer::ID, $item_id );
//      	$c->add( PhotoI18nPeer::CULTURE, $item_lang );
//      	$c->addSelectColumn( PhotoI18nPeer::TITLE );
//      	$item = PhotoI18nPeer::doSelectOne( $c );
//        break;
//        
//      case ItemtypesPeer::ITEM_TYPE_VIDEO:
//      	$c->add( VideoI18nPeer::ID, $item_id );
//      	$c->add( VideoI18nPeer::CULTURE, $item_lang );
//      	$c->addSelectColumn( VideoI18nPeer::TITLE );
//      	$item = VideoI18nPeer::doSelectOne( $c );          
//        break;
//        
//      case ItemtypesPeer::ITEM_TYPE_MAIL:
//      	$c->add( MailI18nPeer::ID, $item_id );
//      	$c->add( MailI18nPeer::CULTURE, $item_lang );
//      	$c->addSelectColumn( MailI18nPeer::TITLE );
//      	$item = MailI18nPeer::doSelectOne( $c );          
//        break;
//	}
//  	if ($item) {
//    	return $item->getTitle();
//  	} else {
//  		return '';
//  	}
//  }
  
//  /**
//   * Получение элементов по типам
//   *
//   * @param unknown_type $item_id
//   * @param unknown_type $item_type
//   * @param unknown_type $item_lang
//   * @return unknown
//   */
//  static public function getItem( $item_id, $item_type, $item_lang )
//  {
//	// получение названия элемента		
//    $c = new Criteria();
//    
//	switch ($item_type) {
//        
//      case ItemtypesPeer::ITEM_TYPE_NEWS:          	
//      	$c->add( NewsI18nPeer::ID, $item_id );
//      	$c->add( NewsI18nPeer::CULTURE, $item_lang );
//      	$item = NewsI18nPeer::doSelectOne( $c );          	          
//        break;
//        
//      case ItemtypesPeer::ITEM_TYPE_PHOTO:
//      	$c->add( PhotoI18nPeer::ID, $item_id );
//      	$c->add( PhotoI18nPeer::CULTURE, $item_lang );
//      	$item = PhotoI18nPeer::doSelectOne( $c );
//        break;
//        
//      case ItemtypesPeer::ITEM_TYPE_VIDEO:
//      	$c->add( VideoI18nPeer::ID, $item_id );
//      	$c->add( VideoI18nPeer::CULTURE, $item_lang );
//      	$item = VideoI18nPeer::doSelectOne( $c );          
//        break;
//        
//      case ItemtypesPeer::ITEM_TYPE_MAIL:
//      	$c->add( MailI18nPeer::ID, $item_id );
//      	$c->add( MailI18nPeer::CULTURE, $item_lang );
//      	$item = MailI18nPeer::doSelectOne( $c );          
//        break;
//	}
//
//    return $item;
//  }
    
}
