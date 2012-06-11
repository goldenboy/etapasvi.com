<?php slot('body_id') ?>body_photo<?php end_slot() ?>
<h1 id="top"><?php echo __('Photo') ?></h1>
<div id="photo_content">
<script type="text/javascript">
    $(document).ready(function() {
        loadPhotoContentByPhotoId(document.location + '');
    });
</script>
<div class="box photofull">
<div class="center_text prev_next" style="width:100%;height:300px"></div>
</div>
</div>