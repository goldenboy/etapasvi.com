<?php slot('body_id') ?>body_best<?php end_slot() ?>
<h1><?php echo __('Idea of the Week') ?></h1>
<h2><?php echo __('Best') ?></h2>


<?php if ($idea): ?>
	<p>	
		<a href="<?php echo url_for('@idea_ideaoftheweek'); ?>" class="no_decor">« <?php echo __('All') ?></a>
	</p>
	<?php include_component('idea', 'show', array('idea'=>$idea, 'from'=>'best')) ?>
	<?php include_component('comments', 'show', array('for'=>CommentsPeer::FOR_IDEA, 'id'=>$idea->getId())) ?>
	<?php include_component('comments', 'post', array('from'=>UserPeer::FROM_IDEA_COMMENT, 'id'=>$idea->getId(), 'body_id'=>'best')) ?>
<?php else: ?>
	<p>
		<span class="right"><a href="<?php echo url_for('@new_idea') ?>" title="meditation"><?php echo __('Create an Idea') ?></a></span>
	</p>
	<p class="center error_list p2">
		<?php echo __('No best Idea') ?>.
	</p>
<?php endif ?>