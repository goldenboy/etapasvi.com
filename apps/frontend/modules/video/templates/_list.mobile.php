<?php if ( !empty($video_list) ): ?>
	<div class="video_list">
		<?php foreach ($video_list as $video): ?>
            <div><?php include_partial('video/show', array('video'=>$video, 'short'=>true) ); ?></div>
		<?php endforeach; ?>
	</div>
<?php endif; ?>