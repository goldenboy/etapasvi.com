<?php
 
class revisionhistoryComponents extends sfComponents
{
  public function executeShow()
  {
  	$this->revisionhistory = RevisionhistoryPeer::getByPageMnemonic(
  	  RevisionhistoryPeer::generatePageMnemonic()
  	);
  } 
}