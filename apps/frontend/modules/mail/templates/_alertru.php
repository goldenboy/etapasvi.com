<p>
	Здравствуйте, <?php echo $user_name ?>. <br/>
    <?php if ($item_type == ItemtypesPeer::ITEM_TYPE_MAIL): ?>
        <?php echo html_entity_decode($item_body); ?>
    <?php else: ?>
        <?php
        switch ($item_type) {
            case ItemtypesPeer::ITEM_TYPE_NEWS:
                echo 'На сайте опубликована новость: ';
                break;
            case ItemtypesPeer::ITEM_TYPE_PHOTO:
                echo 'На сайте опубликовано новое фото: ';
                break;
            case ItemtypesPeer::ITEM_TYPE_VIDEO:
                echo 'На сайте опубликовано новое видео: ';
                break;
        }
        if ($item_title) {
            echo '<a href="' . $url . '">' . $item_title . '</a>';
        } else {
            echo $url;
        }
        ?>
    <?php endif ?>
	
</p>

<?php include_partial('mail/footerru'); ?>