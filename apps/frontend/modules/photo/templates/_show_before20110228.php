<?php if ($photo): ?>		

	<?php $title = $photo->getTitle(); ?>

	<?php if ($photo->getImg()): ?>
		<?php if (!empty($short) && $short): ?>
			<?php			
			$title_translit = TextPeer::urlTranslit($title); 
			if ($title_translit) {
				$title_url = '&title=' . $title_translit;
			} else {
                $title_url = '';
            }
			?>
			<?php if (!empty($embed)): ?>
			<div class="embed_photo">
			<?php endif ?>
			<a href="<?php echo url_for('photo/show?id='.$photo->getId() . $title_url ); ?>" title="<?php echo $title; ?>">
				<img src="<?php echo '/'.sfConfig::get('sf_upload_dir_name').'/photo/thumb/'.$photo->getImg(); ?>" 
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

			<p class="center_text p1_no_bottom prev_next" style="<?php if (!$prev_photo):?>padding-left:16px;<?php endif ?> <?php if (!$next_photo):?>padding-right:16px;<?php endif ?>">

			<?php 
				if ($prev_photo && $photo->getShow()):
					$prev_title_text = TextPeer::urlTranslit($prev_photo->getTitle()); 
					if ($prev_title_text) {
						$prev_title = '&title=' . $prev_title_text;
					} else {
                        $prev_title = '';
                    }
					$prev_url = url_for('photo/show?id='.$prev_photo->getId() . $prev_title )
				?>
					<a href="<?php echo $prev_url; ?>" title="<?php echo __('Prev') ?>"><img src="/images/prev.png" alt="<?php echo __('Prev') ?>"/></a>
				<?php endif ?>

				<?php 
				if ($next_photo && $photo->getShow()): 
					$next_title_text = TextPeer::urlTranslit($next_photo->getTitle()); 
					if ($next_title_text) {
						$next_title = '&title=' . $next_title_text;
					} else {
                        $next_title = '';
                    }
					$next_url = url_for('photo/show?id='.$next_photo->getId() . $next_title )
				?>
					<a href="<?php echo $next_url; ?>" title="<?php echo __('Next') ?>">
						<img src="<?php echo '/'.sfConfig::get('sf_upload_dir_name').'/photo/preview/'.$photo->getImg(); ?>" 
						alt="<?php echo $title; ?>" class="photoitem_img"/></a>
				<?php else: ?>
					<img src="<?php echo '/'.sfConfig::get('sf_upload_dir_name').'/photo/preview/'.$photo->getImg(); ?>" 
					alt="<?php echo $title; ?>" class="photoitem_img"/>
				<?php endif ?>

				<?php 
				if ($next_photo && $photo->getShow()): 
				?>
					<a href="<?php echo $next_url; ?>" title="<?php echo __('Next') ?>"><img src="/images/next.png" alt="<?php echo __('Next') ?>"/></a>
				<?php endif ?>
			</p>
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
                    <?php echo $title; ?>
                </p>
            <?php endif ?>	
            <p class="center_text small light">
                <span class="date"><?php echo format_datetime( $photo->getCreatedAt(), 'd MMMM yyyy'); ?></span>             
                <?php 
                    if ($photo->getAuthor()) :
                        $author = $photo->getAuthor();
                    elseif ($photo->getPhotoalbum() && $photo->getPhotoalbum()->getAuthor()):
                        $author = $photo->getPhotoalbum()->getAuthor();
                    else:
                        $author = '';
                    endif
                ?>
                
                <?php if ($author): ?>
                     | <strong><?php echo __('Author') ?>:</strong> <?php echo $author ?>
                <?php endif ?>
                 | 
                <a href="<?php echo '/'.sfConfig::get('sf_upload_dir_name').'/photo/'.$photo->getImg(); ?>" 	
                    title="<?php echo __('Full size') ?>" target="_blank" ><?php echo __('Full size') ?></a>		
            </p>
            <?php if ($photo->getBody()): ?>
            <?php echo html_entity_decode($photo->getBodyPrepared()); ?><br/><br/>
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
	<table id="photo_list">
		<tr>			
            <td>
			<?php if ($prev_photo && $photo->getShow()): ?>
				<img src="<?php echo '/'.sfConfig::get('sf_upload_dir_name').'/photo/preview/'.$prev_photo->getImg(); ?>" style="display:none;"/>

				<a href="<?php echo $prev_url; ?>" title="<?php echo __('Prev') ?>"><img src="<?php echo '/'.sfConfig::get('sf_upload_dir_name').'/photo/thumb/'.$prev_photo->getImg(); ?>" alt="<?php echo __('Prev') ?>"/></a>				
			<?php endif ?>
            </td>
            <td>
				<img src="<?php echo '/'.sfConfig::get('sf_upload_dir_name').'/photo/thumb/'.$photo->getImg(); ?>" class="current_photo"/>
            </td>
            <td>
			<?php if ($next_photo && $photo->getShow()): ?>				
				<a href="<?php echo $next_url; ?>" title="<?php echo __('Next') ?>">
					<img src="<?php echo '/'.sfConfig::get('sf_upload_dir_name').'/photo/thumb/'.$next_photo->getImg(); ?>" alt="<?php echo __('Next') ?>"/></a>				
				<img src="<?php echo '/'.sfConfig::get('sf_upload_dir_name').'/photo/preview/'.$next_photo->getImg(); ?>" style="display:none;"/>
			<?php endif ?>
            </td>	
		</tr>
	</table>
	<?php endif ?>
<?php endif ?>