<?php slot('body_id') ?>body_login<?php end_slot() ?>
<?php slot('body_class') ?>body_class_no_minilogin<?php end_slot() ?>
<h1><?php echo __('Login') ?></h1>

<div class="center_text">
<?php 
	include_partial('login', 
		array('error_login'=>$error_login, 'error_name'=>$error_name, 'error_password'=>$error_password, 'from'=>$from) ) 
?>
</div>
<p class="p1 center_text">
    <a href="<?php echo url_for('@user_signup', true); ?>" title="<?php echo __('Sign up') ?>"><?php echo __('Sign up') ?></a>
</p>
<p class="p1 center_text">
	<a href="<?php echo url_for('@user_forgotpassword', true); ?>" title="<?php echo __('Forgot password?') ?>">
		<?php echo __('Forgot password?') ?>
	</a>
</p>