<?php slot('body_id') ?>body_blessing<?php end_slot() ?>

<h1><?php echo __('Blessing') ?></h1>

<p class="center_text">
<?/*<img src="/uploads/photo/preview/65652a2ac8a37a4a05d7606e50043f42.jpg" />*/?>
<?php include_component('photo', 'preview', array('id'=>69)); ?>
</p>
<?php /*
<p>
<?php echo __('Though Dharma Sangha is extremely busy with his meditation approaching its final phase, Dharma Sangha is truly happy to bless everyone and has requested that we group together as much as possible to receive blessings in the most efficient manner.') ?>
</p>
*/ ?>
<p>
<?php echo __('You can send your photos, names and messages to') ?> <a href="mailto:<?php echo MailPeer::MAIL_ADDRESS ?>"><?php echo MailPeer::MAIL_ADDRESS ?></a> <?php echo __('with subject "For blessing", Dharma Sangha will see all received requests and bless them.') ?>
</p>

<br/>
<?php include_component('comments', 'show'); ?>	