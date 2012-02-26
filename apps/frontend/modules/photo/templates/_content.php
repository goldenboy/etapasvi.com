<div id="photo_content">
<?php
if (!empty($photo)) {
    $comments_page_url = $photo->getUrl();
} else {
    $comments_page_url = '';
}
?>

<?php include_component('photo', 'showwrapper', array('id'=>$id, 'title'=>$title, 'photo'=>$photo)); ?>
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
<?php include_component('comments', 'show', array('for'=>strtolower(ItemtypesPeer::ITEM_TYPE_NAME_PHOTO), 'id'=>$id, 'culture'=>$sf_user->getCulture(), 'comments_page_url'=>$comments_page_url)) ?>	
</div>