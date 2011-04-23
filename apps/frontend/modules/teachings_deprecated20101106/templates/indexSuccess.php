<?php slot('body_id') ?>body_teachings<?php end_slot() ?>

<h1 style="margin-bottom:32px;"><?php echo __('Teachings') ?></h1>

<?php 
$navigation = get_partial('global/navigation', array('pager'=>$pager, 'module_action'=>'teachings/index') ); 
echo $navigation;
?>

<?php if (count($pager->getResults())): ?>
	<table class="news_list">
		<?php foreach ($pager->getResults() as $newsitem): ?>
			<tr>
				<td><?php include_partial('news/showShort', array('newsitem'=>$newsitem) ); ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
<?php endif ?>

<?php echo $navigation; ?>

<br/>
<a href="/uploads/all/dharma_sangha_dictionary.pdf" class="files pdf"><?php echo __("Dictionary") ?></a> (<?php echo __("by Andy Good/LTJ") ?>)