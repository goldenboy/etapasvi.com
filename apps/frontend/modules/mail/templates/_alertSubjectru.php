Новости eTapasvi: 
<?php
if ($item_title) {
	echo html_entity_decode( $item_title );
} else {
	switch ($item_type) {
		case ItemtypesPeer::ITEM_TYPE_NEWS:
			echo 'Новость ';
			break;
		case ItemtypesPeer::ITEM_TYPE_PHOTO:
			echo 'Фото ';
			break;
		case ItemtypesPeer::ITEM_TYPE_VIDEO:
			echo 'Видео ';
			break;
	}
}
?>