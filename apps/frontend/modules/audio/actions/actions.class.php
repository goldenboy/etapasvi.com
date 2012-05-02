<?php

/**
 * audio actions.
 *
 * @package    sf_sandbox
 * @subpackage audio
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class audioActions extends sfActions
{
 
  public function executeShow(sfWebRequest $request)
  {  	
  	$this->id 	 = $request->getParameter('id');
  	$this->title = $request->getParameter('title');	
  	
  	$this->audio = AudioPeer::retrieveByPk( $this->id );
  	
  	$culture     = sfContext::getInstance()->getUser()->getCulture();
  	
  	if (!$this->audio || !$this->audio->getShow()) {
  		throw new sfError404Exception();
  	}
  	
  	// проверка title
  	$audio_title = $this->audio->getTitle();
  	
  	if ($audio_title) {  		
  		// если на траницу перешли с другого языка, то title неверный
  		$audio_title_translit = TextPeer::urlTranslit($audio_title);
  		if ( $this->title != $audio_title_translit ) {
  			sfActions::redirect( $this->audio->getUrl() );
  		}
  		
	    $context = sfContext::getInstance();
	    $i18n =  $context->getI18N();
	       
	    $response = $this->getResponse(); 
	    $response->setTitle($audio_title);	
  	} elseif (!$audio_title && $this->title) {
  		// если у элемента нет Заголовка, а в URL передан title, редиректим
  		sfActions::redirect( $this->audio->getUrl() );
  	}  	
  }     
    
  public function executeIndex(sfWebRequest $request)
  {     
    $c = new Criteria();
    $c->add( AudioPeer::SHOW, 1);
    $c->addDescendingOrderByColumn( AudioPeer::ORDER );
    AudioPeer::addVisibleCriteria($c);
        
	$pager = new sfPropelPagerI18n('Audio', AudioPeer::ITEMS_PER_PAGE);
    $pager->setCriteriaI18n($c, true);
    $pager->setPage($this->getRequestParameter('page', 1));
    $pager->init();
    $this->pager = $pager;
    
    // если передан номер страницы больше, чем имеется страниц
    if ($request->getParameter('page') > $this->pager->getLastPage()) {
    	$this->forward404();
    }  
  }     
}