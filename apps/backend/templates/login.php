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
	  <div id="title">
	    <h1><?php echo link_to('eTapasvi', '@homepage') ?></h1>
	  </div>
	 
	  <div id="content" style="clear:right">
	    <?php echo $sf_data->getRaw('sf_content') ?>
	  </div>
	</div>
</body>
</html>
