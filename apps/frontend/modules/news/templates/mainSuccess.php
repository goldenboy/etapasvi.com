<?php slot('body_id') ?>body_main<?php end_slot() ?>

<h1><?php echo __('A message') ?><br/><?php echo __('of Peace to our World today') ?></h1>


<?php include_component('news', 'latest'); ?>
<p class="p1_no_top no_decor right">
	<a href="<?php echo url_for('news_index'); ?>" class="no_decor"><?php echo __('News') ?> »</a>
</p>

<h2><?php echo __('Latest Photos') ?></h2>
<?php include_component('photo', 'latest'); ?>
<p class="p1_no_top no_decor right">
	<a href="<?php echo url_for('photo_albums'); ?>" class="no_decor"><?php echo __('Photo') ?> »</a>
</p>

<h2><?php echo __('Latest Video') ?></h2>
<?php include_component('video', 'latest'); ?>
<p class="p1_no_top no_decor right">
	<a href="<?php echo url_for('video_index'); ?>" class="no_decor"><?php echo __('Video') ?> »</a>
</p>

<h2><?php echo __('Latest Audio') ?></h2>
<?php include_component('audio', 'latest'); ?>
<p class="p1_no_top no_decor right">
	<a href="<?php echo url_for('audio_index'); ?>" class="no_decor"><?php echo __('Audio') ?> »</a>
</p>
<?php $mail_id = UserPeer::getCultureMailId(); ?>
<?php if ($mail_id): ?>
    <br/>
    <h2><?php echo __('Subscribe to News') ?></h2>
<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $sf_user->getCulture(); ?>/etapasvi', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
E-mail: <input type="text" style="width:140px" name="email"/> &nbsp;<input type="hidden" value="<?php echo $sf_user->getCulture(); ?>/etapasvi" name="uri"/><input type="hidden" name="loc" value="<?php echo UserPeer::getCultureFeedburderLoc(); ?>"/><input type="submit" value="<?php echo __('Subscribe') ?>" />
</form>
<?php
/*
MailChimp
<form action="http://eTapasvi.us2.list-manage.com/subscribe/post?u=539bfb860e4e419b7875ea8cb&amp;id=<?php echo $mail_id; ?>" method="post" name="mc-embedded-subscribe-form" target="_blank">
<label for="mce-EMAIL">E-mail: </label> <input type="text" value="" name="EMAIL" /> 
<input type="submit" value="<?php echo __('Subscribe') ?>" name="subscribe" class="input_submit" />
&nbsp;<?php echo __('or') ?>&nbsp;
<a href="http://eTapasvi.us2.list-manage.com/unsubscribe?u=539bfb860e4e419b7875ea8cb&amp;id=<?php echo $mail_id; ?>" target="_blank" ><?php echo __('Unsubscribe') ?></a>
</form>
*/
?>

<?php include_partial('comments/count'); ?>

<?php endif ?>