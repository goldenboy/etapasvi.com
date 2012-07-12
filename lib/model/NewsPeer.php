<?php

class NewsPeer extends BaseNewsPeer
{
  const THUMB_WIDTH 	= 100;	
  const THUMB_HEIGHT 	= 100;  
  
  // ширина полного изображения в новости - по ширине контента
  const IMG_WIDTH 		= 546;	
  const IMG_HEIGHT 		= 546;   
  
  const NEWS_PER_PAGE 	= 5;
  
  // number of news displayed in the latest section
  const LATEST_COUNT 	= 1;
  
  // период, за который отображаются элементы в RSS
  const RSS_PERIOD 	    		= '-3 month';
  // максимальная длина Описания для RSS
  const RSS_DESCRIPTION_LENGTH  = 400;
  
  // директории на сервере
  // и одновременно названия альбомов в удалённом хранилище
  const FULL_DIR 		= 'news';  
  const THUMB_DIR 		= 'news/thumb';
  
  const PHOTO_DIR 	    = 'news';
  
  // Лента новостей
  public static $feed_item_types 	    = array(
  	ItemtypesPeer::ITEM_TYPE_NAME_NEWS, 		
  	ItemtypesPeer::ITEM_TYPE_NAME_PHOTO, 	
  	ItemtypesPeer::ITEM_TYPE_NAME_VIDEO, 	
  	ItemtypesPeer::ITEM_TYPE_NAME_AUDIO	
  );
  
  const FEED_ITEMS_PER_PAGE = 50;
  
  /**
   * Проверка есть ли контент на определённом языке
   *
   * @param unknown_type $item_id
   * @param unknown_type $item_lang
   */
  public static function hasCultureContent($item_id, $item_lang)
  {
    $c = new Criteria();
    $c->add( NewsPeer::ID, $item_id );
    $c->addJoin( NewsPeer::ID, NewsI18nPeer::ID );
    $c->add( NewsI18nPeer::CULTURE, $item_lang );    
    //$c->add( NewsI18nPeer::BODY, '', Criteria::NOT_EQUAL );
    self::addVisibleCriteria( $c );
    
    $news_list = NewsPeer::doSelectOne($c);
    
    if (count($news_list)) {
      return true;
    } else {
      return false;
    }
  }
  
  /**
   * Добавляет условие, при котором элемент отображается на языке пользователя
   *
   * @param unknown_type $c
   */
  public static function addVisibleCriteria($c)
  {  
    $c->add( NewsPeer::SHOW, 1 );    
    $c->add( NewsI18nPeer::BODY, '', Criteria::NOT_EQUAL );    
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
  
  /**
   * Get URL of News by ID
   */
  public static function getUrl($id)
  {
    $newsitem = NewsPeer::retrieveByPk( $id );
    if ($newsitem) {
        return $newsitem->getUrl();
    } else {
        return '';
    }
  }
}
