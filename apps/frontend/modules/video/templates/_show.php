<?php if ($video && $video->getCode() != ''): ?>	
	<?php 
        $title = $video->getTitle();
        if (!$title && $sf_user->getCulture() != UserPeer::DEFAULT_CULTURE) {
            $title = $video->getTitle(UserPeer::DEFAULT_CULTURE);
        }
		if ($title):
			$href = url_for('video/show?id='.$video->getId() . '&title=' . TextPeer::urlTranslit($video->getTitle()) ); 
		else:
			$href = url_for('video/show?id='.$video->getId() ); 
		endif
	?>

	<?php if (empty($short)): ?>	
		<div class="box video">
	<?php endif ?>

		<?php if (!empty($short)): ?>
			<?php /*if ($video->getImg()):*/ ?>
				<a href="<?php echo $href; ?>" title="<?php echo $title; ?>">
					<img src="<?php echo $video->getImgPrepared(); ?>" 
					alt="<?php echo $title; ?>" />
				</a>
				<?php if ( $title ): ?>
				<p class="p1_no_top">
					<a href="<?php echo $href; ?>" title="<?php echo $title; ?>">
						<?php echo html_entity_decode( $video->getTitlePrepared($title) ); ?>...
					</a>				
				</p>
				<?php endif ?>
			<?php /* endif */ ?>	
		<?php else: ?>		
			<h1 class="title">
				<?php echo $title; ?>
			</h1>
			
			<p class="center_text p1_no_bottom">
                <?php if (strlen($video->getCode()) <20): ?>
				<object width="480" height="385"><param name="movie" value="http://www.youtube-nocookie.com/v/<?php echo $video->getCode(); ?>&amp;hl=<?php echo $sf_user->getCulture(); ?>&amp;fs=1&amp;"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube-nocookie.com/v/<?php echo $video->getCode(); ?>&amp;hl=<?php echo $sf_user->getCulture(); ?>&amp;fs=1&amp;" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="480" height="385"></embed></object>
                <?php else: ?>
                    <?php echo html_entity_decode($video->getCode()); ?>
                <?php endif ?>
			</p>

		<?php endif ?>

		<?php if (empty($short)): ?>
			<div class="video_info">
				<p class="date right_text p1_no_both">
					<?php echo format_date( $video->getCreatedAt(), 'd MMMM yyyy' ); ?>
				</p>
				<?php if ($video->getBody()): ?>
				<?php echo html_entity_decode($video->getBodyPrepared()); ?>
				<?php endif ?>
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
                    <p class="author">				
                        <strong><?php echo __('Author') ?>:</strong> <?php echo $author; ?>
                    </p>
                <?php endif ?>
                <?php include_component('item2item', 'show', array('item_type'=>ItemtypesPeer::ITEM_TYPE_VIDEO, 'item_id'=>$video->getId())) ?> 
			</div>
		<?php endif ?>

	<?php if (empty($short)): ?>	
		</div>
	<?php endif ?>

<?php endif ?>