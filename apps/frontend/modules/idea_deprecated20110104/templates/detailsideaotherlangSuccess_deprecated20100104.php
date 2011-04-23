<?php use_helper('Date') ?>
<?php slot('body_id') ?>body_idea<?php end_slot() ?>
<h1><?php echo __('Idea') ?></h1>

<h2>
	<?php echo __('Idea of') ?>: <?php echo $idea->getUser(); ?>
</h2>

<p>
	<?php echo $user_name; ?> <?php echo __('have an Idea in another language') ?>. 
</p>
<p>
	<?php echo __('Switch to another language or') ?> 
	<a href="<?php if ($sf_user->getCulture() == 'en'): echo url_for('/ru/idea/details/id/'.$idea->getId()); else: echo url_for('/en/idea/details/id/'.$idea->getId()); endif ?>">
	<?php echo __('click here') ?></a> <?php echo __('to view an Idea') ?>.
</p>