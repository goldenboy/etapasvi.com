<?php if (!empty($photo) && $photo->getImg()): ?>		
	<img src="<?php echo $photo->getPreviewUrl(); ?>" alt="<?php echo $photo->getTitle(); ?>" />
<?php endif ?>