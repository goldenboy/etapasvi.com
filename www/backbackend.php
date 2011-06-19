<?php

//phpinfo();
//exit();
/*
ini_set( 'error_reporting', 'E_ALL' );
ini_set( 'display_errors', 'on' );
error_reporting(E_ALL);*/
require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('backend', 'prod', false);
sfContext::createInstance($configuration)->dispatch();
