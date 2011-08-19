<?php
 
class photoComponents extends sfComponents
{
  public function executeShow()
  {
  	$this->photo = PhotoPeer::retrieveByPk( $this->id );
    $this->short = true;
    $this->embed = true;
  }
  
  public function executePreview()
  {
  	$this->photo = PhotoPeer::retrieveByPk( $this->id );
  }

  public function executeLatest()
  {
  	/*
  	$c = new Criteria();
    $c->add( PhotoPeer::SHOW, 1);
    $c->addDescendingOrderByColumn( PhotoPeer::ID );
  	$c->addGroupByColumn( PhotoPeer::PHOTOALBUM_ID );
    //$c->addAscendingOrderByColumn( PhotoPeer::ID );
  	//$c->setDistinct( PhotoPeer::PHOTOALBUM_ID );
  	//$c->addHaving($c->getNewCriterion(PhotoPeer::ID, PhotoPeer::ID.'= MAX('.PhotoPeer::ID.')', Criteria::CUSTOM));
  	$c->add(PhotoPeer::ID, PhotoPeer::ID.'= MAX('.PhotoPeer::ID.')', Criteria::CUSTOM);
    */
  	
  	$photo_list = array();
  	
    // выбираем первую
    $c = new Criteria();
    $c->add( PhotoPeer::SHOW, 1);
    $c->addDescendingOrderByColumn( PhotoPeer::ID );
    $c->setLimit( 1 );
    $first_photo_list = PhotoPeer::doSelectWithI18n( $c );
    if (!$first_photo_list) {
    	$first_photo_list = PhotoPeer::doSelect( $c );
    }
    $photo_list[] = $first_photo_list[0];
  	    
    if (!empty($photo_list[0])) {
    	$prev_ids = array();
    	$prev_ids[] = $photo_list[0]->getPhotoalbumId();
        for($i=0; $i<PhotoPeer::LATEST_COUNT-1; $i++) {
		   
		    $c = new Criteria();
		    $c->add( PhotoPeer::SHOW, 1);	
		    $c->add( PhotoPeer::PHOTOALBUM_ID, $prev_ids, Criteria::NOT_IN);    

		    $c->addDescendingOrderByColumn( PhotoPeer::ID );
		    $c->setLimit( 1 );
		    $next_photo_list        = PhotoPeer::doSelectWithI18n( $c );
		    if (!$next_photo_list) {
		    	$next_photo_list = PhotoPeer::doSelect( $c );
		    }
		    if ($next_photo_list[0]) {
		        $prev_ids[]   = $next_photo_list[0]->getPhotoalbumId();
		    }
		    $photo_list[] = $next_photo_list[0];
        }
    }
    $this->photo_list = $photo_list;
      	/*
  	$c->setLimit( 3 );
  	$photo_list = PhotoPeer::doSelect( $c );
  	
    if ($photo_list) {
      $this->photo_list = $photo_list;
    } */
  }  
  
  public function executeShowwrapper($action)
  {
  	if (empty($this->photo)) {
	  $this->photo = PhotoPeer::retrieveByPk( $this->id );
  	}
  	//$this->forward404Unless( $this->photo );
  	if (!$this->photo) {
  		//$action->redirect( $this->photo );
  		//sfActions::forward('photo', 'index');
  		//@sfActions::forward('default', 'error404');
  		throw new sfError404Exception();
  	}
  	
  	$photo_title = $this->photo->getTitle();
  	if ( $photo_title ) {
  		
  	    // если на траницу перешли с другого языка, то title неверный
  	    $photo_title_translit = TextPeer::urlTranslit($photo_title);
  	    
  	    // чтобы в том случае, если со страницы фото был запрос за content и title изменился,
  	    // редиректить content на этот title не надо
  	    if ( $this->title != $photo_title_translit && sfContext::getInstance()->getActionName() != 'content') {
    	  //$this->redirect( 'photo/show?id=' . (int)$this->id . '&title=' . $photo_title_translit );
    	  //sfActions::redirect( 'photo/show?id=' . (int)$this->id . '&title=' . $photo_title_translit );
    	  sfActions::redirect( $this->photo->getUrl() );
    	}
  		
	    $context = sfContext::getInstance();
	    $i18n =  $context->getI18N();
	    
	    //$title = $i18n->__('Dharma Sangha') . ' -';	    
	    $response = $this->getResponse(); 
	    $response->setTitle($photo_title); 	
  	} elseif (!$photo_title && $this->title) {
  		// если у элемента нет Заголовка, а в URL передан title, редиректим
  		sfActions::redirect( $this->photo->getUrl() );
  	}
  	
  	$photoalbum = $this->photo->getPhotoalbum();
  	if (!empty($photoalbum)) {
  		$photoalbum_id = $photoalbum->getId();
  	}
  	
  	// получение следующей и предыдущей фотографии
  	$c = new Criteria();
    $c->add( PhotoPeer::SHOW, 1);
    $c->add( PhotoPeer::ID, $this->photo->getId(), Criteria::NOT_EQUAL);
    if (!empty($photoalbum_id)) {
      $c->add( PhotoPeer::PHOTOALBUM_ID, $photoalbum_id);
    }
    $c->add( PhotoPeer::ORDER, $this->photo->getOrder(), Criteria::GREATER_EQUAL);
    $c->addAscendingOrderByColumn( PhotoPeer::ORDER );
    $this->next_photo = PhotoPeer::doSelectOne( $c );
    
  	$c = new Criteria();
    $c->add( PhotoPeer::SHOW, 1);
    $c->add( PhotoPeer::ID, $this->photo->getId(), Criteria::NOT_EQUAL);
    if (!empty($photoalbum_id)) {
      $c->add( PhotoPeer::PHOTOALBUM_ID, $photoalbum_id);
    }
    $c->add( PhotoPeer::ORDER, $this->photo->getOrder(), Criteria::LESS_EQUAL);
    $c->addDescendingOrderByColumn( PhotoPeer::ORDER );
    $this->prev_photo = PhotoPeer::doSelectOne( $c );         	
  }
}