<?php

/**
 * audio actions.
 *
 * @package    sf_sandbox
 * @subpackage audio
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class audioActions extends sfActions
{
 
  public function executeIndex(sfWebRequest $request)
  {     
    $c = new Criteria();
    $c->add( AudioPeer::SHOW, 1);
    $c->addDescendingOrderByColumn( AudioPeer::ORDER );    
    
    $this->audio_list = AudioPeer::doSelectWithI18n($c);
  }     
}