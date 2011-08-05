<?php /*slot('meta') ?>
<link rel="canonical" href="<?php echo url_for('photo/show?id='.$photo->getId() . '&title=' . TextPeer::urlTranslit($photo->getTitle())); ?>" />
<?php end_slot()*/ ?>

<?php slot('body_id') ?>body_photo<?php end_slot() ?>
<h1 id="top"><?php echo __('Photo') ?></h1>

<p class="bread_crumbs">	
<?php
    $photoalbum       = $photo->getPhotoalbum();
    $photoalbum_title = $photoalbum->getTitle($sf_user->getCulture(), true);
?>
    <a href="<?php echo url_for('@main'); ?>"><?php echo __('Home') ?></a> » <a href="<?php echo url_for('@photo_albums'); ?>"><?php echo __('Photo Albums') ?></a> 
    <?php if (!empty($photoalbum)):?> » <a href="<?php echo $photoalbum->getUrl(); ?>"><?php echo ($photoalbum_title ? $photoalbum_title : __('Photo Album')); ?></a><?php endif ?>
</p>

<div class="box photofull">
    <?php include_partial('show', array('photo'=>$photo, 'next_photo'=>$next_photo, 'prev_photo'=>$prev_photo) ); ?>
</div>