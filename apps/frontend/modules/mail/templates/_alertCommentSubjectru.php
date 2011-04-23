Новый комментарий от <?php echo $user_name; ?> к 
<?php
	switch ($item_type) {
		case ItemtypesPeer::ITEM_TYPE_NEWS:
			echo 'Новости';
			break;
		case ItemtypesPeer::ITEM_TYPE_PHOTO:
			echo 'Фото';
			break;
		case ItemtypesPeer::ITEM_TYPE_VIDEO:
			echo 'Видео';
			break;
	}
	if ($item_title) {
		echo ' "' . html_entity_decode( $item_title ) . '"';
	}
?>