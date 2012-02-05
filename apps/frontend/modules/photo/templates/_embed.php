<?php if ($photo): ?>		
    <div class="box center_text">
        <?php if ($photo->getImg()): ?>		
            <img src="<?php echo $photo->getPreviewUrl(); ?>" alt="<?php echo $photo->getTitle(); ?>" />
        <?php endif ?>
        <?php 
        // ���� ���� ��������� �� ����� ������������, �������, ���
        // ���� ���� ��������� �� ����������, ������� ���   
        $title = $photo->getTitle($sf_user->getCulture(), true);    
        ?>
        <?php if ($title): ?>
            <br/><strong><?php echo $title; ?></strong>  
        <?php endif ?>
        <?php if ($photo->getBody($sf_user->getCulture(), true)): ?>
            <br/>
            <?php echo html_entity_decode($photo->getBodyPrepared()); ?><br/>
        <?php endif ?>       
    </div>
<?php endif ?>