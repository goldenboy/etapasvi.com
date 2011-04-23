<?php slot('body_id') ?>body_contactus<?php end_slot() ?>

<h1><?php echo __('Contact Us') ?></h1>

<?php /*include_component('text', 'show', array('id'=>3)); */?>

<p>
    <strong><?php echo __('E-mail') ?>:</strong> <a href="mailto:<?php echo MailPeer::MAIL_ADDRESS ?>"><?php echo MailPeer::MAIL_ADDRESS ?></a>
</p>
<p>
    <strong><?php echo __('Official website') ?>:</strong> <a href="http://www.dharmasangha.org.np">www.dharmasangha.org.np</a>
</p>
<p>
    <strong><?php echo __('News and Teachings') ?>:</strong> <a href="http://paldendorje.com">www.paldendorje.com</a>
</p>

<br/>
<?php include_component('comments', 'show'); ?>	