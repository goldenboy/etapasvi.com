<?php if ($video): ?>	
	<?php 
    $title          = $video->getTitle($sf_user->getCulture(), true);
    $code           = $video->getCode($sf_user->getCulture(), true);
    $href           = $video->getUrl();
	?>

	<?php if (empty($short)): ?>	
		<div class="box video">
	<?php endif ?>

		<?php if (!empty($short)): ?>
            <a href="<?php echo $href; ?>" title="<?php echo $title; ?>">
                <img src="<?php echo $video->getImgPrepared($sf_user->getCulture(), true); ?>" 
                alt="<?php echo $title; ?>" width="150"/></a>
            <?php if ( $title ): ?>
            <p class="p1_no_top">
                <a href="<?php echo $href; ?>" title="<?php echo $title; ?>">
                    <?php echo html_entity_decode( $video->getTitlePrepared($title) ); ?>...
                </a>				
            </p>
            <p class="date left_text p1_no_both">
                <?php echo format_date( $video->getCreatedAt(), 'd MMMM yyyy' ); ?>
            </p>
            <?php endif ?>	
		<?php else: ?>		
			<h2 class="title"><?php echo $title; ?></h2>
			
			<p class="center_text p1_no_bottom">
               <?php include_partial('video/code', array('code'=>$code)); ?>
			</p>

		<?php endif ?>

		<?php if (empty($short)): ?>
			<div class="video_info">
				<p class="date right_text p1_no_both">
                    <span class="left"><?php echo __('Click "CC" in the player to show captions') ?></span>
					<strong><?php echo format_date( $video->getCreatedAt(), 'd MMMM yyyy' ); ?></strong>
				</p>
				<?php 
                    $body = html_entity_decode($video->getBodyPrepared($sf_user->getCulture(), true));
                ?>
                <?php if ($body): ?>
                    <?php echo $body; ?><br/>
                <?php endif?>
                <br/>
                
				<?php 
                $author     = $video->getAuthor($sf_user->getCulture(), true);
                    /*if (!empty($news_list) && count($news_list)): ?>
					<p>
						<strong><?php echo __('Text'); ?>:</strong>
                        <br/>
					<?php foreach($news_list as $news_index=>$news_item): ?>
						<a href="<?php echo url_for('news/show?id=' . $news_item->getNewsId()); ?>"><?php echo $news_item->getNews()->getTitle(); ?></a><br/>
					<?php endforeach ?>				
					</p>
				<?php endif */?>
                <?php if ($author): ?>
                    <p class="p1_no_top author">				
                        <strong><?php echo __('Author') ?>:</strong> <?php echo $author; ?>
                    </p>
                <?php endif ?>
                <?php if ($video->getLink()): ?>
                    <p class="p1_no_bottom source">
                        <strong><?php echo __('Source') ?>:</strong> <a href="<?php echo $video->getLink(); ?>"><?php echo $video->getLink(); ?></a>
                    </p>
                <?php endif ?>
                <?php include_component('item2item', 'show', array('item_type'=>ItemtypesPeer::ITEM_TYPE_VIDEO, 'item_id'=>$video->getId())) ?> 
			</div>
		<?php endif ?>

	<?php if (empty($short)): ?>	
		</div>
	<?php endif ?>

<?php endif ?>