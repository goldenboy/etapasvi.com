<?php
/**
 * Монитор логов ошибок.
 * Запускается по расписанию через определённый промежуток времени.
 * Если находит сообщение хотя бы в одном из логов за этот промежуток времени, отправляет уведомление.
 * 
 * 2011-05-15
 */
// период, через который запускается скрипт
// должен равняться тому, что указан в кроне
$period = '20 minutes';

// e-mail, на который отправляются уведомления
$email = 'saynt2day@gmail.com';

// список логов
$logs = array(
	'symfony' => array(
		'path'        => '/home/saynt2day20/etapasvi.com/log/frontend_prod.log',
		'date_start'  => 0,
		'date_length' => 15
	),
	'server' => array(
		//'path'        => '/home/saynt2day20/logs/etapasvi.com/http.16681366/error.log',
		'path'        => '/home/saynt2day20/logs/etapasvi.com/http.16681366/error.log',
		'date_start'  => 1,
		'date_length' => 24
	)
);

// сообщение на e-mail
$msg = '';

// время, с которого собираем записи
$cur_timestamp = strtotime('-' . $period);

// анализ логов
foreach ($logs as $log_name => $log_info) {
	$handle = fopen($log_info['path'], 'rt');
	if ($handle) {
	    while (!feof($handle)) {
	        $line           = fgets($handle, 4096);
	        // пустая строка
	        if (strlen($line) < $log_info['date_length']) {
	        	continue;
	        }
	        //echo $line . "\r\n";
	        $line_timestamp = strtotime( substr($line, $log_info['date_start'], $log_info['date_length']) );
	        //echo date("Y-m-d H:i:s", $line_timestamp) . " - " . date("Y-m-d H:i:s", $cur_timestamp) . "\r\n";
	        if ($line_timestamp > $cur_timestamp) {
	        	$msg .= $log_name . ': ' . $line . "\r\n";
	        }
	    }
	    fclose($handle);
	} else {
		echo 'Could not open: ' . $log_info['path'] . "\r\n";
		continue;
	}
}

if ($msg) {
	// вывод результата на экран
	echo $msg;
	// отправка уведомления
	mail($email, 'etapasvi: log_monitor', $msg);
} else {
	echo 'No errors found during last ' . $period;
}
echo "\r\n";
