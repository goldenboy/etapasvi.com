<?php use_helper('Date') ?>
<?php slot('body_id') ?>body_idea<?php end_slot() ?>
<h1><?php echo __('Idea of the Week') ?></h1>
<h2><?php echo __('My') ?></h2>

<p>
	<?php echo __('You have an Idea in another language') ?>. 
</p>
<p>
	<?php echo __('Switch to another language or') ?> 
	<a href="<?php echo url_for('/' . $other_lang . '/idea/show'); ?>">
	<?php echo __('click here') ?></a> <?php echo __('to view an Idea') ?>.
</p>