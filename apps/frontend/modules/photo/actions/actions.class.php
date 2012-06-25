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
  
 /**
  * Страница фото
  *
  * @param sfWebRequest $request
  */
  public function executeShow(sfWebRequest $request)
  {  	
  	// redirect to an album if not mobile version
  	/*if (sfContext::getInstance()->getConfiguration()->getEnvironment() != 'mobile') {
  		$this->photo = PhotoPeer::retrieveByPk( $request->getParameter('id') );
  		if ($this->photo) {
  			$photoalbum = $this->photo->getPhotoalbum();
  		}
  		if ($photoalbum) {
  			$this->redirect( $photoalbum->getUrl() . '#test' );
  			exit();
  		} else {
  			
  		}
  	}*/
  	
  	$this->id 	 = $request->getParameter('id');
  	$this->title = $request->getParameter('title');
  }
  
 /**
  * Пустая страница для подгрузки фото
  *
  * @param sfWebRequest $request
  */
  public function executeView(sfWebRequest $request)
  {  	  	

  }
  
  /**
   * Содержимое страницы фото
   *
   * @param sfWebRequest $request
   */
  public function executeContent(sfWebRequest $request)
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
  
  public function executeAlbum(sfWebRequest $request, $albumcontent = false)
  { 
  	// альбом
  	if (!$albumcontent) {
  		$this->photoalbum = PhotoalbumPeer::retrieveByPk( $this->getRequestParameter('id') );  		
    	$this->forward404Unless( $this->photoalbum );
  	}

  	$album_id = $this->getRequestParameter('id');
  	
    $c = new Criteria();
    PhotoPeer::addVisibleCriteria($c);
    if ($album_id) {
    	$c->add( PhotoPeer::PHOTOALBUM_ID, $album_id);
    } else {
    	$c->add( PhotoPeer::PHOTOALBUM_ID, null, Criteria::ISNULL);
    	$c->remove( PhotoPeer::SHOW );
    }
    $c->addAscendingOrderByColumn( PhotoPeer::ORDER );
    
    
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
    
    if (!$albumcontent) {
      $title = $this->photoalbum->getTitle();
      if ($title) {
        
        // проверка, соответствует ли переданный title названию альбома
        $title_translit = TextPeer::urlTranslit($title);
        if ( $request->getParameter('title') != $title_translit ) {
          $this->redirect( $this->photoalbum->getUrl() );
        }  	
        
        $response = $this->getResponse(); 
	    $response->setTitle($title);
      } elseif ($request->getParameter('title')) {
        // если у фотоальбома нет заголовка, а в URL он передан    
        $this->redirect( $this->photoalbum->getUrl() );
      }
    }
    
    // запоминаем адрес
    //$_SESSION['back_to_photo'] = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
  }  
  
  /**
   * List of albums
   *
   * @param sfWebRequest $request
   */
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
  
  /**
   * Content of the photos of album
   *
   * @param sfWebRequest $request
   */
  public function executeAlbumcontent(sfWebRequest $request)
  {  	
	$this->executeAlbum($request, true);
  }
  
  /**
   * Список альбомов и фотографий
   *
   * @param sfWebRequest $request
   */
  public function executeMap(sfWebRequest $request)
  {
	$c = new Criteria();
	$c->clearSelectColumns();
	$c->addSelectColumn(PhotoPeer::ID);
	$c->addSelectColumn(PhotoPeer::PHOTOALBUM_ID);
    PhotoPeer::addVisibleCriteria($c);
    
    $photo_list = PhotoPeer::doSelect($c);
    $map = array();
    foreach ($photo_list as $photo) {
	  $map[ $photo->getId() ] = $photo->getPhotoalbumId();
    }
    
    //echo json_encode($map);
    //return sfView::NONE;
    
    $this->getResponse()->setContentType('application/json');    
    $data_json = json_encode($map);
    
    $this->getResponse()->setContent($data_json);
    return sfView::NONE;
  }
  
}