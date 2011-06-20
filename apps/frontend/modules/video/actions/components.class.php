<?php
 
class videoComponents extends sfComponents
{
  public function executeShow()
  {
  	$this->video = VideoPeer::retrieveByPk( $this->id );
    //$this->short = true;
  }
  public function executeLatest()
  {
  	$c = new Criteria();
  	$c->addDescendingOrderByColumn( VideoPeer::ID );
    $c->add( VideoPeer::SHOW, 1);
    //$c->add( VideoI18nPeer::CODE, '', Criteria::NOT_EQUAL );   
    VideoPeer::addVisibleCriteria($c);
  	$c->setLimit( 3 );
  	
  	$video_list = VideoPeer::doSelectWithI18n( $c );
  	
    if ($video_list) {
      $this->video_list = $video_list;
    } 
  }  
  
  public function executeShowwrapper($action)
  {  	
	$this->video = VideoPeer::retrieveByPk( $this->id );
  	//$this->forward404Unless( $this->video && $this->video->getCode() && $this->video->getShow() );  
  	$culture = sfContext::getInstance()->getUser()->getCulture();
  	
  	if (!$this->video || !$this->video->getCode($culture, $this->video->getAllCultures()) || !$this->video->getShow()) {
  		//@sfActions::forward('default', 'error404');
  		throw new sfError404Exception();
  	}	

  	$video_title = $this->video->getTitle();
  	
  	if ($video_title) {
  		
  		// если на траницу перешли с другого языка, то title неверный
  		$video_title_translit = TextPeer::urlTranslit($video_title);
  		if ( $this->title != $video_title_translit ) {
  			//sfActions::redirect( 'video/show?id=' . (int)$this->id . '&title=' . $video_title_translit );
  			sfActions::redirect( $this->video->getUrl() );
  		}
  		
	    $context = sfContext::getInstance();
	    $i18n =  $context->getI18N();
	    
	    //$title = $i18n->__('Dharma Sangha') . ' -';	    
	    $response = $this->getResponse(); 
	    $response->setTitle($video_title);	
  	} elseif (!$video_title && $this->title) {
  		// если у элемента нет Заголовка, а в URL передан title, редиректим
  		sfActions::redirect( 'video/show?id=' . (int)$this->id);
  	}
  }
 
}