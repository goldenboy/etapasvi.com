<?php if ( (!empty($news_list) && count($news_list)) || 
            (!empty($photoalbum_list) && count($photoalbum_list)) || 
            (!empty($video_list) && count($video_list)) ||
            (!empty($audio_list) && count($audio_list))): ?>
<br/>
<hr class="light" />
<?php endif ?>
<?php if (!empty($news_list) && count($news_list)): ?>
    <p>
        <strong><?php echo __('News'); ?>:</strong>
        <br/>
    <?php foreach($news_list as $news_index=>$news_item): ?>
        <a href="<?php echo url_for($news_item->getTypeName() . '/show?id=' . $news_item->getId()); ?>"><?php echo $news_item->getTitle(); ?></a><br/>
    <?php endforeach ?>				
    </p>
<?php endif ?>

<?php if (!empty($photoalbum_list) && count($photoalbum_list)): ?>	
    <p class="p1_no_bottom">
        <strong><?php echo __('Photo'); ?>:</strong>
    </p>
    <div class="related">
    <?php foreach($photoalbum_list as $photoalbum_index=>$photoalbum_item): ?>
        <div>
            <?php include_partial('photoalbum/show', array('photoalbum'=>$photoalbum_item) ); ?>
        </div>
    <?php endforeach ?>				
    </div>
<?php endif ?>                   

<?php if (!empty($video_list) && count($video_list)): ?>	
    <p class="p1_no_bottom">
        <strong><?php echo __('Video'); ?>:</strong>
    </p>
    <div class="related video_list">
    <?php foreach($video_list as $video_index=>$video_item): ?>
        <div>
            <a href="<?php echo url_for('video/show?id=' . $video_item->getId()); ?>"><?php /*echo __('Video'); ?><?php if (count($video_list) > 1): ?> <?php echo ($video_index + 1); ?><?php endif */?><img src="<?php echo $video_item->getImg(); ?>" /></a>
            <?php if ( $video_item->getTitle() ): ?>
            <p class="p1_no_top">
                <a href="<?php echo url_for('video/show?id=' . $video_item->getId()); ?>" title="<?php echo $video_item->getTitle(); ?>">
                    <?php echo $video_item->getTitlePrepared(); ?>...
                </a>
            </p>
            <?php endif ?>
        </div>
    <?php endforeach ?>				
    </div>
<?php endif ?>

<?php if (!empty($audio_list) && count($audio_list)): ?>
    <p>
        <strong><?php echo __('Audio'); ?>:</strong>
     </p>
    <div>
    <?php foreach($audio_list as $audio_list=>$audio_item): ?>
        <div>
            <?php include_partial('audio/show', array('audio'=>$audio_item) ); ?>
            <hr class="dashed audio_divider"/>
        </div>
    <?php endforeach ?>				
    </div>
<?php endif ?>