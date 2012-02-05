<?php if ($photo): ?>		

	<?php 
    // ���� ���� ��������� �� ����� ������������, �������, ���
    // ���� ���� ��������� �� ����������, ������� ���   
    $title = $photo->getTitle($sf_user->getCulture(), true);    
    ?>

	<?php if ($photo->getImg()): ?>
		<?php if (!empty($short) && $short): ?>
			<?php if (!empty($embed)): ?>
                <?php if (empty($align)): ?>
                    <?php // $embed_photo_align ��������� ����������� ���� �� ������ � ������� ���� ?>
                    <?php if (PhotoPeer::$embed_photo_align != 'left') : ?>
                        <?php $align = 'left'; ?>
                    <?php else: ?>
                        <?php $align = 'right'; ?>
                    <?php endif ?>
                <?php endif ?>
                <?php PhotoPeer::$embed_photo_align = $align; ?>               
                <div class="embed_photo embed_photo_<?php echo $align; ?><?php if ($in_list): ?> extra_space_<?php echo $align; ?><?php endif ?>">
                <?php endif ?>
                <a href="<?php echo $photo->getUrl(); ?>" title="<?php echo $title; ?>">
                    <img src="<?php echo $photo->getThumbUrl(); ?>" alt=""/></a>
                <?php if ($title): ?>
                    <br/><span class="light"><?php echo $title; ?></span>
                <?php endif ?>
                <?php if ($show_body && $photo->getBody($sf_user->getCulture(), true)): ?>
                    <br/><br/><?php echo html_entity_decode($photo->getBodyPrepared()); ?>
                <?php endif ?>
                <?php if (!empty($embed)): ?>
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


	<?php if (empty($short) || !$short): ?>  

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
                     | <strong><?php echo __('Author') ?>:</strong> <?php echo $author ?>
                <?php endif ?>
                 | 
                <a href="<?php echo $photo->getFullUrl(); ?>" 	
                    title="<?php echo __('Enlarge') ?>" target="_blank" ><?php echo __('Enlarge') ?></a>		
            </p>
            <p id="photo_loader" class="hidden center_text" ><img src="http://<?php echo sfConfig::get('app_domain_name'); ?>/i/loader.gif" /></p>
            <?php if ($photo->getBody($sf_user->getCulture(), true)): ?>
                <br/>
            <?php echo html_entity_decode($photo->getBodyPrepared()); ?><br/>
            <?php endif ?>
            <?php if ($photo->getLink()): ?>
                <p class="p1_no_bottom source">
                    <strong><?php echo __('Source') ?>:</strong> <a href="<?php echo $photo->getLink(); ?>"><?php echo TextPeer::cropLink($photo->getLink()); ?></a>
                </p>
            <?php endif ?>            
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
			<?php if ($prev_photo && $prev_photo->getShow()): ?>
				<img src="<?php echo $prev_photo->getPreviewUrl(); ?>" style="display:none;"/>
                <?php 
                    $prev_title = $prev_photo->getTitle($sf_user->getCulture(), true);
                    if (!$prev_title) {
                        $prev_title = __('Prev');
                    }
                ?>
				<a href="<?php echo $prev_url; ?>" title="<?php echo $prev_title ?>" class="photo_content_link"><img src="<?php echo $prev_photo->getThumbUrl(); ?>" alt="<?php echo $prev_title ?>"/></a>				
			<?php endif ?>
            </td>
            <td>
				<img src="<?php echo $photo->getThumbUrl(); ?>" class="current_photo"/>
            </td>
            <td>
			<?php if ($next_photo && $next_photo->getShow()): ?>	
                <?php 
                    $next_title = $next_photo->getTitle($sf_user->getCulture(), true);
                    if (!$next_title) {
                        $next_title = __('Next');
                    }
                ?>
				<a href="<?php echo $next_url; ?>" title="<?php echo $next_title ?>" class="photo_content_link">
					<img src="<?php echo $next_photo->getThumbUrl(); ?>" alt="<?php echo $next_title ?>"/></a>				
				<img src="<?php echo $next_photo->getPreviewUrl(); ?>" style="display:none;"/>
			<?php endif ?>
            </td>	
		</tr>
	</table>
    <div id="photo_content_title" class="hidden"><?php echo __($sf_response->getTitle()); ?></div>
    <div class="photo_info">
        <?php include_component('item2item', 'show', array('item_type'=>ItemtypesPeer::ITEM_TYPE_PHOTOALBUM, 'item_id'=>$photo->getPhotoalbumId())) ?> 
    </div>
	<?php endif ?>    
<?php endif ?>