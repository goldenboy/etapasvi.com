<?php slot('body_id') ?>body_search<?php end_slot() ?>

<h1 class="m_bottom"><?php echo __('Search') ?></h1>

<!-- Google Custom Search Element -->
<div id="cse" style="width:100%;">Loading</div>
<script src="http://www.google.com/jsapi" type="text/javascript"></script>
<script type="text/javascript">
  google.load('search', '1');
  google.setOnLoadCallback(function(){
    var cse = new google.search.CustomSearchControl();
    cse.enableAds('pub-7066467414020246');
    cse.draw('cse');
  }, true);
</script>