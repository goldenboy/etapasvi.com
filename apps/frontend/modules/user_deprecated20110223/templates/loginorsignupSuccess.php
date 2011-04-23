<?php slot('body_id') ?>body_member<?php /*echo $from*/ ?><?php end_slot() ?>
<?php slot('body_class') ?>body_class_no_minilogin<?php end_slot() ?>
<h1><?php echo __('Login or Sign Up') ?></h1>

<div class="center_text">

<h2><?php echo __('Login') ?></h2>
<?php 
	include_partial('login', 
		array('error_login'=>$error_login, 'error_email'=>$error_email, 'error_password'=>$error_password) ) 
?>
<p class="center_text">
	<a href="<?php echo url_for('@user_forgotpassword', true); ?>" title="<?php echo __('Forgot password?') ?>">
		<?php echo __('Forgot password?') ?>
	</a>
</p>
<?php
/*
<p class="center_text">
	<a href="javascript:window.history.back();" ><?php echo __('Back') ?></a>
</p>
*/?>
<h2><?php echo __('Sign Up') ?></h2>
<?php include_partial(	
	'signup',
	array('form' => $form, 'retype_password'=>$retype_password, 'error_retype_password'=>$error_retype_password, 'error_email'=>$error_email, 'error_captcha'=>$error_captcha, 'error_dublicate_email'=>$error_dublicate_email)
) ?>
<?php
/*
<p class="center_text">
	<a href="javascript:window.history.back();" ><?php echo __('Back') ?></a>
</p>
*/
?>
</div>