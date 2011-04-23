<?php if (count($news_list)): ?>
	<table class="news_list">
		<?php foreach ($news_list as $newsitem): ?>
			<tr>
				<td><?php include_partial('news/showShort', array('newsitem'=>$newsitem) ); ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
<?php endif ?>