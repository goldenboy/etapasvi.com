<?php slot('body_id') ?>body_main<?php end_slot() ?>

<h1><?php echo __('A message of peace, an appeal to the world') ?></h1>

<div id="menu">
<?php include_partial('global/menu', array('body_id'=>$body_id /*, 'is_logged_in'=>UserPeer::authIsLoggedIn()*/) ); ?>	
</div>

<?php include_component('comments', 'show') ?>