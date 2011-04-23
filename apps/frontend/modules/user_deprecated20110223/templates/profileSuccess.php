<?php slot('body_id') ?>body_member<?php end_slot() ?>
<?php use_helper('Form'); ?>
<?php include_javascripts_for_form($form) ?>

<h1><?php echo __('Profile') ?></h1>

<p class="bread_crumbs">	
	<a href="<?php echo url_for('@main'); ?>"><?php echo __('Home') ?></a> » <a href="<?php echo url_for('@user_member'); ?>"><?php echo __('Member') ?> </a>
</p>

<script type="text/javascript">
	$(document).ready(function() {
        $("#profile_form input").change(function() {
            //$("input[name='"+$(this).attr("name")+"'] .error_list").eq(1).html('');
            var field_name = $(this).attr("name");
            field_name = field_name.replace(/(user\[|\])/gi, '');
            $(".for_" + field_name).html('');
        });
            
        $("#profile_form").validate({              
            focusCleanup: true,
            onkeyup: false,
            focusInvalid: false,
            rules: {
                "user[email]": {
                    required: true,
                    email: true
                },
                "user[profile]": "url",
                "retype_password": {
                    equalTo: "#user_password"
                }
            },
            messages: {
                "user[email]": {
                    required: "<?php echo __('Please enter a valid email address') ?>",
                    email: "<?php echo __('Please enter a valid email address') ?>"
                },
                "user[profile]": {
                    url: "<?php echo __('Please enter a valid URL') ?>"
                },
                "retype_password": {
                    equalTo: "<?php echo __('Please enter the same password as above') ?>"
                }
            }
        });
    });
    
    function deleteSubmit()
    {
        return confirm("<?php echo __('Are you shure you want to delete your account?') ?>");
    }
</script>

<?php if ($result == 'ok'): ?>
	<p class="alert center_text"><?php echo __('Profile has been successfully updated') ?></p>
<?php endif ?>

<form action="" method="post" id="profile_form">
<?php/*
<h2>
	<?php echo __('Edit profile') ?>
</h2>
*/?>

<table class="signup" cellspacing="0" cellpadding="0" border="0" >
	<tr>
		<td class="field_name"><?php echo $form['name']->renderLabel() ?><input type="hidden" id="user_name" /></td>
		<td class="small"><strong><?php echo $form['name']->getValue(); ?></strong></td>
	</tr>
	<tr>
		<td class="field_name"><?php echo $form['email']->renderLabel() ?></td>
		<td><?php echo $form['email'] ?>
			<?php if ($error_email==1): ?>
				<div class="error_list for_email"><?php echo __('Invalid Email') ?></div>
			<?php endif ?>
		</td>
	</tr>
	<tr>
		<td class="field_name"><?php echo $form['profile']->renderLabel() ?></td>
		<td><?php echo $form['profile'] ?>
			<br/><span class="small light"><?php echo __('Example') ?>: http://www.myspace.com/profile</span>
            <?php if ($form['profile']->getError()): ?>
            <div class="error_list for_profile"></div>
            <?php endif ?>
		</td>
	</tr>
<?php/*
	<tr>
		<td class="field_name"><?php echo $form['timezone_id']->renderLabel() ?></td>
		<td><?php echo $form['timezone_id'] ?><br/></td>
	</tr>
	<tr>
		<td class="field_name"><?php echo __('Language') ?></td>
		<td><?php echo $form['lang'] ?></td>
	</tr>

</table>
<h2>
	<?php echo __('Change password') ?>
</h2>
<p class="small p1_no_both light">
	<?php echo __('Leave these fields blank to keep current password') ?>
</p>
<table class="signup" cellspacing="0" cellpadding="0" border="0">
    */?>
	<tr>
		<td class="field_name"><?php echo $form['password']->renderLabel() ?></td>
		<td><?php echo $form['password'] ?><br/></td>
	</tr>
	<tr>
		<td class="field_name"><?php echo __('Confirm Password') ?></td>
		<td><input type="password" id="user_retype_password" value="" name="retype_password"/>
			<?php if ($error_retype_password==1): ?>
				<div class="error_list for_password"><?php echo __('Passwords do not match') ?></div>
			<?php endif ?>
		</td>
	</tr>
	<tr>
		<td class="field_name">&nbsp;</td>
		<td><span class="small light"><?php echo __('Leave these fields blank to keep current password') ?></span></td>
	</tr>    
	<tr>
		<td class="field_name"><?php echo __('Subscribe to') ?></td>
		<td class="checkbox_container">
			<?php echo $form['subscribe_news'] ?> <?php echo __('News') ?>&nbsp;&nbsp;&nbsp;
			<?php echo $form['subscribe_photo'] ?> <?php echo __('Photo') ?>&nbsp;&nbsp;&nbsp;
			<?php echo $form['subscribe_video'] ?> <?php echo __('Video') ?>
		</td>
	</tr>    
    <tr>
		<td class="field_name">&nbsp;</td>
		<td><input type="submit" value="<?php echo __('Save') ?>" name="submit_save" class="input_submit"/></td>
	</tr>
</table>
</form>

<h2><?php echo __('Delete account') ?></h2>
<form action="" method="post" id="delete_form" onsubmit="return deleteSubmit()">
    <input type="submit" value="<?php echo __('Delete') ?>" name="submit_delete" class="input_submit"/>
</form>

<?php if (count($subscription_news) || count($subscription_photo) || count($subscription_video) || count($subscription_idea) ): ?>
<script type="text/javascript"> 
	function showSubscriptions() 
	{
		if ( $("#subscriptions").is(":hidden") ) {
			$("#subscriptions").slideDown("slow");
		} else {
			$("#subscriptions").slideUp("slow");
		}
	}
</script>

<h2>
	<?php echo __('Manage Subscriptions') ?>
</h2>
<div id="subscriptions" style="display:none;">
	<?php if (count($subscription_news)): ?>
		<h4><?php echo __('News') ?></h4>
		<?php foreach ($subscription_news as $subscribe): ?>
			<a href="<?php echo $subscribe->getItemUrl(); ?>" target="_blank"><?php echo $subscribe->getItemTitle(); ?></a><br/>
		<?php endforeach ?>
	<?php endif ?>

	<?php if (count($subscription_photo)): ?>
		<h4><?php echo __('Photo') ?></h4>
		<?php foreach ($subscription_photo as $subscribe): ?>
			<a href="<?php echo $subscribe->getItemUrl(); ?>" target="_blank"><?php echo $subscribe->getItemTitle(); ?></a><br/>
		<?php endforeach ?>
	<?php endif ?>

	<?php if (count($subscription_video)): ?>
		<h4><?php echo __('Video') ?></h4>
		<?php foreach ($subscription_video as $subscribe): ?>
			<a href="<?php echo $subscribe->getItemUrl(); ?>" target="_blank"><?php echo $subscribe->getItemTitle(); ?></a><br/>
		<?php endforeach ?>
	<?php endif ?>

	<?php if (count($subscription_idea)): ?>
		<h4><?php echo __('Ideas') ?></h4>
		<?php foreach ($subscription_idea as $subscribe): ?>
			<?php if ($subscribe->getItemTitle()): ?>
				<a href="<?php echo $subscribe->getItemUrl(); ?>" target="_blank"><?php echo $subscribe->getItemTitle(); ?></a><br/>
			<? endif ?>
		<?php endforeach ?>
	<?php endif ?>
	<br/>
</div>
<p class="no_decor">
» <a href="javascript:showSubscriptions();"><?php echo __('show/hide subscriptions') ?></a>
</p>
<?php endif ?>
