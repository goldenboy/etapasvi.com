<?php

/**
 * aim actions.
 *
 * @package    sf_sandbox
 * @subpackage aim
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 5125 2007-09-16 00:53:55Z dwhittle $
 */
class ideaActions extends autoideaActions
{
	private function setDefaultCulture() {
		// ����� �������������� ������������ �� ��������� �����: uploads, js
		$this->getUser()->setCulture('en');
	}

	public function executeList($request)
	{
		$this->setDefaultCulture();
		
		$this->processSort();
		
		$this->processFilters();
		
		// pager
		$this->pager = new sfPropelPager('Idea', 50);
		$c = new Criteria();
		$this->addSortCriteria($c);
		$this->addFiltersCriteria($c);
		$this->pager->setCriteria($c);
		$this->pager->setPage($this->getRequestParameter('page', $this->getUser()->getAttribute('page', 1, 'sf_admin/idea')));
		//$this->pager->setPeerMethod('doSelectWithI18n');
		$this->pager->init();
		//print_r( $this->pager->getResults() );
		// save page
		if ($this->getRequestParameter('page')) {
		    $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'sf_admin/idea');
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
