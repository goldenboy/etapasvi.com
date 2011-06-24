<?php if (!empty($audio)): ?>
<?php 
// ���� ��������� ��� ����� �� ������ �� ������� ����� ���� �� ����� �� ���������
$title  = $audio->getTitle($sf_user->getCulture(), true);
$body   = $audio->getBodyPrepared($sf_user->getCulture(), true);
$author = $audio->getAuthor($sf_user->getCulture(), true);

/* 
<script type="text/javascript">	
    $(document).ready(function(){
        $("#audio_<?php echo $audio->getId(); ?>").jmp3({
            width: 22
        });
    });
</script>
 */ ?>
<div id="audio_<?php echo $audio->getId(); ?>" class="audio_item">
    <strong id="<?php echo $audio->getFile(); ?>"><?php echo $author; ?></strong> - <?php echo $title; ?>     
    <div class="light small right audio_descr">
    <?php if (empty($no_info) || !$no_info): ?>    
        <?php /*echo __('Duration') ?>: */ ?><?php echo $audio->getDurationFormatted(); ?> | 
        <?php /*echo __('Size') ?>: */ ?><?php echo $audio->getSize(); ?> Mb | 
        <?php /*echo __('Date') ?>: / ?><?php echo format_datetime( $audio->getCreatedAt(), 'd MMMM yyyy'); ?>         */ ?>
    <?php endif ?>
    <a href="<?php echo $audio->getDirectUrl(); ?>" title="<?php echo __('Download'); ?>"><?php echo __('Download'); ?></a>    
    </div>
</div>
<?php endif ?>