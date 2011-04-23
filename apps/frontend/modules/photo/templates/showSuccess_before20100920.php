<?php slot('meta') ?>
<?php 
if ($back_to_photo) {
	$back_to_photo = preg_replace('/.com\/([a-z]{2})\//', '.com/' . $sf_user->getCulture() . '/', $back_to_photo);
} else {
	$back_to_photo = url_for('@photo_index');
}
?>
<link rel="canonical" href="<?php echo url_for('photo/show?id='.$photo->getId() . '&title=' . TextPeer::urlTranslit($photo->getTitle())); ?>" />
<?php end_slot() ?>
<?php slot('body_id') ?>body_photo<?php end_slot() ?>
<h2 class="like_h1" id="top"><?php echo __('Photo') ?></h2>

<p class="no_decor bread_crumbs">	
	<a href="<?php echo $back_to_photo; ?>">« <?php echo __('Photo') ?></a>
</p>

<?php if ($photo): ?>
	<div class="box photofull">
		<?php include_partial('show', array('photo'=>$photo, 'next_photo'=>$next_photo, 'prev_photo'=>$prev_photo) ); ?>
	</div>
	<?php include_component('comments', 'show', array('for'=>CommentsPeer::FOR_PHOTO, 'id'=>$photo->getId())) ?>
	<?php include_component('comments', 'post', array('from'=>UserPeer::FROM_PHOTO_COMMENT, 'id'=>$photo->getId(), 'body_id'=>'photo')) ?>
<?php endif ?>
<p class="back">
	<a href="#top"><?php echo __('Go to top') ?></a>
</p>