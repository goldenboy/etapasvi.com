    <h2>
      <?php echo $title; ?>
    </h2>

    <?php foreach($images as $image): ?>
      <img src="<?php echo htmlentities($image->getSmallThumb()); ?>" alt="" />
      <img src="<?php echo $content; ?>" alt="" />
    <?php endforeach; ?>