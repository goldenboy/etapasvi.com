<?php 
if ($subscribe) {
	echo AlertPeer::getItemTypeName( $subscribe->getItemType() );
}
?>
