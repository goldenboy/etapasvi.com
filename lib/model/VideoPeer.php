<?php

class VideoPeer extends BaseVideoPeer
{ 
  const ITEMS_PER_PAGE = 9;
  const TITLE_LENGTH   = 55; //38;
  
  /**
   * Проверка есть ли контент на определённом языке
   *
   * @param unknown_type $item_id
   * @param unknown_type $item_lang
   */
  public static function hasCultureContent($item_id, $item_lang)
  {
    $c = new Criteria();
    $c->add( VideoPeer::ID, $item_id );
    $c->addJoin( VideoPeer::ID, VideoI18nPeer::ID );
    $c->add( VideoI18nPeer::CULTURE, $item_lang );    
    //$c->add( VideoI18nPeer::CODE, '', Criteria::NOT_EQUAL );
    self::addVisibleCriteria($c);
    
    $video_list = VideoPeer::doSelect($c);
    
    if (count($video_list)) {
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
    $c->add( VideoPeer::SHOW, 1 );
    $c->add( VideoI18nPeer::CODE, '', Criteria::NOT_EQUAL );
    
    $c_all_cultueres = $c->getNewCriterion(VideoI18nPeer::CODE, '', Criteria::NOT_EQUAL);
    $c_all_cultueres->addOr( $c->getNewCriterion(VideoPeer::ALL_CULTURES, 1) );

	$c->add($c_all_cultueres);
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
  
}
