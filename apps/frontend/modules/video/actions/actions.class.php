<?php

/**
 * idea actions.
 *
 * @package    sf_sandbox
 * @subpackage idea
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class videoActions extends sfActions
{
 
  public function executeShow(sfWebRequest $request)
  {  	
  	$this->id 	 = $request->getParameter('id');
  	$this->title = $request->getParameter('title');	
  }  
  
  public function executeIndex(sfWebRequest $request)
  {  	
    $c = new Criteria();
    $c->add( VideoPeer::SHOW, 1);
    $c->addDescendingOrderByColumn( VideoPeer::ORDER );
    //$c->add( VideoI18nPeer::CODE, '', Criteria::NOT_EQUAL );\
    VideoPeer::addVisibleCriteria($c);
        
	$pager = new sfPropelPagerI18n('Video', VideoPeer::ITEMS_PER_PAGE);
    $pager->setCriteriaI18n($c);
    $pager->setPage($this->getRequestParameter('page', 1));
    $pager->init();
    $this->pager = $pager;
    
    // если передан номер страницы больше, чем имеется страниц
    if ($request->getParameter('page') > $this->pager->getLastPage()) {
    	$this->forward404();
    }    
    
    // запоминаем адрес
    //$_SESSION['back_to_video'] = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
  }
  
}