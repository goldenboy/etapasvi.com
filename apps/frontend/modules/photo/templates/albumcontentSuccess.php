<?php $photo_list = $pager->getResults(); ?>
<?php if (count($photo_list)): ?>
    <?php
        // get item2item
        if ($photoalbum) {
            $item2item_html = get_component('item2item', 'show', array('item_type'=>ItemtypesPeer::ITEM_TYPE_PHOTOALBUM, 'item_id'=>$photoalbum->getId()));        
        }
    ?>
    <?php foreach($photo_list as $i=>$photo): ?>
        <?php 
        // prev and next photos
        if ($i==0) {
            $prev_photo = $photo_list[count($photo_list) - 1];
        } else {
            $prev_photo = $photo_list[$i - 1];
        }
        
        if ($i==(count($photo_list) - 1)) {
            $next_photo = $photo_list[0];
        } else {
            $next_photo = $photo_list[$i + 1];
        }       
        ?>
    
        <?php $content = get_partial('photo/content', array('photo'=>$photo, 'no_check_title'=>true, 'next_photo'=>$next_photo, 'prev_photo'=>$prev_photo, 'item2item_html'=>$item2item_html)); ?>
        <ac_<?php echo $photo->getId(); ?>><?php echo $content; ?></ac_<?php echo $photo->getId(); ?>>
    <?php endforeach ?>	
<?php endif ?>