<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new sfTestFunctional(new sfBrowser());

$browser->
  setHttpHeader('Host', sfConfig::get('app_domain_name'))->
  get('/en/')->

  with('request')->begin()->
    isParameter('module', 'news')->
    isParameter('action', 'main')->
  end()->

  with('response')->begin()->
    isStatusCode(200)->
// for error 404 page
    matches("/<title>.*<\/title>/")->
    matches("/UDLS(?:.*?)UDLE/")->
  end()
;
