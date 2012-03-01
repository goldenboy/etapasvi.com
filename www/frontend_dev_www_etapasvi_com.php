<?php
/*
Header("Cache-Control: must-revalidate");

$offset = 3600; // час
$ExpStr = "Expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";
Header($ExpStr);*/

// this check prevents access to debug front controllers that are deployed by accident to production servers.
// feel free to remove this, extend it or make something more sophisticated.

/*
if (!in_array(@$_SERVER['REMOTE_ADDR'], array('94.241.41.3', '::1')))
{
  die('You are not allowed to access this file.');
}*/

// Если на сервере веб-директория не /www/, заменяем:
//    [DOCUMENT_ROOT] => /home/user/public_html
//    [REQUEST_URI] => /t.php
//    [SCRIPT_NAME] => /www/t.php
//    [PHP_SELF] => /www/t.php
// на
//    [DOCUMENT_ROOT] => /home/user/etapasvi.com/www
//    [REQUEST_URI] => /t.php
//    [SCRIPT_NAME] => /t.php
//    [PHP_SELF] => /t.php
if (preg_match("/^\/www\/.*/", $_SERVER['SCRIPT_NAME'])) {
	$_SERVER['DOCUMENT_ROOT'] .= '/www';
	$_SERVER['SCRIPT_NAME']   = preg_replace("/^\/www/", '', $_SERVER['SCRIPT_NAME']);
	$_SERVER['PHP_SELF']      = preg_replace("/^\/www/", '', $_SERVER['PHP_SELF']);
}

require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'dev', true);
sfContext::createInstance($configuration)->dispatch();
