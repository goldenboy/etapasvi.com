<?php

class SubscribePeer extends BaseSubscribePeer
{	 
  public static function addSubscribe( $user_id, $item_id, $item_type, $item_lang ) {
  	$subscribe = new Subscribe();
  	$subscribe->setUserId( $user_id );
  	$subscribe->setItemId( $item_id );
  	$subscribe->setItemType( $item_type );
  	$subscribe->setItemLang( $item_lang );
  	try {
  	  $subscribe->save();  	
  	  
  	  // очищаем кэш всех комментариев
	  //$cacheManager = sfContext::getInstance()->getViewCacheManager();
	  //$cacheManager->remove('@sf_cache_partial?module=comments&action=_show&sf_cache_key=*');
	  
  	} catch (Exception $e) { }
  }
	 	
  public static function isSubscribed( $item_id, $item_type, $item_lang )
  {
  	if ( !UserPeer::authIsLoggedIn() ) {
  		return false;
  	}
  	
	$c = new Criteria();
	$c->add( SubscribePeer::USER_ID, UserPeer::authUserId() );
	$c->add( SubscribePeer::ITEM_ID, $item_id );
	$c->add( SubscribePeer::ITEM_TYPE, $item_type );
	$c->add( SubscribePeer::ITEM_LANG, $item_lang );
	//$subscribe = SubscribePeer::doSelectOne( $c );
	$subscribe = SubscribePeer::doCount( $c );
	if ($subscribe) {
	  return true;
	} else {
	  return false;
	}
  }
  
  public static function alertSubscribers( $item_id, $item_type, $item_by_user, $item_lang ) {
  	// получение подписанных пользователей
	$c = new Criteria();
	$c->add( SubscribePeer::ITEM_ID, $item_id );
	$c->add( SubscribePeer::ITEM_TYPE, $item_type );
	$c->add( SubscribePeer::ITEM_LANG, $item_lang );
	// себя не надо оповещать
	$c->add( SubscribePeer::USER_ID, UserPeer::authUserId(), Criteria::NOT_EQUAL );
	$subscribers = SubscribePeer::doSelect( $c );	
	
	foreach ($subscribers as $subscriber) {
	  AlertPeer::addAlert( 
		$subscriber->getUser(), 
		$item_type, 
		$item_id, 
		sfContext::getInstance()->getUser()->getCulture(),
		$item_by_user,
		true
	  );
	}

	// уведомление админу
	AlertPeer::addAlert( 
		UserPeer::getAdminUser(), 
		$item_type, 
		$item_id, 
		sfContext::getInstance()->getUser()->getCulture(),
		$item_by_user,
		true
	  );
  }  
  
  public static function getSubscriptions( $user_id, $item_type )
  {
  	if ( !UserPeer::authIsLoggedIn() ) {
  		return array();
  	}
  	
	$c = new Criteria();
	$c->add( SubscribePeer::USER_ID, $user_id );
	$c->add( SubscribePeer::ITEM_TYPE, $item_type );
	$c->addDescendingOrderByColumn( SubscribePeer::CREATED_AT );
		
	$subscriptions = SubscribePeer::doSelect( $c );
	return $subscriptions;
  }  
}
