<?php if (!empty($audio)): ?>
<?php 
// если Заголовок или Автор не указан на текущем языке берём из языка по умолчанию
$title  = $audio->getTitle($sf_user->getCulture(), true);
$author = $audio->getAuthor($sf_user->getCulture(), true);
?>
<div id="audio_<?php echo $audio->getId(); ?>" class="audio_item">
<a href="<?php echo $audio->getUrl(); ?>"><?php echo $author; ?> - <?php echo $title; ?></a>
<br />
</div>
<?php endif ?>