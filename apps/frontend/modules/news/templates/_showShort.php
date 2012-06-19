<?php if ($newsitem && $newsitem->getBody() != ''): ?>

	<?php $href = $newsitem->getUrl(); ?>    
    <h2 class="title">
        <a href="<?php echo $href; ?>" title="<?php echo __('News') ?>">
            <?php echo $newsitem->getTitle(); ?> <?php /*if ($newsitem->getIsTeaching()): ?>[<?php echo __('teaching') ?>]<?php endif */?>
        </a>
        <a class="small simple" href="<?php echo url_for('@' . $newsitem->getTypeName() . '_index'); ?>">[<?php echo __($newsitem->getTypeNameCapital()) ?>]</a>
    </h2>

    <div class="date"> 
        <?php if ($newsitem->getExtradate()): ?><?php echo $newsitem->getExtradate(); ?> / <?php elseif ($newsitem->getDate()): ?><?php echo format_datetime( $newsitem->getDate(), 'd MMMM yyyy'); ?> / <?php endif ?>
        <?php echo __('Updated on') ?> <?php echo format_datetime( $newsitem->getUpdatedAtMax(), 'd MMMM yyyy'); ?>        
    </div>
    <div class="short_body p">
        <?php if ($newsitem->getImg() && $newsitem->getThumbUrl()): ?>
            <a href="<?php echo $href; ?>" title="<?php echo $newsitem->getTitle(); ?>">
                <img src="<?php echo $newsitem->getThumbUrl(); ?>" 
            alt="<?php echo $newsitem->getTitle(); ?>" class="newsitem_img"/></a>
        <?php endif ?>

        <?php 
            $shortbody_prepared = html_entity_decode($newsitem->geShortbodyPrepared()); 
            echo $shortbody_prepared;
            if (strlen($shortbody_prepared) > 200) {
                echo '...';
            }
        ?>
        <div class="spacer">&nbsp;</div>
        <p class="toolbar">				 
            <a href="<?php echo $href; ?>" title="<?php echo __('Read more') ?>" class="read_more">
                <i class="read_more_icon"></i>&nbsp;<?php echo __('Read more') ?>
            </a>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <i class="comments_icon"></i>&nbsp;<?php echo __('Comments') ?>: 
            <a href="<?php echo $href; ?>#disqus_thread" data-disqus-identifier="<?php echo $newsitem->getCommentsIdentifier(); ?>">0<?php //echo $newsitem->getCommentsCount(); ?></a>
        </p>
    </div>	
<?php endif ?>