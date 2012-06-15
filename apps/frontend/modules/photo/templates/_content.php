<div id="photo_content">
<?php
if (!empty($photo)) {
    $comments_page_url = $photo->getUrl();
} else {
    $comments_page_url = '';
}
?>

<?php include_component('photo', 'showwrapper', array('id'=>$id, 'title'=>$title, 'photo'=>$photo, 'no_check_title'=>$no_check_title, 'next_photo'=>$next_photo, 'prev_photo'=>$prev_photo, 'item2item_html'=>$item2item_html)); ?>
<?php /* include_partial('comments/tools', array('empty'=>true));*/ ?>

<?php 
// http://tasks.etapasvi.com/issues/389#note-6
// http://www.electrictoolbox.com/running-javascript-functions-after-disqus-loaded/
?>
<script type="text/javascript">
    preparePhotoContent();
    <?php /*
    // изменение размера всплывающего окна после загрузки комментариев
    function disqus_config() {
    alert(1):
        this.callbacks.afterRender = [function() {
        alert(2):
            if (page_mode == "enlarge_photo") {
                cbResize();
            }
        }];
    }
    */ ?>
</script>
<div id="photo_comments">
<br/>
<a href="#" onclick="showPhotoComments(this)"><?php echo __('Comments') ?></a>: <a href="#disqus_thread" onclick="showPhotoComments(this)" data-disqus-identifier="<?php echo CommentsPeer::getCommentsIdentifier('', '', '', array('id'=>$photo->getId())); ?>" class="no_decor">0</a>
<?php include_partial('comments/count'); ?>
<div id="photo_comments_code" style="display:none"><?php echo base64_encode( get_component('comments', 'show', array('for'=>strtolower(ItemtypesPeer::ITEM_TYPE_NAME_PHOTO), 'id'=>$photo->getId(), 'culture'=>$sf_user->getCulture(), 'comments_page_url'=>$comments_page_url)) ); ?></div>
</div>
</div>