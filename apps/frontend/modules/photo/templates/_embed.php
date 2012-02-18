<?php if ($photo): ?>		
    <div class="box center_text">
        <?php if ($photo->getImg()): ?>		
            <a href="<?php echo $photo->getUrl(); ?>"><img src="<?php echo $photo->getPreviewUrl(); ?>" alt="<?php echo $photo->getTitle(); ?>" /></a>
        <?php endif ?>
        <?php 
        // ���� ���� ��������� �� ����� ������������, �������, ���
        // ���� ���� ��������� �� ����������, ������� ���   
        $title = $photo->getTitle($sf_user->getCulture(), true);    
        ?>
        <?php if (!$no_title && $title): ?>
            <br/><strong><?php echo $title; ?></strong>  
        <?php endif ?>
        <?php if ($photo->getBody($sf_user->getCulture(), true)): ?>
            <br/>
            <?php echo html_entity_decode($photo->getBodyPrepared()); ?><br/>
        <?php endif ?>       
    </div>
<?php endif ?>