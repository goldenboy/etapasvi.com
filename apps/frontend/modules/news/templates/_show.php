<?php if ($newsitem && $newsitem->getBody() != ''): ?>
	<?php $href = url_for('news/show?id='.$newsitem->getId() . '&title=' . TextPeer::urlTranslit($newsitem->getTitle()), true ); ?>
				
    <h1 class="title">
        <?php echo $newsitem->getTitle(); ?><?php /*if ($newsitem->isTypeTeachings()): ?>[<?php echo __('teaching') ?>]<?php endif */?>
    </h1>
    <p class="date p1_no_top">
        <?php if ($newsitem->getExtradate()): ?>
            <?php echo $newsitem->getExtradate(); ?>
        <?php else: ?>
            <?php echo format_datetime( $newsitem->getDate(), 'd MMMM yyyy'); ?>
        <?php endif ?>
    </p>
    <p class="center_text p1_no_bottom">
        <?php if ($newsitem->getImg()): ?>
            <img src="<?php echo $newsitem->getFullUrl(); ?>" 
            alt="<?php echo $newsitem->getTitle(); ?>" class="news_img"/>
        <?php endif ?>
    </p>

    <?php echo html_entity_decode(/*str_ireplace( '&lt;br /&gt;', '</p><p class="p1">',*/ $newsitem->getBodyPrepared() /*)*/ ); ?><br/>
    
    <?php if ($newsitem->isTypeTeachings() && $newsitem->getOriginal() && $newsitem->getOriginal() != $newsitem->getBody()): ?>
        <p>
            <br/><a href="javascript:showOriginal();"><?php echo __('Original text') ?></a> <span class="slide_arrow ">▼</span>
        </p>
        <p id="elOriginal" class="hidden">
            <br/>
            <?php echo html_entity_decode(/*str_ireplace( '&lt;br /&gt;', '</p><p class="p1">',*/ $newsitem->getOriginalPrepared() /*)*/ ); ?>
        </p>		
    <?php endif ?>

    <?php if ($newsitem->getAuthor()): ?>
        <p class="author">				
            <strong><?php echo __('Author') ?>:</strong> <?php echo $newsitem->getAuthor(); ?>
        </p>
    <?php endif ?>
    
    <?php if ($newsitem->getTranslatedBy()): ?>
        <p class="p1_no_bottom author">				
            <strong><?php echo __('Translated by') ?>:</strong> <?php echo $newsitem->getTranslatedBy(); ?>
        </p>
    <?php endif ?>            

    <?php $link = $newsitem->getLink($sf_user->getCulture(), true); ?>
    <?php if ($link): ?>
        <p class="p1_no_bottom source">
        <?php if (strstr($link, 'http')): ?>
            <strong><?php echo __('Source') ?>:</strong> <br/><a href="<?php echo $link; ?>" rel="nofollow" class="external"><?php echo TextPeer::cropLink( $link ); ?></a>					
        <?php else: ?>					
            <?php echo $link; ?>
        <?php endif ?>
        </p>
    <?php endif ?>
            
    <?php include_component('item2item', 'show', array('item_type'=>ItemtypesPeer::ITEM_TYPE_NEWS, 'item_id'=>$newsitem->getId())) ?> 

<?php endif ?>