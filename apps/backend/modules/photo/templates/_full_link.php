<?php 
if ($photo && $photo->getFullPath()) {
    $url = $photo->getFullUrl(); //PhotoPeer::remoteStorageGetUrl( $photo->getFullPath(), $photo->getImg() );
	echo '<a href="' . $url . '" target="_blank">' . $url . '</a>';
}
?>
