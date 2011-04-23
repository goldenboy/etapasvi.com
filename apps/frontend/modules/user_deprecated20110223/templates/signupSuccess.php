<?php slot('body_id') ?>body_signup<?php end_slot() ?>
<h1 class="m_bottom"><?php echo __('Sign up') ?></h1>

<div class="center_text">
<?php 
/*
<p class="p1 p1_no_bottom">
	<?php echo __('Please pay attention to Time zone field') ?>.
</p>
<p class="p1_no_top">
	<?php echo __('Time for thinking is shown taking into account your Time zone') ?>.
</p>
*/
?>
<?php include_partial(	
	'signup',
	array('form' => $form, 'retype_password'=>$retype_password, 'error_retype_password'=>$error_retype_password, 'error_email'=>$error_email, 'error_login_spaces'=>$error_login_spaces, 'error_captcha'=>$error_captcha, 'error_dublicate_email'=>$error_dublicate_email )
) ?>

<p>
	<?php echo __('If you already have an') ?> <b>e</b>Tapasvi<?php echo __(' account, you can sign in') ?> <a href="<?php echo url_for('@user_login', true); ?>" ><?php echo __('here') ?></a>
</p>
</div>