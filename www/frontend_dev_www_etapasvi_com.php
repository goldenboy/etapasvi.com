<?php

function http_authenticate($user,$pass,$pass_file='.htpasswd',$crypt_type='DES'){
    // get the information from the htpasswd file
    if(file_exists($pass_file) && is_readable($pass_file)){
        // the password file exists, open it
        if($fp=fopen($pass_file,'r')){
            while($line=fgets($fp)){
                // for each line in the file remove line endings
                $line=preg_replace('`[\r\n]$`','',$line);
                list($fuser,$fpass)=explode(':',$line);

                if($fuser==$user){
                	if ($pass == $fpass){
                        // authentication success.
						return $fpass;
                    }
                    // the submitted user name matches this line
                    // in the file
                    switch($crypt_type){
                        case 'DES':
                            // the salt is the first 2
                            // characters for DES encryption
                            $salt=substr($fpass,0,2);
                            
                            // use the salt to encode the
                            // submitted password
                            $test_pw=crypt($pass,$salt);
                            break;
                        case 'PLAIN':
                            $test_pw=$pass;
                            break;
                        case 'SHA':
                        case 'MD5':
                        default:
                            // unsupported crypt type
                            fclose($fp);
                            return FALSE;
                    }
                    if($test_pw == $fpass){
                        // authentication success.
						return $fpass;
                    }else{
                        return FALSE;
                    }
                }
            }
            fclose($fp);
        }else{
            // could not open the password file
            return FALSE;
        }
    }else{
        return FALSE;
    }
}


// Basic auth
if (!$_COOKIE['dev_password'] && count($_GET)) {
	$get_keys = array_keys($_GET);
	$dev_password = $_GET[ $get_keys[0] ];
	$dev_login    = $get_keys[0];
} else {
	$dev_password = $_COOKIE['dev_password'];
	$dev_login    = $_COOKIE['dev_login'];
}
$dev_password_encrypted = http_authenticate($dev_login, $dev_password, dirname(__FILE__).'/.htpasswd');
if ($dev_password_encrypted){
    // ok
    setcookie('dev_login', $dev_login, time()+10*60, '/');
    setcookie('dev_password', $dev_password_encrypted, time()+10*60, '/');
} else {
    echo 'Access denied';
    exit;
}

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
