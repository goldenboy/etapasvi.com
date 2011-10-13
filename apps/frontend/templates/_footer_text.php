<?php if ($sf_user->getCulture() != 'en'): ?>
    <?php echo __('This page is translation of corresponding English page, switch into English language to see original text.') ?><br/><br/>
<?php endif ?>
<?php echo __('Website is developed and supported on a voluntary basis.') ?><br/><?php echo __('If you can help in any way – email at') ?> <a href="mailto:<?php echo MailPeer::MAIL_ADDRESS ?>"><?php echo MailPeer::MAIL_ADDRESS ?></a>
<br/><br/><?php echo __('Copyright') ?> &copy; 2009-<?php echo date("Y"); ?>, www.eTapasvi.com
<br/><?php echo __('All Rights Reserved') ?>.