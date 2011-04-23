<?php use_helper('Validation'); ?>
<?php use_helper('Form'); ?>
<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>

<script type="text/javascript">
    var form_dom_element;
	$(document).ready(function() {
    
        $("#signup_form input").change(function() {
            //$("input[name='"+$(this).attr("name")+"'] .error_list").eq(1).html('');
            var field_name = $(this).attr("name");
            field_name = field_name.replace(/(user\[|\])/gi, '');
            $(".for_" + field_name).html('');
            $(".for_" + field_name).hide();
        });
		$.validator.addMethod("alphanumeric", function(element) {
			var re = new RegExp("^\\w+$", "");									
			return re.test( $("#user_name").val() );
		}); 
		<?php /*
		jQuery.validator.addMethod("checklogin", function(element) {
			$.post("<?php echo url_for("user_checklogin"); ?>", { user_name: $("#user_name").val() }, function(data){		
				if (data.busy == '0') {
					return true;
				} else {
					return false;
				}
			});
		});
		*/ ?>

		$("#signup_form").validate({
                    /*errorPlacement: function(error,element) {
                        return true;
                    },*/
					submitHandler: function(form) {
                        $.each($("#signup_form div.error_list"), function(index, value) { 
                            if ($.trim($(this).html())) {
                                return false;
                            }
                        });
						$("#submit_signup").attr("disabled", "disabled");
						$("#signup_ajax_loader").show();
						form.submit();
					},
					invalidHandler: function(form, validator) {
					    $("#signup_ajax_loader").hide();
					    $("#submit_signup").show();
					},
					focusCleanup: true,
					onkeyup: false,
					focusInvalid: false,
					rules: {
						"user[name]": {
							minlength: 2,
							maxlength: 20,
							required: true,
							alphanumeric: true					
						},
						"user[email]": {
							required: true,
							email: true
						},
                        "user[profile]": {
                            url: true
                        },
						"user[password]": "required",
						"retype_password": {
							required: true,
							equalTo: "#user_password"
						},
						"captcha": "required"
					},
					messages: {
						"user[name]": {
							required: "",
							alphanumeric: "<?php echo __('Login must be alphanumeric (only letters and digits avaible)') ?>",
							minlength: "<?php echo __('Login must be at least 2 characters') ?>",
							maxlength: "<?php echo __('Login must not exceed 20 characters') ?>"
						},
						"user[email]": {
							required: "",
							email: "<?php echo __('Please enter a valid email address') ?>"
						},
                        "user[profile]": {
                            url: "<?php echo __('Please enter a valid URL') ?>"
                        },
						"user[password]": "",
						"retype_password": {
							required: "",
							equalTo: "<?php echo __('Please enter the same password as above') ?>"
						},
						"captcha": ""
					}
		});
		<?php
        /*
		// если была отправлена форма не надо устанавливать Часовой пояс
		if ( !$sf_request->isMethod('post') ):
		?>
		var is_tz_found = false;
		var item_tz_offset = 0;
		var d = new Date();
		user_tz_offset = -d.getTimezoneOffset() / 60;
		$("select#user_timezone_id > option").each( function (i) {
			if (is_tz_found) return;

			item_text = $(this).text();
			item_tz_offset = item_text.substring(4,7) * 1;

			if ( isNaN(item_tz_offset) ) {
				item_tz_offset = 0;
			}
			if (item_tz_offset >= user_tz_offset ) {
				$("#user_timezone_id").attr('selectedIndex', i);
				is_tz_found = true;
			}
		});
		<?php endif	*/?>
	});
</script>

<form action="" method="post" id="signup_form">

<table class="signup" cellspacing="0" cellpadding="0" border="0">
	<tr>
		<td class="field_name"><?php echo $form['name']->renderLabel() ?> <span class="error_list">*</span></td>
		<td class="field_input"><?php echo $form['name'] ?>
            <?php if ($form['name']->hasError()): ?>
			<div class="error_list for_name" id="user_name_error">
				<?php echo $form['name']->renderError() ?>
			</div>
            <?php endif ?>
		</td>
	</tr>
	<tr>
		<td class="field_name"><?php echo $form['email']->renderLabel() ?> <span class="error_list">*</span></td>
		<td class="field_input"><?php echo $form['email'] ?>
            <?php if ($form['email']->hasError() || $error_email || $error_dublicate_email): ?>
			<div class="error_list for_email">
				<?php echo $form['email']->renderError() ?>
				<?php if ($error_email==1): ?>
					<?php echo __('Please enter a valid email address') ?>
				<?php endif ?>
				<?php if ($error_dublicate_email==1): ?>
					<?php echo __('E-mail is already in use, please choose another') ?>
				<?php endif ?>
			</div>
            <?php endif ?>
		</td>
	</tr>
	<tr>
		<td class="field_name"><?php echo $form['profile']->renderLabel() ?> <?php echo __('(optional)') ?></td>
		<td class="field_input">
			<?php echo $form['profile'] ?>
			<span class="small light"><?php echo __('Example') ?>: http://www.myspace.com/profile</span>
            <div class="error_list for_profile"><?php echo $form['profile']->renderError() ?></div>
		</td>
	</tr>
	<tr>
		<td class="field_name"><?php echo $form['password']->renderLabel() ?> <span class="error_list">*</span></td>
		<td class="field_input">
			<?php echo $form['password'] ?>
			<div class="error_list for_password"><?php echo $form['password']->renderError() ?></div>
		</td>
	</tr>
	<tr>
		<td class="field_name"><?php echo __('Confirm Password') ?> <span class="error_list">*</span></td>
		<td class="field_input"><input type="password" id="user_retype_password" value="<?php echo $retype_password; ?>" name="retype_password"/>
        <?php if ($error_retype_password==1): ?>
            <div class="error_list for_password"><?php echo __('Passwords do not match') ?></div>
        <?php endif ?>
		</td>
	</tr>
<?php /*
	<tr>
		<td class="field_name"><?php echo $form['timezone_id']->renderLabel() ?> <span class="error_list">*</span></td>
		<td><?php echo $form['timezone_id'] ?><label class="error_list"><?php echo $form['timezone_id']->renderError() ?></label></td>
	</tr>
*/?>
	<tr>
		<td class="field_name"><img src="<?php echo url_for('@sf_captcha'); ?>?c=<?php echo time(); ?>" class="captcha"/></td>
		<td class="field_input">
			<?php echo input_tag('captcha'); ?>
			<?php if ($error_captcha): ?>
				<div class="error_list for_captcha"><?php echo __('Incorrect code') ?></div>
			<?php endif ?>            
		</td>
	</tr>
</table>
<p style="display:none" id="signup_ajax_loader">
    <img src="/images/ajax_loader.gif" />
</p>
<p class="p1">
	<?php /* echo $form->renderHiddenFields() */?>
	<?php /*<input type="hidden" value="1" name="user[is_active]"/> */ ?>
	<input type="submit" value="<?php echo __('Sign up') ?>" name="submit_signup" class="input_submit" id="submit_signup"/>	
</p>

</form>
