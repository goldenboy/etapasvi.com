<?php slot('body_id') ?>body_member<?php end_slot() ?>
<script type="text/javascript">
	$(document).ready(function() {
		$("#forgot_password_form").validate({
					rules: {
					    remind_email: "required"
					},
					messages: {
						remind_email: ""
					}
		});
	});
</script>

<h1><?php echo __('Forgot password?') ?></h1>

 <?php if ( $result == 'ok' ): ?>
	<p class="alert p1 center_text">
		<?php echo __('A letter with further instructions has been sent to your e-mail') ?>.
	</p>
<?php else: ?>
	<p class="p1 center_text">
		<?php echo __('To get a new Password for your account please enter E-mail') ?>.
	</p>
	<form action="" method="post" id="forgot_password_form">

	<table class="login_form center_table" cellspacing="0" cellpadding="0" border="0">
<?php/*
		<tr>
			<td class="field_name"><?php echo __('Login ') ?> </td>
			<td>
				<input type="text" value="<?php echo $login ?>" name="remind_name"/>
			</td>
		</tr>
*/
?>
		<tr>
			<td class="field_name"><?php echo __('E-mail ') ?> </td>
			<td>
				<input type="text" value="<?php echo $email ?>" name="remind_email"/>
			</td>
		</tr>
	</table>
    <?php if ( $result == 'error' ): ?>
		<p class="error_list p1 center_text">
			<?php echo __('User with e-mail') ?> <strong><?php echo $email; ?></strong> <?php echo __('not found') ?>.
		</p>
	<?php endif ?>
	<p class="p1 center_text">
		<input type="submit" value="<?php echo __('Remind') ?>" name="submit_remind" class="input_submit"/>
	</p>

	</form>
<?php endif ?>