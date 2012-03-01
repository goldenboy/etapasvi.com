<?php
function http_authenticate($user,$pass,$pass_file='.htpasswd',$access_allowed = '',$crypt_type='DES'){
    // the stuff below is just an example useage that restricts
    // user names and passwords to only alpha-numeric characters.
    //if(!ctype_alnum($user)){
        // invalid user name
    //    return FALSE;
    //}
    
    //if(!ctype_alnum($pass)){
        // invalid password
    //    return FALSE;
    //}
    // get the information from the htpasswd file
    if(file_exists($pass_file) && is_readable($pass_file)){
        // the password file exists, open it
        if($fp=fopen($pass_file,'r')){
            while($line=fgets($fp)){
                // for each line in the file remove line endings
                $line=preg_replace('`[\r\n]$`','',$line);
                list($fuser,$fpass)=explode(':',$line);

                if($fuser==$user){
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
                    echo '$test_pw=' . $test_pw;
                    echo '$fpass=' . $fpass;
                    if($test_pw == $fpass){
                        // authentication success.
                        fclose($fp);
						if (in_array($fgroup, $access_allowed)) {
							return TRUE;	
						} else {
							return false;
						}
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


// Basic auth
if (http_authenticate('dev', $_GET['dev'], dirname(__FILE__).'/.htpasswd')){
    // ok
} else {
    echo 'Access denied';
    exit;
}

if (preg_match("/^\/www\/.*/", $_SERVER['SCRIPT_NAME'])) {
	$_SERVER['DOCUMENT_ROOT'] .= '/www';
	$_SERVER['SCRIPT_NAME']   = preg_replace("/^\/www/", '', $_SERVER['SCRIPT_NAME']);
	$_SERVER['PHP_SELF']      = preg_replace("/^\/www/", '', $_SERVER['PHP_SELF']);
}

require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('backend', 'dev', true);
/*
ini_set( 'error_reporting', 'E_ALL' );
ini_set( 'display_errors', 'on' );
error_reporting(E_ALL);
*/

ini_set( 'error_reporting', 'E_NONE' );
ini_set( 'display_errors', 'off' );
error_reporting(E_ALL);

sfContext::createInstance($configuration)->dispatch();
