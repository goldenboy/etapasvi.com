<?php

/**
 * idea actions.
 *
 * @package    sf_sandbox
 * @subpackage idea
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class photoActions extends sfActions
{
 /*
  public function executeShow(sfWebRequest $request)
  {
  	$this->photo = PhotoPeer::retrieveByPk( $request->getParameter('id') );
  	$this->forward404Unless( $this->photo );
  	
  	// получение следующей и предыдущей фотографии
  	$c = new Criteria();
    $c->add( PhotoPeer::SHOW, 1);
    $c->add( PhotoPeer::ID, $this->photo->getId(), Criteria::NOT_EQUAL);
    $c->add( PhotoPeer::ORDER, $this->photo->getOrder(), Criteria::LESS_EQUAL);
    $c->addDescendingOrderByColumn( PhotoPeer::ORDER );
    $this->next_photo = PhotoPeer::doSelectOne( $c );
    
  	$c = new Criteria();
    $c->add( PhotoPeer::SHOW, 1);
    $c->add( PhotoPeer::ID, $this->photo->getId(), Criteria::NOT_EQUAL);
    $c->add( PhotoPeer::ORDER, $this->photo->getOrder(), Criteria::GREATER_EQUAL);
    $c->addAscendingOrderByColumn( PhotoPeer::ORDER );
    $this->prev_photo = PhotoPeer::doSelectOne( $c );
    
  	
  	// ссылка назад
  	if ($_SESSION['back_to_photo'] != '') {
  	  $this->back_to_photo = $_SESSION['back_to_photo'];
  	}
  	// заголовок страницы
  	$photo_title = $this->photo->getTitle();
  	if ( $photo_title ) {
  		
  	    // если на траницу перешли с другого языка, то title неверный
  	    $photo_title_translit = TextPeer::urlTranslit($photo_title);
  	    if ( $request->getParameter('title') != $photo_title_translit ) {
    	  $this->redirect( 'photo/show?id=' . (int)$request->getParameter('id') . '&title=' . $photo_title_translit );
    	}  		
  		
	    $context = sfContext::getInstance();
	    $i18n =  $context->getI18N();
	    
	    $title = $i18n->__('Palden Dorje') . ' -';	    
	    $response = $this->getResponse(); 
	    $response->setTitle($title . ' ' . $photo_title . ' - eTapasvi.com'); 	
  	}
  }*/
  
  public function executeShow(sfWebRequest $request)
  {  	
  	$this->id 	 = $request->getParameter('id');
  	$this->title = $request->getParameter('title');
  }
  /*
  public function executeIndex(sfWebRequest $request)
  {  	
    $c = new Criteria();
    $c->add( PhotoPeer::SHOW, 1);
    $c->addDescendingOrderByColumn( PhotoPeer::ORDER );
    
	//$pager = new sfPropelPagerI18n('Photo', PhotoPeer::ITEMS_PER_PAGE);
    //$pager->setCriteriaI18n($c);
	$pager = new sfPropelPager('Photo', PhotoPeer::ITEMS_PER_PAGE);
    $pager->setCriteria($c);    
    $pager->setPage($this->getRequestParameter('page', 1));
    $pager->init();
    $this->pager = $pager;
    
    // если передан номер страницы больше, чем имеется страниц
    if ($request->getParameter('page') > $this->pager->getLastPage()) {
    	$this->forward404();
    }    
    
    // запоминаем адрес
    $_SESSION['back_to_photo'] = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
  }*/
  
  public function executeAlbum(sfWebRequest $request)
  { 
  	// альбом
  	$this->photoalbum = PhotoalbumPeer::retrieveByPk( $this->getRequestParameter('id') );
  		
    $this->forward404Unless( $this->photoalbum );
    
    $c = new Criteria();
    $c->add( PhotoPeer::SHOW, 1);
    $c->add( PhotoPeer::PHOTOALBUM_ID, $this->getRequestParameter('id'));
    $c->addAscendingOrderByColumn( PhotoPeer::ORDER );
    PhotoPeer::addVisibleCriteria($c);
    
	//$pager = new sfPropelPagerI18n('Photo', PhotoPeer::ITEMS_PER_PAGE);
    //$pager->setCriteriaI18n($c);
	$pager = new sfPropelPager('Photo', PhotoPeer::ITEMS_PER_PAGE);
    $pager->setCriteria($c);    
    $pager->setPage($this->getRequestParameter('page', 1));
    $pager->init();
    $this->pager = $pager;
    
    // если передан номер страницы больше, чем имеется страниц
    if ($request->getParameter('page') > $this->pager->getLastPage()) {
    	$this->forward404();
    }    
    
    // запоминаем адрес
    //$_SESSION['back_to_photo'] = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
  }  
  
  public function executeAlbums(sfWebRequest $request)
  {  	
    $c = new Criteria();
    $c->add( PhotoalbumPeer::SHOW, 1);
    $c->addDescendingOrderByColumn( PhotoalbumPeer::ORDER );

	$pager = new sfPropelPager('Photoalbum', PhotoalbumPeer::ITEMS_PER_PAGE);
    $pager->setCriteria($c);    
    $pager->setPage($this->getRequestParameter('page', 1));
    $pager->init();
    $this->pager = $pager;
    
    // если передан номер страницы больше, чем имеется страниц
    if ($request->getParameter('page') > $this->pager->getLastPage()) {
    	$this->forward404();
    }    
  }
  
}