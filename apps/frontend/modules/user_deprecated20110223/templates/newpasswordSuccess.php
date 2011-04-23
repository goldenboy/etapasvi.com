<?php slot('body_id') ?>body_member<?php end_slot() ?>
<script type="text/javascript">
	$(document).ready(function() {
		$("#new_password_form").validate({
					rules: {
					    new_password: "required",
						new_password_confirm: {
							required: true,
							equalTo: "#new_password"
						},
					},
					messages: {
						new_password: "",
						new_password_confirm: {
							required: "",
							equalTo: "<?php echo __('Please enter the same password as above') ?>"
						},
					}
		});
	});
</script>

<h1><?php echo __('New Password') ?></h1>

<?php if ($result == 'ok'): ?>

	<p class="center_text">
		<?php echo __('Your password successfully changed. Now you can') ?> <a href="<?php echo url_for('user/login'); ?>">
		<?php echo __('login ') ?></a>
	</p>

<?php else: ?>

	<p class="p1 center_text">
		<?php echo __('Enter your new Password') ?>
	</p>

	<?php if ( $result == 'error' ): ?>
		<p class="error_list p1 center_text">
			<?php echo __('Passwords do not match') ?>.
		</p>
	<?php endif ?>

	<form action="" method="post" id="new_password_form">

	<table cellspacing="0" cellpadding="0" border="0" class="form_table center_table">
		<tr>
			<td class="field_name"><?php echo __('New Password') ?> </td>
			<td>
				<input type="password" value="" name="new_password" id="new_password"/>
			</td>
		</tr>
		<tr>
			<td class="field_name"><?php echo __('Confirm New Password') ?> </td>
			<td>
				<input type="password" value="" name="new_password_confirm"/>
			</td>
		</tr>
	</table>
	<p class="p1 center_text">
		<input type="submit" value="<?php echo __('Change') ?>" name="submit_new_password" class="input_submit"/>
	</p>

	</form>
<?php endif ?>
