<?php
if (!in_array(@$_SERVER['REMOTE_ADDR'], array('109.197.73.109', '::1')))
{
  die('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
}

require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('backend', 'dev', false);
sfContext::createInstance($configuration)->dispatch();
