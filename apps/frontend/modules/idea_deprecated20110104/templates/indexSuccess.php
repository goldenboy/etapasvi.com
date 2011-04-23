<?php slot('body_id') ?>body_ideas<?php end_slot() ?>
<h1><?php echo __('Idea of the Week') ?></h1>
<h2><?php echo __('All') ?></h2>

<?php include_partial('global/navigation', array('pager'=>$pager, 'order_parameter'=>'orderby', 'module_action'=>'idea/index') ); ?>

<p class="no_decor">
	<!--<?php echo __('Total') ?>: <?php echo (int)$pager->getNbResults(); ?>
	<br/>
	-->
	<?php if (count($pager->getResults())): ?>
	<span class="left">
		<?php echo __('Order by') ?>: 
		<?php if ($sf_request->getParameter('orderby')=='votes') : ?>
			<a href="<?php echo url_for('@index_idea'); ?>"><?php echo __('date') ?></a> | <span class="unchecked_text"><?php echo __('votes') ?></span>
		<?php else: ?>
			<span class="unchecked_text"><?php echo __('date') ?></span> | <a href="<?php echo url_for('idea/index?orderby=votes'); ?>"><?php echo __('votes') ?></a>
		<?php endif ?>
	</span>
	<?php endif ?>
	<span class="right"><a href="<?php echo url_for('@new_idea') ?>" title="meditation"><?php echo __('Create an Idea') ?></a></span>	
</p>

<?php if (count($pager->getResults())): ?>
	<?php foreach ($pager->getResults() as $idea): ?>
		<?php include_component('idea', 'show', array('idea'=>$idea, 'short'=>true, 'from'=>'ideas')) ?>
	<?php endforeach; ?>
<?php else: ?>
	<p class="center error_list p2">
		<?php echo __('No Ideas') ?>.
	</p>
<?php endif ?>

<?php include_partial('global/navigation', array('pager'=>$pager, 'order_parameter'=>'orderby', 'module_action'=>'idea/index') ); ?>