<?php
if (!empty($photo)) {
    $comments_page_url = $photo->getUrl();
} else {
    $comments_page_url = '';
}
?>

<?php include_component('photo', 'showwrapper', array('id'=>$id, 'title'=>$title, 'photo'=>$photo)); ?>
<?php include_partial('comments/tools', array('empty'=>true)); ?>
<?php include_component('comments', 'show', array('for'=>strtolower(ItemtypesPeer::ITEM_TYPE_NAME_PHOTO), 'id'=>$id, 'culture'=>$sf_user->getCulture(), 'comments_page_url'=>$$comments_page_url)) ?>	
<script type="text/javascript">
    preparePhotoContent();
</script>
