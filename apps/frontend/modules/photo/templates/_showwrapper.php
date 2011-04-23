<?php /*slot('meta') ?>
<link rel="canonical" href="<?php echo url_for('photo/show?id='.$photo->getId() . '&title=' . TextPeer::urlTranslit($photo->getTitle())); ?>" />
<?php end_slot()*/ ?>

<?php slot('body_id') ?>body_photo<?php end_slot() ?>
<h1 id="top"><?php echo __('Photo') ?></h1>

<p class="bread_crumbs">	
<?php
    $photoalbum = $photo->getPhotoalbum();
?>
    <a href="<?php echo url_for('@main'); ?>"><?php echo __('Home') ?></a> » <a href="<?php echo url_for('@photo_albums'); ?>"><?php echo __('Photo Albums') ?></a> 
    <?php if (!empty($photoalbum)):?> » <a href="<?php echo url_for('photo/album?id=' . $photoalbum->getId()); ?>"><?php echo ($photoalbum->getTitle() ? $photoalbum->getTitle() : __('Photo Album')); ?></a><?php endif ?>
</p>

<div class="box photofull">
    <?php include_partial('show', array('photo'=>$photo, 'next_photo'=>$next_photo, 'prev_photo'=>$prev_photo) ); ?>
</div>