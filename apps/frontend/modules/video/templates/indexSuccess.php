<?php slot('body_id') ?>body_video<?php end_slot() ?>
<h1><?php echo __('Video') ?></h1>

<?php 
include_partial('global/navigation', array('pager'=>$pager, 'module_action'=>'video/index') ); 
$video_list = $pager->getResults();
?>

<?php if (count($video_list)): ?>
    <?php include_partial( 'video/list', array('video_list' => $video_list)); ?>
<?php else: ?>
	<p class="center error_list p2">
		<?php echo __('No Videos') ?>
	</p>
<?php endif ?>

<?php include_partial('global/navigation', array('pager'=>$pager, 'module_action'=>'video/index') ); ?>