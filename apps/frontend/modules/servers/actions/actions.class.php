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
      'https://docs.google.com/spreadsheet/pub?hl=en_US&hl=en_US&key=0ApLTjOcBiwykdGV2QUJlMVQ2RG4yRzJ5NEZjOHZNdlE&single=true&gid=0&output=html' 
    );
  }
  
}