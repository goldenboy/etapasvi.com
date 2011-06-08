<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
  </head>
  <body>
	<div id="container" style="margin:0 auto;padding:10px">
	  <div id="navigation" style="display:inline;float:right">
        Language: <?php echo sfContext::getInstance()->getUser()->getCulture(); ?>
	    <ul style="list-style-type:none;">
		  <?php /*<li><?php echo link_to('Users', 'user/index') ?></li>*/ ?>
	      <?php /* <li><?php echo link_to('Ideas', 'idea/index') ?></li>	*/ ?>
          <?php /*<li><?php echo link_to('Comments', 'comments/index') ?></li>*/ ?>
		  <?php /*<li><?php echo link_to('Idea Votes', 'ideavote/index') ?></li>*/ ?>
	      <?php /*<li><?php echo link_to('Idea Abuse', 'ideaabuse/index') ?></li>*/ ?>
	      
	      <?php /*<li><?php echo link_to('Idea Comments', 'idea2comments/index') ?></li>*/ ?>	
	      <?php /*<li><?php echo link_to('News Comments', 'news2comments/index') ?></li>*/ ?>
	      <?php /*<li><?php echo link_to('Photo Comments', 'photo2comments/index') ?></li>*/ ?>
	      <?php /*<li><?php echo link_to('Video Comments', 'video2comments/index') ?></li>*/ ?>
		  <?php /*<li><?php echo link_to('Best Ideas', 'bestidea/index') ?></li>*/ ?>
	
	      <li><?php echo link_to('News', 'news/index') ?></li>	      
	      <li><?php echo link_to('Photo', 'photo/index?filters%5Bphotoalbum_id%5D=1&filters%5Bshow%5D=&filters%5Bimg%5D=&filter=filter') ?></li>
	      <li><?php echo link_to('Photo Albums', 'photoalbum/index') ?></li>
	      <li><?php echo link_to('Video', 'video/index') ?></li>
	      <li><?php echo link_to('Item2item', 'item2item/index') ?></li>	      
	      <?php /*<li><?php echo link_to('Timezones', 'timezone/index') ?></li>	*/ ?>
	      <li><?php echo link_to('Quote', 'quote/index') ?></li>	
	      <li><?php echo link_to('Audio', 'audio/index') ?></li>
	      <?php /*<li><?php echo link_to('Mail', 'mail/index') ?></li>*/ ?>
	      <li><?php echo link_to('Upload', 'upload/index') ?></li>	
	       <?php /*<li><?php echo link_to('Subscribe', 'subscribe/index') ?></li>	*/ ?>
	      <?php /*<li><?php echo link_to('Alert', 'alert/index') ?></li>	*/ ?>
	      <?php /*<li><?php echo link_to('Spam', 'alert/spam') ?></li>	*/ ?>
	      <li><?php echo link_to('News Types', 'newstypes/index') ?></li>	
	      <li><?php echo link_to('Item Types', 'itemtypes/index') ?></li>	
	      <li><?php echo link_to('Cache', 'news/cache') ?></li>	

	      <li><hr style="margin: 15px 0 10px"/></li>
		  <?php /*<li><?php echo link_to('Cache', 'cache/index') ?></li>*/ ?>
		  <?php if ($sf_user->getUsername() == 'admin') : ?>
	      <li><?php echo link_to('Users', 'sfGuardUser/index') ?></li>
          <?php endif ?>
	      <li><?php echo link_to('Logout', '@sf_guard_signout') ?></li>
	    </ul>
	  </div>
	  <div id="title">
	    <h1><?php echo link_to('eTapasvi', '@homepage') ?></h1>
	  </div>
	 
	  <div id="content" style="clear:right">
	    <?php echo $sf_data->getRaw('sf_content') ?>
	  </div>
	</div>
</body>
</html>
