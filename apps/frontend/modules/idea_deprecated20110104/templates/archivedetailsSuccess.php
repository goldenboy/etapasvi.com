<?php 
if ($back_to_archive) {
	$back_to_archive = preg_replace('/.com\/([a-z]{2})\//', '.com/' . $sf_user->getCulture() . '/', $back_to_archive);
} else {
	$back_to_archive = url_for('@idea_archive');
}
?>
<?php slot('body_id') ?>body_archive<?php end_slot() ?>
<h1><?php echo __('Idea of the Week') ?></h1>
<h2><?php echo __('Archive') ?></h2>

<p>	
	<a href="<?php echo $back_to_archive; ?>" class="no_decor">« <?php echo __('Archive') ?></a>
</p>

<?php if ($idea): ?>
	<?php include_component('idea', 'show', array('idea'=>$idea, 'from'=>'archive')) ?>
	<?php include_component('comments', 'show', array('for'=>CommentsPeer::FOR_IDEA, 'id'=>$idea->getId())) ?>
	<?php include_component('comments', 'post', array('from'=>UserPeer::FROM_IDEA_COMMENT, 'id'=>$idea->getId(), 'body_id'=>'ideas')) ?>
<?php endif ?>
<p class="back">
	<a href="#top"><?php echo __('Go to top') ?></a>
</p>