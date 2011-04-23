eTapasvi News: 
<?php
if ($item_title) {
	echo html_entity_decode( $item_title );
} else {
	switch ($item_type) {
		case ItemtypesPeer::ITEM_TYPE_NEWS:
			echo 'Article ';
			break;
		case ItemtypesPeer::ITEM_TYPE_PHOTO:
			echo 'Photo ';
			break;
		case ItemtypesPeer::ITEM_TYPE_VIDEO:
			echo 'Video ';
			break;
	}
}
?>