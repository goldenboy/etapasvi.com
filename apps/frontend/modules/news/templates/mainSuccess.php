<?php slot('body_id') ?>body_main<?php end_slot() ?>

<h1><?php echo __('A message') ?><br/><?php echo __('of peace to our world today') ?></h1>


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

<h2><?php echo __('Subscribe to News') ?></h2>
<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $sf_user->getCulture(); ?>/etapasvi', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
<a href="http://feeds.feedburner.com/<?php echo $sf_user->getCulture(); ?>/etapasvi" class="right"><img src="http://feeds.feedburner.com/~fc/<?php echo $sf_user->getCulture(); ?>/etapasvi?bg=d4d0c8&amp;fg=444444&amp;anim=0" height="26" width="88" alt="RSS" /></a>
E-mail: <input type="text" style="width:140px" name="email"/> &nbsp;<input type="hidden" value="<?php echo $sf_user->getCulture(); ?>/etapasvi" name="uri"/><input type="hidden" name="loc" value="<?php echo UserPeer::getCultureFeedburderLoc(); ?>"/><input type="submit" class="input_button" value="<?php echo __('Subscribe') ?>" />

</form>
<br/>
<hr class="dashed"/>
<h2><?php echo __('Comments') ?></h2>
<?php include_component('comments', 'show') ?>

<?php include_partial('comments/count'); ?>