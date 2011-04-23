<?php

class Phpb7d3xConfigPeer extends BasePhpb7d3xConfigPeer
{
  public static function getCookieDomain()
  { 
  	return self::getValue( 'cookie_domain' );	
  }
  
  public static function getCookieName()
  {
	return self::getValue( 'cookie_name' );
  }  
  
  private static function getValue( $name )
  {
  	$c = new Criteria();
  	$c->add( Phpb7d3xConfigPeer::CONFIG_NAME, $name );
  	$phpbb_config = Phpb7d3xConfigPeer::doSelectOne( $c );
  	
  	if ($phpbb_config) {
  		return $phpbb_config->getConfigValue();
  	} else {
  		return '';
  	}
  }    
}
