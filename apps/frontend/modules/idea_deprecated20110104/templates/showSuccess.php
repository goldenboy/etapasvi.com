<?php use_helper('Date') ?>
<?php slot('body_id') ?>body_idea<?php end_slot() ?>
<h1><?php echo __('Idea of the Week') ?></h1>
<h2><?php echo __('My') ?></h2>

<a href="<?php echo url_for('@index_idea'); ?>" class="no_decor">« <?php echo __('All') ?></a>

<?php if ($idea): ?>
	<?php include_component('idea', 'show', array('idea'=>$idea)) ?>
	<?php include_component('comments', 'show', array('for'=>CommentsPeer::FOR_IDEA, 'id'=>$idea->getId())) ?>
	<?php include_component('comments', 'post', array('from'=>UserPeer::FROM_IDEA_COMMENT, 'id'=>$idea->getId(), 'body_id'=>'idea')) ?>
<?php endif ?>