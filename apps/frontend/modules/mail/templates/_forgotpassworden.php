<?php
$link = url_for('user/newpassword?remind_code=' . $remind_code );
?>

<p>Hello.</p>
 
<p>You are receiving this notification because you have (or someone pretending to be you has) requested a new password be sent for your account on <a href="http://www.etapasvi.com">www.eTapasvi.com</a>. If you did not request this notification then please ignore it, if you keep receiving it please contact the site administrator.</p>

<p>
	To get new password click the link provided below:<br/>
	<a href="<?php echo $link; ?>">
		<?php echo $link; ?>
	</a>
</p>

<?php include_partial('mail/footeren'); ?>