<?php

// режим отладки
if ((!empty($_GET['debug_key']) && $_GET['debug_key'] == 'b7a3cc471e49223dbb4a89e7d85ab6df')) {

	// ставим куку на сутки
	setcookie('debug_key', 'b7a3cc471e49223dbb4a89e7d85ab6df', 0, time()+24*60*60, '.' . $_SERVER['HTTP_HOST'], false);
} elseif (empty($_COOKIE['debug_key']) || $_COOKIE['debug_key'] != 'b7a3cc471e49223dbb4a89e7d85ab6df') {
    die('Access denied');
}

/*
// this check prevents access to debug front controllers that are deployed by accident to production servers.
// feel free to remove this, extend it or make something more sophisticated.
if (!in_array(@$_SERVER['REMOTE_ADDR'], array('94.241.53.28', '::1')))
{
  die('You are not allowed to access this file.');
}*/

require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'dev', true);
sfContext::createInstance($configuration)->dispatch();
