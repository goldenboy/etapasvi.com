<p>
	Hello <?php echo $user_name ?>. <br/>
	User <?php echo $item_by_user_name ?> has posted a comment to
	<?php
	switch ($item_type) {
		case ItemtypesPeer::ITEM_TYPE_NEWS:
			echo 'article ';
			break;
		case ItemtypesPeer::ITEM_TYPE_PHOTO:
			echo 'photo ';
			break;
		case ItemtypesPeer::ITEM_TYPE_VIDEO:
			echo 'video ';
			break;
	}
    $comment_url = $url . '#comment_' . $comment_id;
	if ($item_title) {
		echo '<a href="' . $comment_url . '">' . $item_title . '</a>';
	} else {
		echo $comment_url;
	}
	?>
</p>
<i>
    <?php echo str_replace( '&lt;br /&gt;', '<br/>', $comment_body ); ?>
</i>

<?php include_partial('mail/footeren'); ?>