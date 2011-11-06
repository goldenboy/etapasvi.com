<?php
 
class newsComponents extends sfComponents
{
  public function executeShow()
  {
  	$newsitem = NewsPeer::retrieveByPk( $this->id );
    if ($newsitem && $newsitem->getShow()) {
      $this->newsitem = $newsitem;
    }
  }
  public function executeShowShort()
  {
  	$newsitem = NewsPeer::retrieveByPk( $this->id );
    if ($newsitem && $newsitem->getShow()) {
      $this->newsitem = $newsitem;
    }
  }
  public function executeShowText()
  {
  	$newsitem = NewsPeer::retrieveByPk( $this->id );
    if ($newsitem && $newsitem->getShow()) {
      $this->newsitem = $newsitem;
    }
  }
  public function executeLatest()
  {
  	$c = new Criteria();
  	$c->add( NewsPeer::SHOW, 1);
  	//$c->add( NewsI18nPeer::BODY, '', Criteria::NOT_EQUAL );
  	NewsPeer::addVisibleCriteria( $c );
  	
  	$c->addDescendingOrderByColumn( NewsPeer::ORDER );
  	//$c->addDescendingOrderByColumn( NewsPeer::ID );
  	$c->setLimit(1);
  	$newslist = NewsPeer::doSelectWithI18n( $c );
  	$newsitem = $newslist[0];
    if ($newsitem) {
      $this->newsitem = $newsitem;
    } 
  }   
  
  public function executeShowwrapper($action)
  {
	$this->newsitem = NewsPeer::retrieveByPk( $this->id );

  	if ( sfContext::getInstance()->getActionName() != 'preview' && 
        (!$this->newsitem || !$this->newsitem->getBody() || !$this->newsitem->getShow())) 
    {
  		//sfActions::forward('default', 'error404');
  		//@sfActions::forward404('123');
  		throw new sfError404Exception();
  	}
    
  	$newitem_url = $this->newsitem->getUrl();
  	
  	// если адрес новости неверный, редиректим на нужный адрес
  	$url_parse = parse_url($newitem_url);
  	if ( (!empty($_SERVER['PATH_INFO']) && preg_replace("/\?.*/", "", $_SERVER['PATH_INFO']) != $url_parse['path']) || 
  		 (!empty($_SERVER['REQUEST_URI']) && preg_replace("/\?.*/", "", $_SERVER['REQUEST_URI']) != $url_parse['path'])
	) {
		sfActions::redirect( $newitem_url );
	}
  	
	// установка заголовка страницы
	$news_title = $this->newsitem->getTitle();
	
    $context = sfContext::getInstance();
    $i18n =  $context->getI18N();

    //$title = $i18n->__('Dharma Sangha') . ' -';
    $response = $this->getResponse(); 
    $response->setTitle($news_title); 
	
  	/*
  	$news_title = $this->newsitem->getTitle();
  	if ( $news_title ) {
  	  // если на страницу перешли с другого языка, то title неверный
  	  $news_title_translit = TextPeer::urlTranslit($news_title);
  	  
  	  if ( $this->title != $news_title_translit ) {
  		//$this->redirect( $this->newsitem->getTypeName() . '/show?id=' . (int)$this->id . '&title=' . $news_title_translit );
  		//sfActions::redirect( $this->newsitem->getTypeName() . '/show?id=' . (int)$this->id . '&title=' . $news_title_translit );
  		sfActions::redirect( $newitem_url );
  	  }
  		
	  $context = sfContext::getInstance();
	  $i18n =  $context->getI18N();
	
	  //$title = $i18n->__('Dharma Sangha') . ' -';
	  $response = $this->getResponse(); 
	  $response->setTitle($news_title);       	
  	} elseif (!$news_title && $this->title) {
	  // если у элемента нет Заголовка, а в URL передан title, редиректим
	  sfActions::redirect( $newitem_url );
    }*/
  } 
}