<?php

/**
 * comments actions.
 *
 * @package    sf_sandbox
 * @subpackage comments
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 5125 2007-09-16 00:53:55Z dwhittle $
 */
class commentsActions extends autocommentsActions
{
	private function setDefaultCulture() {
		$this->getUser()->setCulture('en');
	}

	public function executeList($request)
	{
		$this->setDefaultCulture();
		
	    $this->processSort();
	
	    $this->processFilters();	
	    
	    $this->filters = $this->getUser()->getAttributeHolder()->getAll('sf_admin/comments/filters');
	
	    // pager
	    $this->pager = new sfPropelPager('Comments', 1000000);
	    $c = new Criteria();
	    $this->addSortCriteria($c);
	    $this->addFiltersCriteria($c);
	    $this->pager->setCriteria($c);
	    $this->pager->setPage($this->getRequestParameter('page', $this->getUser()->getAttribute('page', 1, 'sf_admin/comments')));
	    //$this->pager->setPeerMethod('doSelectWithI18n');
	    $this->pager->init();
	    // save page
	    if ($this->getRequestParameter('page')) {
	        $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'sf_admin/comments');
	    }
	}	
	

	
	public function executeCreate(sfWebRequest $request)
	{
		$this->setDefaultCulture();
		parent::executeCreate($request);
	}
	public function executeEdit(sfWebRequest $request)
	{
		$this->setDefaultCulture();
		parent::executeEdit($request);
	}		
}
