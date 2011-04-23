<?php

/**
 * subscribe actions.
 *
 * @package    sf_sandbox
 * @subpackage subscribe
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class subscribeActions extends sfActions
{

  public function executeUpdate(sfWebRequest $request)
  {
  	$item_id   = (int)$request->getParameter('item_id');
  	$item_type = (int)$request->getParameter('item_type');
  	$value     = (int)$request->getParameter('value');
  	
  	if ( !UserPeer::authIsLoggedIn() ) {
  		
		$_SESSION['loginorsignup_from_location'] = base64_decode( $request->getParameter('from_location') );
		sfLoader::LoadHelpers(array('Url'));
		$redirect = url_for( 'user/loginorsignup' );	
	    $this->getResponse()->setContent( '{"redirect": "' . $redirect . '"}' );  
	     		
  		return sfView::NONE;
  		
  	} else {
  	
  		if ( !$item_id || !$item_type ) {
  			return sfView::NONE; 
  		}
  		
	  	if ($value == 1) {
	  		// добавляем подписку
	  		SubscribePeer::addSubscribe( UserPeer::authUserId(), $item_id, $item_type, $this->getUser()->getCulture() );
	  	} else {
	  		// удаляем подписку
	  		$c = new Criteria();
	  		$c->add( SubscribePeer::USER_ID, UserPeer::authUserId() );
	  		$c->add( SubscribePeer::ITEM_ID, $item_id );
	  		$c->add( SubscribePeer::ITEM_TYPE, $item_type );
	  		$c->add( SubscribePeer::ITEM_LANG, $this->getUser()->getCulture() );
	  		$subscribe = SubscribePeer::doSelectOne( $c );
	  		if ($subscribe) {
	  			$subscribe->delete();
	  		}
	  	}
  	}
	
	return sfView::NONE;  	
  }  
    
}