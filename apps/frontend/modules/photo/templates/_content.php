<?php include_component('photo', 'showwrapper', array('id'=>$id, 'title'=>$title)); ?>
<?php include_partial('comments/tools', array('empty'=>true)); ?>
<?php include_component('comments', 'show', array('for'=>strtolower(ItemtypesPeer::ITEM_TYPE_NAME_PHOTO), 'id'=>$id, 'culture'=>$sf_user->getCulture())) ?>	
<script type="text/javascript">
    preparePhotoContent();
</script>
