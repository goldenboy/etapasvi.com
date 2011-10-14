<?php

class Item2itemPeer extends BaseItem2itemPeer
{
  /**
   * Получение объекта по ID и типу
   *
   * @param unknown_type $item_type
   * @param unknown_type $item_id
   * @return unknown
   */
  public static function getItem($item_type1_name, $item_id)
  {
  	$peer_class_name = ucfirst($item_type1_name) . 'Peer';
  	// работает только в PHP 5.3
  	//$element = $peer_name::retrieveByPK( $this->getItem1Id());  	
  	if (class_exists($peer_class_name)) {
  	  // вызываем статический метод нужного статического класса
  	  $fn = array($peer_class_name, 'retrieveByPK');
  	  try {
  	    $element = call_user_func( $fn, $item_id );  	  
  	  } catch (Exception $e) {
  	  	return false;
  	  }
      return $element;
  	} else {
  	  return false;
  	}
  }
  
  /**
   * Получение заголовка элемента по Типу и ID
   *
   * @param unknown_type $item_type
   * @param unknown_type $item_id
   * @return unknown
   */
  public static function getItemTitle($item_type1_name, $item_id)
  { 
  	$element = Item2itemPeer::getItem( $item_type1_name, $item_id );

  	if ($element) {
  	  return $element->getTitle();
  	} else {
  	  return '';
  	}
  }
  
  /**
   * Получение элементов определённого типа, связанных с данным.
   *
   * @param unknown_type $item1_type можно передавать ID либо название
   * @param unknown_type $item1_id можно передавать ID либо название
   * @param unknown_type $item2_type
   * @return unknown
   */
  public static function getRelatedObjects($item1_type, $item1_id, $item2_type)
  { 
  	if (!is_int($item1_type)) {
  	  $item1_type = ItemtypesPeer::getItemTypeId($item1_type);
  	}
  	$item_type1_name = ItemtypesPeer::getItemTypeName($item1_type);
  	
  	if (!is_int($item2_type)) {  	  
  	  $item2_type = ItemtypesPeer::getItemTypeId($item2_type);
  	}
  	$item_type2_name = ItemtypesPeer::getItemTypeName($item2_type);
  	
  	$peer_class      = ucfirst($item_type2_name) . 'Peer';
  	//$peer_i18n_class = ucfirst(ItemtypesPeer::getItemTypeName($item_type_id)) . 'I18nPeer';
  	//$peer_class_vars = get_class_vars('BaseVideoPeer');

  	// слева
  	$c = new Criteria();  	  	  
  	$c->add( Item2itemPeer::ITEM1_TYPE, $item1_type );
  	$c->add( Item2itemPeer::ITEM1_ID, $item1_id );
  	
  	$c->add( Item2itemPeer::ITEM2_TYPE, $item2_type );
  	$c->addJoin( strtolower($item_type2_name) . '.ID', Item2itemPeer::ITEM2_ID );  
  	$c->addJoin( strtolower($item_type2_name) . '.SHOW', 1 );  
  		 
  	// есть ли контент на языке пользователя  	 	 
	$fn = array($peer_class, 'addVisibleCriteria');

	try {
		call_user_func( $fn, $c );  	  
	} catch (Exception $e) {	 
	  return false;
	}

  	//$c->addJoin( NewsI18nPeer::ID, News2videoPeer::NEWS_ID );  	
  	//$c->add( NewsI18nPeer::CULTURE, sfContext::getInstance()->getUser()->getCulture() );
  	//$c->add( NewsI18nPeer::BODY, '', Criteria::NOT_EQUAL );
  	
	$fn = array($peer_class, 'doSelectWithI18n');
	try {
	  $objects1 = call_user_func( $fn, $c );  	  
	} catch (Exception $e) {	 
	  return false;
	}

	// справа
  	$c = new Criteria();  	  	  
  	$c->add( Item2itemPeer::ITEM2_TYPE, $item1_type );
  	$c->add( Item2itemPeer::ITEM2_ID, $item1_id );
  	
  	$c->add( Item2itemPeer::ITEM1_TYPE, $item2_type );
  	// Использование строки, как имени статического класса позволяет только PHP > 5.3, поэтому хардкодим
  	$c->addJoin( strtolower($item_type2_name) . '.ID', Item2itemPeer::ITEM1_ID );
  	$c->addJoin( strtolower($item_type2_name) . '.SHOW', 1 );

  	// есть ли контент на языке пользователя  	 	 
	$fn = array($peer_class, 'addVisibleCriteria');
	try {
		call_user_func( $fn, $c );  	  
	} catch (Exception $e) {	 
	  return false;
	}
  	

	$fn = array($peer_class, 'doSelectWithI18n');
	try {
	  $objects2 = call_user_func( $fn, $c );  	  
	} catch (Exception $e) {	 
	  return false;
	}
	return array_merge($objects1, $objects2);
  }    
  
  /**
   * Получение всех связанных объектов независимо от их типа
   *
   * @param unknown_type $item1_type
   * @param unknown_type $item1_id
   */
  public static function getAllRelatedObjects($item1_type, $item1_id)
  {
  	$objects = array();

  	// все типы элементов
  	$types = ItemtypesPeer::doSelect(new Criteria());
  	
  	// получение элементов отдельно по типам
  	foreach ($types as $type) {
  	  $related_objects = self::getRelatedObjects($item1_type, $item1_id, $type);
  	  if (count($related_objects)) {
  	    $objects = array_merge($objects, $related_objects);
  	  }
  	}
  	
  	return $objects;
  }
  
}
