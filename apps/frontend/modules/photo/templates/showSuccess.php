<?php /*
<script type="text/javascript">
$(document).ready(function(){
    loadPhotoContentFromHash( '<?php echo $_SERVER['HTTP_HOST']; ?>' );
});
</script>
*/ ?>

<?php slot('body_id') ?>body_photo<?php end_slot() ?>
<h1 id="top"><?php echo __('Photo') ?></h1>

<?php include_partial('photo/content', array('id'=>$id, 'title'=>$title)) ?>

<?php /*
<p class="back">
	<a href="#top"><?php echo __('Go to top') ?></a>
</p>
*/ ?>