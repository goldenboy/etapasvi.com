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
<strong id="<?php echo $audio->getFile(); ?>"><?php echo $author; ?></strong> - 
<?php if (!empty($body)): ?>
    <a href="javascript:showAudioBody('<?php echo $audio->getId(); ?>')"><?php echo $title; ?></a>
<?php else: ?>
    <?php echo $title; ?>
<?php endif ?>
<a href="#<?php echo $audio->getFile(); ?>" class="right">#</a>
<br />


<?php /*
<span>http://www.etapasvi.com/uploads/audio/<?php echo $audio->getFile(); ?></span> 
*/ ?>
<div class="light small right audio_descr">
<?php if (empty($no_info) || !$no_info): ?>
    <?php echo __('Duration') ?>: <?php echo $audio->getDurationFormatted(); ?> | 
    <?php echo __('Size') ?>: <?php echo $audio->getSize(); ?> Mb
    <?php /*echo __('Date') ?>: <?php echo format_datetime( $audio->getCreatedAt(), 'd MMMM yyyy');*/ ?> 

    <a href="<?php /*http://www.etapasvi.com/uploads/audio/<?php echo $audio->getFile(); ?>" title="<?php echo __('Download') ?>*/?><?php echo $audio->getDownloadUrl(); ?>" target="_blank" class="save"></a>
<?php endif ?>

</div>

<object type="application/x-shockwave-flash" data="http://kiwi6.com/swf/player.swf" class="audioplayer" height="22" width="290" allowscriptaccess="always">
<param name="movie" value="http://kiwi6.com/swf/player.swf" /><param name="FlashVars" value="playerID=audioplayer&amp;soundFile=<?php echo $audio->getDirectUrl(); ?>" />
<param name="quality" value="high" /><param name="menu" value="false" /><param name="allowscriptaccess" value="always" /><param name="wmode" value="transparent" /></object>

</div> 

<p id="elAudioBody<?php echo $audio->getId(); ?>" class="hidden">
    <?php echo html_entity_decode($body); ?>
</p>
<?php endif ?>