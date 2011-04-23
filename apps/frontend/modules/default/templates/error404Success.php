<?php slot('body_id') ?>body_404<?php end_slot() ?>
<h1><?php echo __('Page Not Found or Not Translated') ?></h1>

<dl>
	<dt><?php echo __("Page Not Transalated") ?></dt>
    <dd><?php echo __("If you can translate this page into your language please email us at") ?> <a href="mailto:<?php echo MailPeer::MAIL_ADDRESS ?>"><?php echo MailPeer::MAIL_ADDRESS ?></a></dd>

	<dt><?php echo __("Page Not Found") ?></dt>
    <dd><?php echo __("You may have typed the address (URL) incorrectly. Check it to make sure you've got the exact right spelling, capitalization or switch to another lamguage") ?>.</dd>
</dl>