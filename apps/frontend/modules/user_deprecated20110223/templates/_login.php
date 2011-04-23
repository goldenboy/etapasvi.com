<div class="login_form_container">

<script type="text/javascript">
	$(document).ready(function() {
		$(".login_form_element").validate({
					rules: {
					    name: "required",
						password: "required"
					},
					messages: {
						name: "",
						password: ""
					}
		});
	});
</script>

<?php if (isset($error_login)&& $error_login != ''): ?>
	<p class="error_list p1 no_decor"><?php echo __('Wrong login or password') ?></p>
<?php endif ?>

<form action="<?php echo (isset($form_action) ? $form_action : ''); ?>" method="post" class="login_form_element">

<table class="login_form right_text" cellspacing="0" cellpadding="0" border="0" >
	<tr>
		<td class="field_name"><?php echo __('Login ') ?></td>
		<td>
			<input type="text" value="<?php echo (isset($_POST['name']) ? $_POST['name'] : '')?>" name="name"/>
			<?php if (isset($error_name) && $error_name != ''): ?>
				<span class="error_list">&nbsp;&nbsp;<?php echo __('Enter login') ?></span>
			<?php endif ?>
		</td>
	</tr>
	<tr>
		<td class="field_name"><?php echo __('Password') ?></td>
		<td>
			<input type="password" value="" name="password"/>			
			<?php if (isset($error_password) && $error_password != ''): ?>
				<span class="error_list">&nbsp;&nbsp;<?php echo __('Enter password') ?></span>
			<?php endif ?>
		</td>
	</tr>	
</table>
<p class="p1">
	<input type="checkbox" 
	<?php if ( (isset($_POST['remember_me']) && $_POST['remember_me']=='on') || !isset($_POST['name']) ): ?>
		checked="checked"
	<?php endif ?>
	 name="remember_me"/> 
	<?php echo __('Remember me') ?>
</p>
<p>
	<?php if (isset($from) && $from != ''): ?>
		<input type="hidden" name="from" value="<?php echo $from ?>"/>
	<?php endif ?>
	<input type="submit" value="<?php echo __('Login') ?>" name="submit_login" class="input_submit"/>
</p>
</form>
</div>