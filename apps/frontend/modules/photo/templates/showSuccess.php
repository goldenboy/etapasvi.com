<script type="text/javascript">
$(document).ready(function(){
    loadPhotoContentFromHash( '<?php echo $_SERVER['HTTP_HOST']; ?>' );
});
</script>

<div id="photo_content">
<?php include_partial('photo/content', array('id'=>$id, 'title'=>$title)) ?>
</div>
<?php /*
<p class="back">
	<a href="#top"><?php echo __('Go to top') ?></a>
</p>
*/ ?>