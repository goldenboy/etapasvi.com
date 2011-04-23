<?php 
if ($news) {
	//echo image_tag('/'.sfConfig::get('sf_upload_dir_name').'/photo/thumb/'.$photo->getImg());
	echo image_tag($news->getThumbUrl());
}

?>
