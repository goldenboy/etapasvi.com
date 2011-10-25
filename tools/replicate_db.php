<?php
/**
 * Скрипт для репликации БД.
 * Репликация выполняется одновременно на все slave БД.
 * 
 * 2011-10-25
 */

define('EMAIL_TO', 'saynt2day@gmail.com');
define('EMAIL_SUBJECT', 'etapasvi: replicate_db');
//define('EMAIL_FROM', '');

// параметры мастера
$master_params = array(
	'server' 	=> '',
	'port' 		=> '3306',
	'username' 	=> '',
	'password' 	=> '',
	'db' 		=> ''
);

// параметры слейвов
$slaves_params = array(
	array(
		'server' 	=> 'mysql.back2.etapasvi.com',
		'port' 		=> '3306',
		'username' 	=> 'userback2etapasv',
		'password' 	=> 'J8P67gIL62fbJQE5lZEb',
		'db' 		=> 'back2etapasvicom'
	),
	array(
		'server' 	=> '',
		'port' 		=> '',
		'username' 	=> '',
		'password' 	=> ''
	)
);

// хэндлы подключений к слейвам
$slaves_links = array();

// контрольные суммы таблиц мастера
$master_tables_checksums = array();

// во время работы скрипта происходили ошибки
$error_occured = false;

// YAML парсер
require_once(dirname(__FILE__).'/../lib/symfony/yaml/sfYaml.php');

/**
 * в случае ошибки
 *
 * @param unknown_type $msg
 */
function onError($msg, $exit = true)
{
	echo $msg."\r\n";
	if ($exit) {	
		mail(EMAIL_TO, EMAIL_SUBJECT, ob_get_contents());
		ob_flush();
		exit();
	} else {
		$error_occured = true;
	}
}

/**
 * Подключение к БД
 *
 * @param unknown_type $params
 */
function connectDb($params)
{
	$link = mysql_connect(
		$params['server'] . ':' . $params['port'],
		$params['username'],
		$params['password']
	);
	if (!$link) {
	    onError("Could not connect to {$params['server']}:{$params['port']}: " . mysql_error());
	}
	// выбор БД
	$db_selected = mysql_select_db($params['db'], $link);
	if (!$db_selected) {
    	onError("Could not select DB '{$params['db']}' on {$params['server']}:{$params['port']}: " . mysql_error());
	}

	return $link;
}

/**
 * Выполнение SQL-запроса
 *
 * @param unknown_type $query
 * @param unknown_type $link
 * @param unknown_type $server
 * @return unknown
 */
function queryDb($query, $link, $db_params)
{
	// Perform Query
	$result = false;
	try {
		$result = mysql_query($query, $link);
	} catch (Exception $e) {}
	
	// Check result
	if (!$result) {
	    onError("Server: {$db_params['server']}\r\nSQL: {$query}\r\nError: " . mysql_error());
	}
	
	// Get result
	$rows = array();
	while ($row = mysql_fetch_assoc($result)) {
		$rows[] = $row;
	}
	
	// Free the resources associated with the result set
	// This is done automatically at the end of the script
	mysql_free_result($result);

	return $rows;
}

// начало буферизации вывода
ob_start();

// получение параметров мастера
$master_db_params = sfYaml::load(dirname(__FILE__).'/../config/databases.yml');

$master_params['username'] = $master_db_params['all']['propel']['param']['username'];
$master_params['password'] = $master_db_params['all']['propel']['param']['password'];

$master_pass_port = '';
preg_match("/mysql:dbname=([^;]+);host=(.*)/", $master_db_params['all']['propel']['param']['dsn'], $master_pass_port);
$master_params['server'] = $master_pass_port[2];
$master_params['db']   = $master_pass_port[1];

// подключение к master БД
$master_link = connectDb($master_params);
echo "Connected to master " . $master_params['server'] . ':' . $master_params['port'] . "\n";

// подключение к слейвам
foreach ($slaves_params as $i=>$slave) {
	if (!$slave['server']) {
		unset($slaves_params[$i]);
		continue;
	}
	$slaves_links[$i] = connectDb($slave);
	echo "Connected to slave " . $slave['server'] . ':' . $slave['port'] . "\n";
}

// получение контрольных сумм таблиц в мастере
$master_tables_checksums = queryDb('SHOW TABLE STATUS FROM ' . $master_params['db'], $master_link, $master_params);
if (!$master_tables_checksums) {
	onError('Error getting master checksums');
}


foreach ($slaves_params as $i=>$slave) {	
	$slave_tables_checksums = queryDb('SHOW TABLE STATUS FROM ' . $slave['db'], $slaves_links[$i], $slave);
	if (!$slave_tables_checksums) {
		onError("Error getting slave {$slave['server']}:{$slave['port']} checksums", false);
	}
	print_r( $slave_tables_checksums );
}

// закрытие соединений с БД
foreach ($slaves_links as $slave_link) {
	mysql_close($slave_link);
}
mysql_close($master_link);

// отправка уведомления, если были ошибки
if ($error_occured) {
	mail(EMAIL_TO, EMAIL_SUBJECT, ob_get_contents());
}

echo "Replication finished\r\n";

// окончание буферизации вывода
ob_flush();