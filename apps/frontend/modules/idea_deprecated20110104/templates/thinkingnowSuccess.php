<?php slot('body_id') ?>body_idea<?php end_slot() ?>
<h1><?php echo __('Idea of the Week') ?></h1>

<h2><?php echo __('My') ?></h2>
<p>
	<?php echo __("You can't create new Idea now. Please think about") ?> <a href="<?php echo url_for('@best_idea'); ?>"><?php echo __('this') ?></a> <?php echo __('Idea for a few minutes') ?>.
</p>