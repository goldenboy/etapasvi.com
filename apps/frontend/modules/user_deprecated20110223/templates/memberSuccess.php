<?php slot('body_id') ?>body_member<?php end_slot() ?>

<h1><?php echo __('Member') ?></h1>
<div class="cyrcle center">
    <div style="height:145px;"></div>
    <?php echo __('Hello') ?>, <strong><a href="<?php echo url_for('@user_profile', true); ?>" title="<?php echo __('Profile') ?>" ><?php echo UserPeer::authUserName(); ?>!</a></strong>
    <br/><br/>
    <a href="#" title="<?php echo __('Logout') ?>" class="logout"><?php echo __('Logout') ?></a>
</div>

<script type="text/javascript">	
	$(document).ready(function(){
		$(".logout").click( function logout() {
				if (confirm('<?php echo __('Are you sure?') ?>')) { 
					document.location.href = '<?php echo url_for('@user_logout', true); ?>';
				}
			}
		);
	});
</script>