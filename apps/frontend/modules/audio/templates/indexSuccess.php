<?php slot('body_id') ?>body_audio<?php end_slot() ?>
<h1><?php echo __('Audio') ?></h1>

<?php 
include_partial('global/navigation', array('pager'=>$pager, 'module_action'=>'audio/index') ); 
$audio_list = $pager->getResults();
?>

<?php include_partial( 'audio/list', array('audio_list' => $audio_list)); ?>

<?php include_partial('global/navigation', array('pager'=>$pager, 'module_action'=>'audio/index') ); ?>