<?php

/**
 * text actions.
 *
 * @package    sf_sandbox
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class teachingsActions extends sfActions
{
	
  public function executeShow(sfWebRequest $request)
  {  	
	/*$c = new Criteria();
	
	$c->addJoin(News2videoPeer::NEWS_ID, NewsPeer::ID);
	$c->add(NewsPeer::IS_TEACHING, 1);
	$c->add(NewsPeer::SHOW, 1);	  	
	$c->addSelectColumn(NewsPeer::DATE);
	$c->addSelectColumn(News2videoPeer::NEWS_ID);
	$c->addSelectColumn(News2videoPeer::VIDEO_ID);
	$c->addDescendingOrderByColumn(NewsPeer::ORDER);
	$c->addAscendingOrderByColumn(News2videoPeer::VIDEO_ID);
	
	$teachings_list = News2videoPeer::doSelect($c);   
	
	
	$this->teachings = array();
	$teachings_index = -1;
	$prev_news_id    = '';
    foreach ( $teachings_list as $teaching ) {
	  if ($teaching->getNewsId() != $prev_news_id) {
	     $teachings_index++;	  			
		 $prev_news_id = $teaching->getNewsId();		
	  }
	  $this->teachings[ $teachings_index ]['date']     = $teaching->getNews()->getDate();
	  $this->teachings[ $teachings_index ]['news_id']  = $teaching->getNewsId();
	  $this->teachings[ $teachings_index ]['video'][]  = $teaching->getVideoId();	  		
    }	*/  	
  }
  
  /*
  public function executeIndex(sfWebRequest $request)
  {  	
    $c = new Criteria();
    $c->add( NewsPeer::IS_TEACHING, 1);
    $c->add( NewsPeer::SHOW, 1);
    $c->add( NewsI18nPeer::BODY, '', Criteria::NOT_EQUAL );Not to discriminate against human beings according to their cast, religion, gender or color etc.
	$c->addDescendingOrderByColumn( NewsPeer::DATE );

	$this->teachings = NewsPeer::doSelectWithI18n( $c );
	print_r( $this->teachings );
  }   */
  
  public function executeIndex(sfWebRequest $request)
  {  	
    $c = new Criteria();
    $c->add( NewsPeer::IS_TEACHING, 1);
    $c->add( NewsPeer::SHOW, 1);
    $c->add( NewsI18nPeer::BODY, '', Criteria::NOT_EQUAL );
    
    if ($this->getRequestParameter('type')) {
        $c->add( NewstypesPeer::NAME, $this->getRequestParameter('type') );
    }
    
	$c->addDescendingOrderByColumn( NewsPeer::ORDER );
    
	$pager = new sfPropelPagerI18n('News', 1000);
    $pager->setCriteriaI18n($c);
    $pager->setPage($this->getRequestParameter('page', 1));
    $pager->init();
    $this->pager = $pager;
    
    // если передан номер страницы больше, чем имеется страниц
    if ($request->getParameter('page') > $this->pager->getLastPage()) {
    	$this->forward404();
    }
       
  }   
  
}