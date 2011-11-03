<?php

/**
 * revisionhistory actions.
 *
 * @package    sf_sandbox
 * @subpackage revisionhistory
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class revisionhistoryActions extends sfActions
{
 
  public function executeShow(sfWebRequest $request)
  {
  	$c = new Criteria();
  	
  	$id = $request->getParameter('id');
  	if (!$id) {
  	  $this->forward404();
  	}
  	$this->revisionhistory = RevisionhistoryPeer::retrieveByPk($id);
  	if (!$this->revisionhistory) {
  	  $this->forward404();
  	}
  	
  	// редирект на язык версии
  	if ($this->revisionhistory->getPageMnemonicCulture() != sfContext::getInstance()->getUser()->getCulture()) {
  		$this->redirect( $this->revisionhistory->getUrl() );
  	}
  }   
}