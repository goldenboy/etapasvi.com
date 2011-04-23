<?php use_helper('Date') ?>
<?php 
if ($back_to_ideas) {
	$back_to_ideas = preg_replace('/.com\/([a-z]{2})\//', '.com/' . $sf_user->getCulture() . '/', $back_to_ideas);
} else {
	$back_to_ideas = url_for('@index_idea');
}
?>
<?php slot('body_id') ?>body_ideas<?php end_slot() ?>
<h1><?php echo __('Idea of the Week') ?></h1>
<h2><?php echo __('Idea of') ?> <?php echo $idea->getUser(); ?></h2>

<a href="<?php echo back_to_ideas; ?>" class="no_decor">« <?php echo __('All') ?></a>


<?php if ($idea): ?>
	<?php include_component('idea', 'show', array('idea'=>$idea)) ?>
	<?php include_component('comments', 'show', array('for'=>CommentsPeer::FOR_IDEA, 'id'=>$idea->getId())) ?>
	<?php include_component('comments', 'post', array('from'=>UserPeer::FROM_IDEA_COMMENT, 'id'=>$idea->getId(), 'body_id'=>'ideas')) ?>
<?php endif ?>
<p class="back">
	<a href="#top"><?php echo __('Go to top') ?></a>
</p>