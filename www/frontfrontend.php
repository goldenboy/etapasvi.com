<?php

// заголовки для кэширования отправляет симфони, если with_layout = true
/*
// список страниц, которые не кэшируются
$no_cache_list = array(
	'/news/show/',
	'/teachings/show/',
	'/photo/show/',
	'/video/show/',
	'/user/',
	'/captcha',
);

// время, на которое кэшируются страницы
$cache_time = 60*60*24; // сутки

$cache_page = true;

// проверяем, надо ли кэшировать страницу
foreach ($no_cache_list as $page) {
	if ( strstr($_SERVER['REQUEST_URI'], $page) ) {
		$cache_page = false;
		break;
	}
}

// отправка заголовков
if ($cache_page) {

	Header('Expires: ' . gmdate('D, d M Y H:i:s', time()+$cache_time) . ' GMT');
	Header('Cache-Control:max-age=' . $cache_time . ', must-revalidate');
	Header('Last-Modified: ' . gmdate("D, d M Y H:i:s", time()-60) . ' GMT');
	//Header('Vary: Cookie,Accept-Encoding'); // чтобы после авторизации, браузер обновил кэш страниц
	//Header('ETag: 123');
}
*/

/*
$f_log = fopen('/home/saynt2day20/etapasvi.com/log/page_views.log', 'a+');
fputs($f_log, $_SERVER['REQUEST_URI'] . "\r\n");
fclose($f_log);*/


require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'prod', false);
sfContext::createInstance($configuration)->dispatch();