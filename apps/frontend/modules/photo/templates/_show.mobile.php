<?php if ($photo): ?>		

	<?php 
    // если есть «аголовок на €зыке пользовател€, выводим, его
    // если есть «аголовок на английском, выводим его   
    $title = $photo->getTitle($sf_user->getCulture(), true);    
    ?>

	<?php if ($photo->getImg()): ?>
		<?php if (!empty($short) && $short): ?>
			<?php if (!empty($embed)): ?>
			<div class="embed_photo">
			<?php endif ?>
			<a href="<?php echo $photo->getUrl(); ?>" title="<?php echo $title; ?>">
				<img src="<?php echo $photo->getThumbUrl(); ?>" 
				alt="<?php echo $title; ?>" class="photoitem_img"/></a>
			<?php if (!empty($embed)): /*?>
			<p class="no_decor small">
				<?php echo $title; ?>
			</p>
            <?php */ ?>
			</div>
			<?php endif ?>
		<?php else: ?>				

			<div class="center_text prev_next" >
                <p>
                <?php
				if ($prev_photo && $photo->getShow()):
                    $prev_url = $prev_photo->getUrl();
				?>
					<a href="<?php echo $prev_url; ?>" title="<?php echo __('Prev') ?>" class="prev_icon photo_content_link">&lt;&lt;</a>&nbsp;&nbsp;
				<?php endif ?>
                
				<?php 
				if ($next_photo && $photo->getShow()): 
                    $next_url = $next_photo->getUrl();
				?>
					<a href="<?php echo $next_url; ?>" title="<?php echo __('Next') ?>" class="next_icon photo_content_link">&gt;&gt;</a>
				<?php endif ?>
                </p>
				<?php 
				if ($next_photo && $photo->getShow()):                     
				?>
					<a href="<?php echo $next_url; ?>" title="<?php echo __('Next') ?>" class="photo_content_link">
						<img src="<?php echo $photo->getPreviewUrl(); ?>" 
						alt="<?php echo $title; ?>" id="photoitem_img"/></a>
				<?php else: ?>
					<img src="<?php echo $photo->getPreviewUrl(); ?>" 
					alt="<?php echo $title; ?>" id="photoitem_img"/>
				<?php endif ?>
			</div>
		<?php endif ?>
	<?php endif ?>		


	<?php if (!empty($short) && $short): ?>      
        <?php if ($title): ?>
            <p class="center_text p1_no_both light"><?php echo $title; ?></p>
        <?php endif ?>	
    <?php else: ?>

        <div class="photo_info">
            <?php if ($title): ?>
                <p class="center_text">
                    <strong><?php echo $title; ?></strong>
                </p>
            <?php endif ?>	
            <p class="center_text small light p1_no_bottom">
                <span class="date"><?php echo format_datetime( $photo->getCreatedAt('Y-m-d H:i:s', true), 'd MMMM yyyy'); ?></span>             
                <?php 
                    $photoalbum = $photo->getPhotoalbum();
                    $author     = $photo->getAuthor($sf_user->getCulture(), true);
                    
                    if ($author == '?') {
                        $author = __('If this photo has been made by you, please, let us know');
                    }
                ?>
                
                <?php if ($author): ?>
                     <br/> <strong><?php echo __('Author') ?>:</strong> <?php echo $author ?>
                <?php endif ?>
                 <br/>
                <a href="<?php echo $photo->getFullUrl(); ?>" 	
                    title="<?php echo __('Enlarge') ?>" target="_blank" ><?php echo __('Enlarge') ?></a>		
            </p>
            
            <?php if ($photo->getBody($sf_user->getCulture(), true)): ?>
            <?php echo html_entity_decode($photo->getBodyPrepared()); ?><br/>
            <?php endif ?>
            <?php if ($photo->getLink()): ?>
                <p class="p1_no_bottom source">
                    <strong><?php echo __('Source') ?>:</strong> <a href="<?php echo $photo->getLink(); ?>"><?php echo TextPeer::cropLink($photo->getLink()); ?></a>
                </p>
            <?php endif ?>
            <?php include_component('item2item', 'show', array('item_type'=>ItemtypesPeer::ITEM_TYPE_PHOTOALBUM, 'item_id'=>$photo->getPhotoalbumId())) ?> 
        </div>
		<hr class="light"/>
	<?php endif ?>
<?php endif ?>