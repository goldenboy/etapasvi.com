<?php 
if ($news && $news->getFullPath()) {
    $url = $news->getFullUrl(); //PhotoPeer::remoteStorageGetUrl( $photo->getFullPath(), $photo->getImg() );
	echo '<a href="' . $url . '" target="_blank">' . $url . '</a>';
}
?>
