<?php

/**
 * text actions.
 *
 * @package    sf_sandbox
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class serversActions extends sfActions
{
	
  public function executeShow(sfWebRequest $request)
  {
    $this->server_list = TextPeer::getGoogleDocAsArray( 
      TextPeer::GOOGLE_DOC_SERVERS 
    );
  }
  
}