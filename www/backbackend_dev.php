<?php
// режим отладки
if ((!empty($_GET['debug_key']) && $_GET['debug_key'] == 'b7a3cc471e49223dbb4a89e7d85ab6df')) {

	// ставим куку на сутки
	setcookie('debug_key', 'b7a3cc471e49223dbb4a89e7d85ab6df', time()+24*60*60, '/');
} elseif (empty($_COOKIE['debug_key']) || $_COOKIE['debug_key'] != 'b7a3cc471e49223dbb4a89e7d85ab6df') {
    die('Access denied');
}

ini_set( 'error_reporting', 'E_ALL' );
ini_set( 'display_errors', 'on' );
error_reporting(E_ALL);

require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('backend', 'dev', false);
sfContext::createInstance($configuration)->dispatch();
