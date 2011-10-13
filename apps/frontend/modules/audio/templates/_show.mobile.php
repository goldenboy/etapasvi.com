<?php if (!empty($audio)): ?>
<?php 
// если Заголовок или Автор не указан на текущем языке берём из языка по умолчанию
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
        <?php echo format_datetime( $audio->getCreatedAt(), 'd MMMM yyyy'); ?> | 
        <?php /*echo __('Duration') ?>: */ ?><?php echo $audio->getDurationFormatted(); ?> | 
        <?php /*echo __('Size') ?>: */ ?><?php echo $audio->getSize(); ?> Mb | 
        <?php /*echo __('Date') ?>: / ?><?php echo format_datetime( $audio->getCreatedAt(), 'd MMMM yyyy'); ?>         */ ?>
    <?php endif ?>
    <a href="<?php echo $audio->getDirectUrl(); ?>" title="<?php echo __('Download'); ?>"><?php echo __('Download'); ?></a>

    <?php if (!empty($body)): ?>
    <br/><br/><strong><?php echo __('Text'); ?>:</strong><br/>
    <?php echo html_entity_decode($body); ?>
    <?php endif ?>

    </div>    
</div>
<?php include_component('item2item', 'show', array('item_type'=>ItemtypesPeer::ITEM_TYPE_AUDIO, 'item_id'=>$audio->getId())) ?> 
<?php endif ?>