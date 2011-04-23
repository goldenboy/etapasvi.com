<?php
 
class item2itemComponents extends sfComponents
{
  public function executeShow()
  {
  	if (empty($this->item_type) || empty($this->item_id)) {
  	  return;
  	}
  	
  	// получаем привязанные Новости
  	/*
  	$c = new Criteria();
  	$c->add( News2videoPeer::VIDEO_ID, $request->getParameter('id') );
  	$c->addJoin( NewsI18nPeer::ID, News2videoPeer::NEWS_ID );  	
  	$c->add( NewsI18nPeer::CULTURE, sfContext::getInstance()->getUser()->getCulture() );
  	$c->add( NewsI18nPeer::BODY, '', Criteria::NOT_EQUAL );
  	
  	$this->news_list = News2videoPeer::doSelect($c);*/
  	$this->news_list 	   = Item2itemPeer::getRelatedObjects($this->item_type, $this->item_id, ItemtypesPeer::ITEM_TYPE_NEWS );
  	$this->photoalbum_list = Item2itemPeer::getRelatedObjects($this->item_type, $this->item_id, ItemtypesPeer::ITEM_TYPE_PHOTOALBUM );
  	$this->video_list 	   = Item2itemPeer::getRelatedObjects($this->item_type, $this->item_id, ItemtypesPeer::ITEM_TYPE_VIDEO );
  	$this->audio_list 	   = Item2itemPeer::getRelatedObjects($this->item_type, $this->item_id, ItemtypesPeer::ITEM_TYPE_AUDIO );
  	
  	/*
  	// получаем привязанные Фотоальбомы
  	$c = new Criteria();
  	$c->add( News2photoalbumPeer::NEWS_ID, $request->getParameter('id') );
  	$c->addJoin( PhotoalbumPeer::ID, News2photoalbumPeer::PHOTOALBUM_ID );
  	$c->add( PhotoalbumPeer::SHOW, 1 );

  	$this->photoalbum_list = News2photoalbumPeer::doSelect($c);	
  	  	
  	// получаем привязанные Видео
  	$c = new Criteria();
  	$c->add( News2videoPeer::NEWS_ID, $request->getParameter('id') );
  	$c->addJoin( VideoPeer::ID, News2videoPeer::VIDEO_ID );
  	$c->addJoin( VideoI18nPeer::ID, VideoPeer::ID );
  	$c->add( VideoI18nPeer::CODE, '', Criteria::NOT_EQUAL );
  	$c->add( VideoI18nPeer::CULTURE, sfContext::getInstance()->getUser()->getCulture() );

  	$this->video_list = News2videoPeer::doSelect($c);  	
  	*/

  }   
}