<?php if (!empty($photo) && $photo->getImg()): ?>		
	<img src="<?php echo $photo->getPreview(); ?>" alt="<?php echo $photo->getTitle(); ?>" />
<?php endif ?>