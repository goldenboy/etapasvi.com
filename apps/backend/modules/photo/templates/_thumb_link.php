<?php 
if ($photo && $photo->getThumbPath()) {
    $url = $photo->getThumbUrl(); //PhotoPeer::remoteStorageGetUrl( $photo->getThumbPath(), $photo->getImg() );
	echo '<a href="' . $url . '" target="_blank">' . $url . '</a>';
}
?>
