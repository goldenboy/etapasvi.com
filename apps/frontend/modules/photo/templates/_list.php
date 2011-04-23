<?php if (count($photo_list)): ?>
<table class="photo_list">
    <?php $i = 1; ?>
    <?php foreach ($photo_list as $photo): ?>
        <?php if ($i == 1): ?>
            <tr>
        <?php endif ?>
        <td><?php include_partial('photo/show', array('photo'=>$photo, 'short'=>true) ); ?></td>
        <?php if ($i == 3): ?>
            </tr>
        <?php endif ?>
        <?php if ($i < 3): ?>
            <?php $i++; ?>			
        <?php else: ?>
            <?php $i = 1; ?>
        <?php endif ?>
    <?php endforeach; ?>
</table>
<?php endif ?>