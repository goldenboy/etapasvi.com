<?php 
if ($photo && $photo->getPreviewPath()) {
    $url = $photo->getPreviewUrl(); //PhotoPeer::remoteStorageGetUrl( $photo->getPreviewPath(), $photo->getImg() );
	echo '<a href="' . $url . '" target="_blank">' . $url . '</a>';
}
?>
