<?php

class QuotePeer extends BaseQuotePeer
{
	/*
  public static function getRandomQuote()
  {
	if ( empty($_SESSION['quotes']) || $_SESSION['quotes_culture'] != sfContext::getInstance()->getUser()->getCulture() ) {
  	  
  	  $culture = sfContext::getInstance()->getUser()->getCulture();
  	    
  	  $c = new Criteria();
  	  $c->add( QuoteI18nPeer::TITLE, '', Criteria::NOT_EQUAL);
  	  $c->add( QuoteI18nPeer::CULTURE, $culture );
  	  //$quotes = QuotePeer::doSelect( new Criteria() );
  	  $quotes = QuoteI18nPeer::doSelect( $c );
  	  
	  $_SESSION['quotes']          = $quotes;
	  $_SESSION['quotes_culture']  = $culture;
	  
  	} else {
  	  $quotes = $_SESSION['quotes'];
  	}
	
  	if (!empty($quotes)) {
		mt_srand( time() );
		$i = mt_rand( 0, count($quotes) - 1 );
		
		$quote = $quotes[ $i ];
  	} else {
  		$quote = '';
  	}
  	
//  	$c = new Criteria();
//	$c->addAscendingOrderByColumn('rand()');
//	$quote = QuoteI18nPeer::doSelectOne($c);
  		
  	return $quote;  	
  }*/
}
