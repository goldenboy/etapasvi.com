<?php

class Alert extends BaseAlert
{
	public function getItemTypeName() {
		//return AlertPeer::getItemTypeName( $this->getItemType() );
		return ItemtypesPeer::getItemTypeNameLower( $this->getItemType() );
	}
	public function getStatusName() {
		return AlertPeer::getStatusName( $this->getStatus() );
	}
	public function getUrl() {
		return ItemtypesPeer::getItemUrl( $this->getItemLang(), $this->getItemId(), $this->getItemType() );
	}			
	public function getItemTitle() {
		return ItemtypesPeer::getItemTitle( $this->getItemId(), $this->getItemType(), $this->getItemLang() );
	}
}
