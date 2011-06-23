<?php if (count($photo_list)): ?>
<div class="photo_list">
    <?php foreach ($photo_list as $photo): ?>
        <div>
            <?php include_partial('photo/show', array('photo'=>$photo, 'short'=>true) ); ?>
        </div>        
    <?php endforeach; ?>
</div>
<?php endif ?>