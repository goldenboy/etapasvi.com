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
				alt="<?php echo $title; ?>" class="photoitem_img"/>
			</a>
			<?php if (!empty($embed)): /*?>
			<p class="no_decor small">
				<?php echo $title; ?>
			</p>
            <?php */ ?>
			</div>
			<?php endif ?>
		<?php else: ?>				

			<div class="center_text prev_next" style="<?php if (!$prev_photo):?>padding-left:16px;<?php endif ?> <?php if (!$next_photo):?>padding-right:16px;<?php endif ?>">

			<?php 
				if ($prev_photo && $photo->getShow()):
                    $prev_url = $prev_photo->getUrl();
				?>
					<a href="<?php echo $prev_url; ?>" title="<?php echo __('Prev') ?>" class="prev_icon photo_content_link"></a>
				<?php endif ?>

				<?php 
				if ($next_photo && $photo->getShow()): 
                    $next_url = $next_photo->getUrl();
				?>
					<a href="<?php echo $next_url; ?>" title="<?php echo __('Next') ?>" class="photo_content_link">
						<img src="<?php echo $photo->getPreviewUrl(); ?>" 
						alt="<?php echo $title; ?>" id="photoitem_img"/></a>
				<?php else: ?>
					<img src="<?php echo $photo->getPreviewUrl(); ?>" 
					alt="<?php echo $title; ?>" id="photoitem_img"/>
				<?php endif ?>

				<?php 
				if ($next_photo && $photo->getShow()): 
				?>
					<a href="<?php echo $next_url; ?>" title="<?php echo __('Next') ?>" class="next_icon photo_content_link"></a>
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
            <p class="center_text small light">
                <span class="date"><?php echo format_datetime( $photo->getCreatedAt(), 'd MMMM yyyy'); ?></span>             
                <?php 
                    $photoalbum = $photo->getPhotoalbum();
                    $author     = $photo->getAuthor($sf_user->getCulture(), true);
                    /*
                    if ($photo->getAuthor()) :
                        $author = $photo->getAuthor();
                    elseif ($sf_user->getCulture() != UserPeer::DEFAULT_CULTURE && !$photo->getAuthor() && $photo->getAuthor(UserPeer::DEFAULT_CULTURE)):
                        $author = $photo->getAuthor(UserPeer::DEFAULT_CULTURE);
                    elseif ($sf_user->getCulture() != UserPeer::DEFAULT_CULTURE && $photoalbum && !$photoalbum->getAuthor() && $photoalbum->getAuthor(UserPeer::DEFAULT_CULTURE)):
                        $author = $photoalbum->getAuthor(UserPeer::DEFAULT_CULTURE);
                    elseif ($photoalbum && $photoalbum->getAuthor()):
                        $author = $photoalbum->getAuthor();
                    else:
                        $author = '';
                    endif*/
                ?>
                
                <?php if ($author): ?>
                     | <strong><?php echo __('Author') ?>:</strong> <?php echo $author ?>
                <?php endif ?>
                 | 
                <a href="<?php echo $photo->getFullUrl(); ?>" 	
                    title="<?php echo __('Full size') ?>" target="_blank" ><?php echo __('Full size') ?></a>		
            </p>
            <p id="photo_loader" class="hidden center_text" ><img src="/i/loader.gif" /></p>
            <?php if ($photo->getBody()): ?>
            <?php echo html_entity_decode($photo->getBodyPrepared()); ?><br/>
            <?php endif ?>
            <?php if ($photo->getLink()): ?>
                <p class="p1_no_bottom source">
                    <strong><?php echo __('Source') ?>:</strong> <a href="<?php echo $photo->getLink(); ?>"><?php echo $photo->getLink(); ?></a>
                </p>
            <?php endif ?>
            <?php include_component('item2item', 'show', array('item_type'=>ItemtypesPeer::ITEM_TYPE_PHOTOALBUM, 'item_id'=>$photo->getPhotoalbumId())) ?> 
        </div>
		<hr class="light"/>
<?php /* 
		<p class="center_text prev_next">
			<?php 
			if ($prev_photo && $photo->getShow()):
			?>
				<img src="<?php echo '/'.sfConfig::get('sf_upload_dir_name').'/photo/preview/'.$prev_photo->getImg(); ?>" style="display:none;"/>

				<a href="<?php echo $prev_url; ?>" title="<?php echo __('Prev') ?>"><img src="<?php echo '/'.sfConfig::get('sf_upload_dir_name').'/photo/thumb/'.$prev_photo->getImg(); ?>" alt="<?php echo __('Prev') ?>"/></a>
				&nbsp;&nbsp;&nbsp;&nbsp;
			<?php endif ?>


			<?php if ($next_photo && $photo->getShow()): ?>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="<?php echo $next_url; ?>" title="<?php echo __('Next') ?>">
					<img src="<?php echo '/'.sfConfig::get('sf_upload_dir_name').'/photo/thumb/'.$next_photo->getImg(); ?>" alt="<?php echo __('Next') ?>"/></a>
				

				<img src="<?php echo '/'.sfConfig::get('sf_upload_dir_name').'/photo/preview/'.$next_photo->getImg(); ?>" style="display:none;"/>
			<?php endif ?>
		</p>
 */ ?>
	<table class="photo_list">
		<tr>			
            <td>
			<?php if ($prev_photo && $photo->getShow()): ?>
				<img src="<?php echo $prev_photo->getPreviewUrl(); ?>" style="display:none;"/>

				<a href="<?php echo $prev_url; ?>" title="<?php echo __('Prev') ?>" class="photo_content_link"><img src="<?php echo $prev_photo->getThumbUrl(); ?>" alt="<?php echo __('Prev') ?>"/></a>				
			<?php endif ?>
            </td>
            <td>
				<img src="<?php echo $photo->getThumbUrl(); ?>" class="current_photo"/>
            </td>
            <td>
			<?php if ($next_photo && $photo->getShow()): ?>				
				<a href="<?php echo $next_url; ?>" title="<?php echo __('Next') ?>" class="photo_content_link">
					<img src="<?php echo $next_photo->getThumbUrl(); ?>" alt="<?php echo __('Next') ?>"/></a>				
				<img src="<?php echo $next_photo->getPreviewUrl(); ?>" style="display:none;"/>
			<?php endif ?>
            </td>	
		</tr>
	</table>
	<?php endif ?>
    <div id="photo_content_title" class="hidden"><?php echo $sf_response->getTitle(); ?></div>
<?php endif ?>