<?php slot('body_id') ?>body_search<?php end_slot() ?>

<h1 class="m_bottom"><?php echo __('Search') ?></h1>

<!-- Google Custom Search Element -->
<div id="cse" style="width:100%;">Loading</div>
<script src="//www.google.ru/jsapi" type="text/javascript"></script>
<script type="text/javascript"> 
  var _gaq = _gaq || [];
  _gaq.push(["_setAccount", "UA-4047144-3"]);
  function _trackQuery(control, searcher, query) {
    var loc = document.location;
    var url = [
      loc.pathname,
      loc.search,
      loc.search ? '&' : '?',
      encodeURIComponent('q'),
      '=',
      encodeURIComponent(query)
    ];
    _gaq.push(["_trackPageview", url.join('')]);
  }

  google.load('search', '1');
  google.setOnLoadCallback(function() {
    var customSearchControl = new google.search.CustomSearchControl('006414956786193237693:ixwluctz1yu');
    customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
    customSearchControl.setSearchStartingCallback(null, _trackQuery);
    customSearchControl.draw('cse');
  }, true);
</script>
<link rel="stylesheet" href="//www.google.com/cse/style/look/default.css" type="text/css" />