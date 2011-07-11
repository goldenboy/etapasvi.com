<?php

/**
 * text actions.
 *
 * @package    sf_sandbox
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class contactusActions extends sfActions
{
	
  public function executeShow(sfWebRequest $request)
  {
      $this->chapter_list = TextPeer::getGoogleDocAsArray( 'https://spreadsheets.google.com/spreadsheet/pub?hl=en_US&hl=en_US&key=0ApLTjOcBiwykdHBZbXpYTUJRWU1pdEdrZi1OTU9jb2c&single=true&gid=0&output=html' );
  }
  
}