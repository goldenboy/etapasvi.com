<?php if ($photoalbum->getImg()): ?>
    <?php $title = $photoalbum->getTitle($sf_user->getCulture(), true); ?>
    <a href="<?php echo url_for('photo/album?id='.$photoalbum->getId()); ?>" title="<?php echo $title; ?>">
        <img src="<?php echo $photoalbum->getImg(); ?>" 
        alt="<?php echo $title; ?>" class="photoitem_img"/></a>
    <p class="center p1_no_bottom">                        
        <?php if ($title): ?>
            <?php echo $title; ?><br/>
        <?php endif ?>
        <span class="small light"><?php echo __('Photo') ?>: <?php echo $photoalbum->countPhotos(); ?></span><br/>
        <span class="date"><?php echo format_datetime( $photoalbum->getCreatedAt(), 'd MMMM yyyy'); ?></span>                                                
    </p>
<?php endif ?>	 