<?php

class NewstypesPeer extends BaseNewstypesPeer
{
  // ID элементов
  const NEWS_TYPE_NEWS  	 = 1;
  const NEWS_TYPE_TEACHINGS  = 2;
  const NEWS_TYPE_BOOKS      = 3;
  
  // Типы новостей
  static $type_names 	    = array(
  	self::NEWS_TYPE_NEWS 	   => 'news',
  	self::NEWS_TYPE_TEACHINGS  => 'teachings', 	
  	self::NEWS_TYPE_BOOKS  	   => 'books'  	
  );  
  
  public static function getTypeName( $type_id )
  {
  	return self::$type_names[ $type_id ];
  }
}
