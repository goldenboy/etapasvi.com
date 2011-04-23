<?php

class Subscribe extends BaseSubscribe
{  
  public function getItemTitle() {
  	return ItemtypesPeer::getItemTitle( $this->getItemId(), $this->getItemType(), $this->getItemLang() );
  }	
  
  public function getItemUrl()
  {
  	return ItemtypesPeer::getItemUrl( $this->getItemLang(), $this->getItemId(), $this->getItemType() );
  }  
}
