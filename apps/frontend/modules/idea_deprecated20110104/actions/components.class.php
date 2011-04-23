<?php
 
class ideaComponents extends sfComponents
{
  public function executeShow()
  {  	  	
    if ( $this->from == 'archive' ||
         IdeaPeer::isThinkingNow() ||  
         ($this->idea && $this->idea->getUserId() == UserPeer::authUserId()) ) {
		$this->noLinks = true;
    } else {    	
		if ( !UserPeer::authIsLoggedIn() || !$this->idea->isAbused() ) {
			$this->reportAbuseLink = url_for( 
				'idea/abuse?id=' . $this->idea->getId() 
				. '&from_location=' . base64_encode('http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'])
				. '&from=' . $this->from
			);
		}
		if ( !UserPeer::authIsLoggedIn() || !$this->idea->isVoted() ) {
			$this->voteLink = url_for( 
				'idea/vote?id=' . $this->idea->getId() 
				. '&from_location=' . base64_encode('http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'])
				. '&from=' . $this->from
			);
		}
		$this->noLinks = false;
    }
  } 
  public function executeGetthinkingtime()
  {
  	if (IdeaPeer::isThinkingNow()) {
  		$thinking_correction = -1 * 60 *60;
  	} else {
  		$thinking_correction = 0;
  	}
    $this->thinking_time = date("M j, Y H:i:s +0000", IdeaPeer::getThinkingTimeGMT() + $thinking_correction);
  }   
}