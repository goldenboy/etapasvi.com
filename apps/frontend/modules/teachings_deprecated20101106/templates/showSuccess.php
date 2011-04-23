<?php slot('body_id') ?>body_teachings<?php end_slot() ?>

<h1 id="up"><?php echo __('Teachings') ?></h1>

<ul class="in_text">
<?php foreach($teachings as $teaching): ?>	
	<li>
		<?php echo format_datetime( $teaching['date'], 'd MMMM yyyy'); ?> (<a href="<?php echo url_for('news/show?id=' . $teaching['news_id']); ?>"><?php echo __("Text") ?></a><?php if (count($teaching['video'])): ?>, 		
			<?php foreach ($teaching['video'] as $video_index=>$video_id): ?><a href="<?php echo url_for('video/show?id=' . $video_id); ?>"><?php echo __("Video") ?><?php if (count($teaching['video']) > 1):?><?php echo ($video_index+1); ?><?php endif ?></a><?php if (isset($teaching['video'][$video_index+1])):?>, <?php endif ?><?php endforeach ?><?php endif ?>)
	</li>	
<?php endforeach ?>	
</ul>
<?php /* 
<ul class="in_text">
	<li>
		<?php echo format_datetime( '2009-10-30', 'd MMMM yyyy'); ?> (<a href="<?php echo url_for('news/show?id=41'); ?>"><?php echo __("Text") ?></a> / <a href="<?php echo url_for('video/show?id=41'); ?>"><?php echo __("Video") ?></a>)
	</li>	
	<li>
		<?php echo format_datetime( '2008-11-22', 'd MMMM yyyy'); ?> (<a href="<?php echo url_for('news/show?id=46'); ?>"><?php echo __("Text") ?></a> / <a href="<?php echo url_for('video/show?id=38'); ?>"><?php echo __("Video") ?></a>)
	</li>		
	<li>
		<?php echo format_datetime( '2008-11-10', 'd MMMM yyyy'); ?> (<a href="<?php echo url_for('news/show?id=43'); ?>"><?php echo __("Text") ?></a> / <a href="<?php echo url_for('video/show?id=37'); ?>"><?php echo __("Video") ?></a>)
	</li>		
	<li>
		<?php echo format_datetime( '2007-10-19', 'd MMMM yyyy'); ?> (<a href="<?php echo url_for('news/show?id=45'); ?>"><?php echo __("Text") ?></a> / <a href="<?php echo url_for('video/show?id=23'); ?>"><?php echo __("Video") ?></a>)
	</li>	
	<li>
		<?php echo format_datetime( '2007-08-02', 'd MMMM yyyy'); ?> (<a href="<?php echo url_for('news/show?id=29'); ?>"><?php echo __("Text") ?></a> / <a href="<?php echo url_for('video/show?id=22'); ?>"><?php echo __("Video") ?></a>)
	</li>
</ul>
*/ ?>
<br/>
<a href="/uploads/all/palden_dorje_dictionary.pdf"><img src="/images/ico_pdf.gif" /></a>
<a href="/uploads/all/palden_dorje_dictionary.pdf"><?php echo __("Palden Dorje Dictionary") ?></a> (<?php echo __("by Andy Good/LTJ") ?>)