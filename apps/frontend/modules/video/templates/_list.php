<?php if ( !empty($video_list) ): ?>
	<table class="video_list">
		<?php $i = 1; ?>
		<?php foreach ($video_list as $video): ?>
			<?php if ($i == 1): ?>
				<tr>
			<?php endif ?>
			<td><?php include_partial('video/show', array('video'=>$video, 'short'=>true) ); ?></td>
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
<?php endif; ?>