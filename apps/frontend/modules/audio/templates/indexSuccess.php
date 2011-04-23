<?php slot('body_id') ?>body_audio<?php end_slot() ?>
<h1><?php echo __('Audio') ?></h1>
<br/>
<?php include_partial('audio/list', array('audio_list'=>$audio_list)); ?>
<br/><br/>
<?php include_component('comments', 'show'); ?>	