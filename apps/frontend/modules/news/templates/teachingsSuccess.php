<?php slot('body_id') ?>body_teachings<?php end_slot() ?>

<h1 style="margin-bottom:32px;"><?php echo __('Teachings') ?></h1>

<?php 
$navigation = get_partial('global/navigation', array('pager'=>$pager, 'module_action'=>'teachings/index') ); 
echo $navigation;

$news_list = $pager->getResults();
?>

<?php if (count($news_list )): ?>
    <?php include_partial('news/list', array('news_list'=>$news_list)); ?>
<?php endif ?>

<?php echo $navigation; ?>

<br/>
<a href="/uploads/all/dharma_sangha_dictionary.pdf" class="files pdf"><?php echo __("Dictionary") ?></a> (<?php echo __("by Andy Good/LTJ") ?>)

<?php include_partial('comments/count'); ?>