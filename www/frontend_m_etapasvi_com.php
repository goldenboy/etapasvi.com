<?php
/**
 * Контроллер мобильной версии 
 *
 */

// прописываем жёстко, чтобы ссылки генерировались правильно
$_SERVER['HTTP_HOST']        = 'm.etapasvi.com';
// используется Yahoo
// http://tasks.etapasvi.com/issues/242
$_SERVER['HTTP_X_FORWARDED_HOST']   = $_SERVER['HTTP_HOST'];

// если к скрипту обратились из консоли, подменяем пермененные в $_SERVER
if (!empty($_SERVER['SHELL']) || empty($_SERVER['DOCUMENT_ROOT'])) {
	
// из браузера
//    [PATH] => /bin:/usr/bin:/sbin:/usr/sbin
//    [RAILS_ENV] => production
//    [FCGI_ROLE] => RESPONDER
//    [UNIQUE_ID] => Tfjyf0Wj4b0AAGbIVBMAAAAB
//    [SCRIPT_URL] => /frontfrontend2.php/ru/photo/836
//    [SCRIPT_URI] => http://www.etapasvi.com/frontfrontend2.php/ru/photo/836
//    [dsid] => 16681366
//    [ds_id_16681366] => 
//    [DH_USER] => saynt2day20
//    [HTTP_HOST] => www.etapasvi.com
//    [HTTP_CONNECTION] => close
//    [HTTP_USER_AGENT] => Mozilla/5.0 (Windows NT 5.1) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.91 Safari/534.30
//    [HTTP_ACCEPT] => text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8
//    [HTTP_ACCEPT_ENCODING] => gzip,deflate,sdch
//    [HTTP_ACCEPT_LANGUAGE] => ru-RU,ru;q=0.8,en-US;q=0.6,en;q=0.4
//    [HTTP_ACCEPT_CHARSET] => windows-1251,utf-8;q=0.7,*;q=0.3
//    [HTTP_COOKIE] => __utmz=52717614.1308159449.313.64.utmcsr=facebook.com|utmccn=(referral)|utmcmd=referral|utmcct=/l.php; __utma=52717614.2090627019.1299092816.1308082036.1308159449.313; __utmc=52717614; __utmb=52717614.8.10.1308159449
//    [SERVER_SIGNATURE] => 
//    [SERVER_SOFTWARE] => Apache
//    [SERVER_NAME] => www.etapasvi.com
//    [SERVER_ADDR] => 173.236.246.98
//    [SERVER_PORT] => 80
//    [REMOTE_ADDR] => 94.241.62.174
//    [DOCUMENT_ROOT] => /home/saynt2day20/etapasvi.com/www
//    [SERVER_ADMIN] => webmaster@etapasvi.com
//    [SCRIPT_FILENAME] => /home/saynt2day20/etapasvi.com/www/frontfrontend2.php
//    [REMOTE_PORT] => 4778
//    [GATEWAY_INTERFACE] => CGI/1.1
//    [SERVER_PROTOCOL] => HTTP/1.1
//    [REQUEST_METHOD] => GET
//    [QUERY_STRING] => 
//    [REQUEST_URI] => /frontfrontend2.php/ru/photo/836
//    [SCRIPT_NAME] => /frontfrontend2.php
//    [PATH_INFO] => /ru/photo/836
//    [PATH_TRANSLATED] => redirect:/cache/ru/photo/836i.html/photo/836
//    [PHP_SELF] => /frontfrontend2.php/ru/photo/836
//    [REQUEST_TIME] => 1308160639

// из консоли
//    [GEM_HOME] => /home/saynt2day20/.gems/
//    [TERM] => xterm
//    [SHELL] => /bin/bash
//    [SSH_CLIENT] => 94.241.62.174 4482 22
//    [SSH_TTY] => /dev/pts/15
//    [USER] => saynt2day20
//    [MAIL] => /home/saynt2day20/Maildir/
//    [PATH] => /home/saynt2day20/.gems/bin:/usr/local/bin:/usr/bin:/bin:/usr/bin/X11:/usr/games
//    [LC_COLLATE] => C
//    [PWD] => /home/saynt2day20
//    [LANG] => en_US.UTF-8
//    [PS1] => [\h]$
//    [SHLVL] => 1
//    [HOME] => /home/saynt2day20
//    [LOGNAME] => saynt2day20
//    [GEM_PATH] => /home/saynt2day20/.gems/:/usr/lib/ruby/gems/1.8
//    [SSH_CONNECTION] => 94.241.62.174 4482 69.163.225.189 22
//    [_] => /usr/local/bin/php
//    [PHP_SELF] => /home/saynt2day20/etapasvi.com/www/frontfrontend2.php
//    [SCRIPT_NAME] => /home/saynt2day20/etapasvi.com/www/frontfrontend2.php
//    [SCRIPT_FILENAME] => /home/saynt2day20/etapasvi.com/www/frontfrontend2.php
//    [PATH_TRANSLATED] => /home/saynt2day20/etapasvi.com/www/frontfrontend2.php
//    [DOCUMENT_ROOT] =>
//    [REQUEST_TIME] => 1308160648
//    [argv] => Array
//        (
//            [0] => /home/saynt2day20/etapasvi.com/www/frontfrontend2.php
//            [1] => /ru/
//        )
//
//    [argc] => 2
	
	// /frontfrontend2.php/ru/photo/836
	$_SERVER['SCRIPT_NAME']      = preg_replace("/.*\//", '/', $_SERVER['argv'][0]);
	
	// /ru/
	$_SERVER['PATH_INFO']        = $_SERVER['argv'][1];
	
	// убрано название скрипта
	// http://bsds.etapasvi.com/issues/116
	// /frontfrontend2.php/ru/photo/836
	$_SERVER['SCRIPT_URL']       = /*$_SERVER['SCRIPT_NAME'] .*/ $_SERVER['PATH_INFO'];
	
	// http://www.etapasvi.com/frontfrontend2.php/ru/photo/836
	$_SERVER['SCRIPT_URI']       = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_URL'];
	
	// /home/saynt2day20/etapasvi.com/www
	$_SERVER['DOCUMENT_ROOT']    = preg_replace("/\/[^\/]+$/", '/', $_SERVER['argv'][0]);
	
	// /home/saynt2day20/etapasvi.com/www/frontfrontend2.php
	$_SERVER['SCRIPT_FILENAME']  = $_SERVER['argv'][0];
	
	// /frontfrontend2.php/ru/photo/836
	$_SERVER['REQUEST_URI']      = $_SERVER['SCRIPT_URL'];
	
	// /frontfrontend2.php/ru/photo/836
	$_SERVER['PHP_SELF']         = $_SERVER['SCRIPT_URL'];	
}


require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'mobile', false);
sfContext::createInstance($configuration)->dispatch();