<?php slot('body_id') ?>body_archive<?php end_slot() ?>
<h1><?php echo __('Idea of the Week') ?></h1>
<h2><?php echo __('Archive') ?></h2>


<?php include_partial('global/navigation', array('pager'=>$pager, 'order_parameter'=>'orderby', 'module_action'=>'idea/archive') ); ?>

<p class="index_toolbar">
	<!--<?php echo __('Total') ?>: <?php echo (int)$pager->getNbResults(); ?>
	<br/>
	-->
	<?php echo __('Order by') ?>: 
	<?php if ($sf_request->getParameter('orderby')=='votes') : ?>
		<a href="<?php echo url_for('@idea_archive'); ?>"><?php echo __('date') ?></a> | <span class="unchecked_text"><?php echo __('votes') ?></span>
	<?php else: ?>
		<span class="unchecked_text"><?php echo __('date') ?></span> | <a href="<?php echo url_for('idea/archive?orderby=votes'); ?>"><?php echo __('votes') ?></a>
	<?php endif ?>
</p>

<?php if (count($pager->getResults())): ?>
	<?php foreach ($pager->getResults() as $idea): ?>
		<?php include_component('idea', 'show', array('idea'=>$idea, 'short'=>true, 'from'=>'archive')) ?>
	<?php endforeach; ?>
<?php else: ?>
	<p class="center error_list p2">
		<?php echo __('No Ideas') ?>.
	</p>
<?php endif ?>

<?php include_partial('global/navigation', array('pager'=>$pager, 'order_parameter'=>'orderby', 'module_action'=>'idea/archive') ); ?>