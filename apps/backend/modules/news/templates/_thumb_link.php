<?php 
if ($news && $news->getThumbPath()) {
    $url = $news->getThumbUrl(); //PhotoPeer::remoteStorageGetUrl( $photo->getThumbPath(), $photo->getImg() );
	echo '<a href="' . $url . '" target="_blank">' . $url . '</a>';
}
?>
