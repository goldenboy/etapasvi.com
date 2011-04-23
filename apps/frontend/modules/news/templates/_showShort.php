<?php if ($newsitem && $newsitem->getBody() != ''): ?>

	<?php 
        //$href = url_for($this->getTypeName() . '/show?id='.$newsitem->getId() . '&title=' . TextPeer::urlTranslit($newsitem->getTitle()), true ); 
        $href = $newsitem->getUrl(); 
    ?>

    <h2 class="title">
        <a href="<?php echo $href; ?>" title="<?php echo __('News') ?>">
            <?php echo $newsitem->getTitle(); ?> <?php /*if ($newsitem->getIsTeaching()): ?>[<?php echo __('teaching') ?>]<?php endif */?>
        </a>
    </h2>
    <div class="short_body p">
        <?php if ($newsitem->getImg()): ?>
            <a href="<?php echo $href; ?>" title="<?php echo $newsitem->getTitle(); ?>">
                <img src="<?php echo $newsitem->getThumbUrl(); ?>" 
            alt="<?php echo $newsitem->getTitle(); ?>" class="newsitem_img"/>
            </a>
        <?php endif ?>

        <?php if ($newsitem->getDate() || $newsitem->getExtradate()): ?>
            <span class="left date">				
                <?php if ($newsitem->getExtradate()): ?>
                    <?php echo $newsitem->getExtradate(); ?>
                <?php else: ?>
                    <?php echo format_datetime( $newsitem->getDate(), 'd MMMM yyyy'); ?>
                <?php endif ?>			
            </span>
            <br/>
        <?php endif ?>

        <?php 
            $shortbody_prepared = html_entity_decode($newsitem->geShortbodyPrepared()); 
            echo $shortbody_prepared;
            if (strlen($shortbody_prepared) > 200) {
                echo '...';
            }
        ?>
        <div>&nbsp;</div>
        <p class="right_text p1_no_bottom">				 
            <a href="<?php echo $href; ?>" title="<?php echo __('Read more') ?>" class="read_more">
                <i class="read_more_icon"></i>&nbsp;<?php echo __('Read more') ?>
            </a>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <i class="comments_icon"></i>&nbsp;<?php echo __('Comments') ?>: 
            <a href="<?php echo $href; ?>#disqus_thread" data-disqus-identifier="<?php echo $newsitem->getCommentsIdentifier(); ?>">0<?php //echo $newsitem->getCommentsCount(); ?></a>
        </p>
    </div>
	

<?php endif ?>