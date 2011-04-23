<?php 
if ($upload->getUrl())  {
	$full_url = '/'.sfConfig::get('sf_upload_dir_name').'/all/'.$upload->getUrl();
	echo '<img src="' . $full_url . '" width="100"/>';
}
if ($upload->getUrl() && !in_array($sf_context->getInstance()->getActionName(),array('edit', 'create')) ) {
	echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="' . $full_url  . '" target="_blank">Download</a>';
}

