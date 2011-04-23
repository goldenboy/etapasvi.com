<?php slot('body_id') ?>body_news<?php end_slot() ?>
<h1><?php echo __('News') ?></h1>

<?php
/*
<p class="no_decor center_text">
	<?php echo __('Start from') ?>: 
	<?php if ($sf_request->getParameter('start_from')=='oldest') : ?>
		<a href="<?php echo url_for('@news_index', true); ?>"><?php echo __('newest') ?></a> | <span class="unchecked_text"><?php echo __('oldest') ?></span>
	<?php else: ?>
		<span class="unchecked_text"><?php echo __('newest') ?></span> | <a href="<?php echo url_for('news/index?start_from=oldest'); ?>"><?php echo __('oldest') ?></a>
	<?php endif ?>
</p>
*/
?>

<?php 
$navigation_html = get_partial('global/navigation', array('pager'=>$pager, 'order_parameter'=>'start_from', 'module_action'=>'news/index') ); 
echo $navigation_html;

$news_list = $pager->getResults();
?>

<?php if (count($news_list)): ?>
	<?php include_partial('news/list', array('news_list'=>$news_list)); ?>
<?php else: ?>
	<p class="center error_list p2">
		<?php echo __('No News') ?>.
	</p>
<?php endif ?>

<?php echo $navigation_html; ?>

<?php include_partial('comments/count'); ?>