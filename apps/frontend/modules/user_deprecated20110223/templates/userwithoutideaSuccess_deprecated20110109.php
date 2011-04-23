<?php slot('body_id') ?>body_user<?php end_slot() ?>
<h1><?php echo __('Member') ?></h1>
<h2>~ <?php echo __('User') ?> ~</h2>

<p class="p1 error_list center_text">
	<?php echo __('User') ?> <?php echo $user->getName(); ?> <?php echo __('have no Idea') ?>.
</p>
<p class="back">
	<a href="javascript:window.history.back();" ><?php echo __('Back') ?></a>
</p>