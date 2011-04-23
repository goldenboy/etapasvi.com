<p>
	Hello <?php echo $user_name ?>. <br/>
    <?php if ($item_type == ItemtypesPeer::ITEM_TYPE_MAIL): ?>
        <?php echo html_entity_decode($item_body); ?>
    <?php else: ?>
        New  
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
        ?>
        has been published: 
        <?
        if ($item_title) {
            echo '<a href="' . $url . '">' . $item_title . '</a>';
        } else {
            echo $url;
        }
        ?>
    <?php endif ?>
</p>

<?php include_partial('mail/footeren'); ?>