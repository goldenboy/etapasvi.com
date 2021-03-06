<?php
/**
 * Класс для репликации БД.
 * Репликация выполняется сразу на все слэйвы.
 * 
 * 2011-10-25
 * @author saynt2day
 */
class replicateDb {
	
	/**
	 * Параметры мастера:
	 * $master_params = array(
	 * 	'server' 	=> '',
	 *	'port' 		=> '3306',
	 *	'username' 	=> '',
	 *	'password' 	=> '',
	 *	'db' 		=> ''
	 * );
	 * 
	 * Параметры слейвов
	 * $slaves_params = array(
	 *	array(
	 *		'server' 	=> 'mysql.test.com',
	 *		'port' 		=> '3306',
	 *		'username' 	=> 'username',
	 *		'password' 	=> 'password',
	 *		'db' 		=> 'db'
	 *	),
	 *	array(
	 *		'server' 	=> 'mysql.test.com',
	 *		'port' 		=> '3306',
	 *		'username' 	=> 'username',
	 *		'password' 	=> 'password',
	 *		'db' 		=> 'db'
	 *	)
	 * );
	 * 
	 */
	public static function run($master_params, $slaves_params, $email_to, $email_subject)
	{
	
		// хэндлы подключений к слейвам
		$slaves_links = array();
		
		// контрольные суммы таблиц мастера
		$master_tables_checksums = array();
		
		// первичные ключи и контрольные суммы записей в мастере
		$master_tables_rows_checksums = array();
		
		// структуры таблиц: все поля и первичные ключи
		$tables_structure = array();
		
		// во время работы скрипта происходили ошибки
		$errors_detected = false;
	
		/**
		 * в случае ошибки
		 *
		 * @param unknown_type $msg
		 */
		function onError($msg, $exit = true)
		{
			msg($msg);
			if ($exit) {	
				mail($email_to, $email_subject, ob_get_contents());
				ob_flush();
				exit();
			} else {
				$errors_detected = true;
			}
		}
		
		/**
		 * Вывод сообщения
		 *
		 * @param unknown_type $text
		 */
		function msg($text)
		{
			echo date("Y-m-d H:i:s") . ': ' . $text."\r\n";
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
			if (!$result || mysql_error()) {
				$errors_detected = true;
			    onError("Server: {$db_params['server']}\r\nSQL: {$query}\r\nError: " . mysql_error(), false);
			}
			
			// для запросов на обновление и вставку данные не возвращаются
			if (is_resource($result)) {
				// Get result
				$rows = array();
				while ($row = mysql_fetch_assoc($result)) {
					$rows[] = $row;
				}
				
				// Free the resources associated with the result set
				// This is done automatically at the end of the script
				mysql_free_result($result);
				return $rows;
			} else {
				return $result;
			}
		}
		
		/**
		 * Получение SQL-запрос для выборки по первичному ключу.
		 *
		 * @param unknown_type $key_field_values
		 * @return unknown
		 */
		function getSqlFieldValue($field_values, $delimiter = ', ')
		{
			$sql_parts = array();
			foreach ($field_values as $field=>$value) {
				// служебные поля пропускаем
				if (in_array($field, array('concat_primary_key', 'checksum'))) {
					continue;
				}
				// если в мастере поле имеет формат даты и равно NULL, 
				// чтобы оно не превращалось в 000-00-00 в слейве надо явно указывать NULL
				// NULL не экранируем		
				if ($value == 'NULL') {
					$sql_parts[] = '`' . $field . '` = NULL';
				} else {
					$sql_parts[] = '`' . $field . '` = "' . mysql_real_escape_string($value) . '"';
				}
			}
		
			return implode($delimiter, $sql_parts);
		}
		
		/**
		 * Получение значений в кавычках через запятую.
		 *
		 * @param unknown_type $row
		 * @return unknown
		 */
		function getSqlFieldValuesCommaSeparated($row)
		{
			$sql_parts = array();
			foreach ($row as $field=>$value) {
				// если в мастере поле имеет формат даты и равно NULL, 
				// чтобы оно не превращалось в 000-00-00 в слейве надо явно указывать NULL
				// NULL не экранируем
				if ($value == 'NULL') {
					$sql_parts[] = 'NULL';	
				} else {
					$sql_parts[] = '"' . mysql_real_escape_string($value) . '"';	
				}
				
			}
		
			return implode(', ', $sql_parts);
		}
		
		/**
		 * Получение названий полей в кавычках через запятую
		 *
		 * @param unknown_type $row
		 * @param unknown_type $pattern шаблон, в котором поле прописано как :field
		 * @return unknown
		 */
		function getSqlFieldNamesCommaSeparated($fields, $pattern = '')
		{
			$sql_parts = array();
			foreach ($fields as $name) {
				if ($pattern) {
					$sql_parts[] = str_replace(':field', "`{$name}`", $pattern);
				} else {
					$sql_parts[] = $before . "`{$name}`" . $after;
				}
			}
		
			return implode(', ', $sql_parts);
		}		
		
		// начало буферизации вывода
		ob_start();	
		
		// подключение к master БД
		$master_link = connectDb($master_params);
		queryDb('SET NAMES utf8', $master_link, $master_params);
		msg( "Connected to master " . $master_params['server'] . ':' . $master_params['port'] );
		
		// подключение к слейвам
		foreach ($slaves_params as $i=>$slave) {
			if (!$slave['server']) {
				unset($slaves_params[$i]);
				continue;
			}
			$slaves_links[$i] = connectDb($slave);
			queryDb('SET NAMES utf8', $slaves_links[$i], $slave);
			msg( "Connected to slave " . $slave['server'] . ':' . $slave['port'] );
		}
		
		// получение контрольных сумм таблиц в мастере
		$master_tables_checksums = queryDb('SHOW TABLE STATUS FROM ' . $master_params['db'], $master_link, $master_params);
		if (!$master_tables_checksums) {
			onError('Error getting master checksums');
		}
		
		// непосредственно сравнение и обновление мастера и слейвов:
		// сначала сравниваются таблицы (реплицируются только таблицы, для которых в мастере есть контрольная суммма)
		// в таблицах, в которых найдены отличия сравниваются строки
		foreach ($slaves_params as $i=>$slave) {
			$slave_link = $slaves_links[ $i ];
			$slave_tables_checksums = queryDb('SHOW TABLE STATUS FROM ' . $slave['db'], $slaves_links[$i], $slave);
			if (!$slave_tables_checksums) {
				onError("Error getting slave {$slave['server']}:{$slave['port']} checksums", false);
			}
		
			msg( "Replicating slave {$slave['server']}:{$slave['port']}..." );
			
			// сравниваются таблицы
			$replicate_table = '';
			foreach ($master_tables_checksums as $master_checksum_row) {
				// реплицируются только таблицы, для которых в мастере есть контрольная суммма
				if (!$master_checksum_row['Checksum']) {
					continue;
				}
				$replicate_table 		= $master_checksum_row['Name'];
				$table_exists_on_slave  = false;
				$table_need_replication = false;
				foreach ($slave_tables_checksums as $slave_checksum_row) {
								
					if ($slave_checksum_row['Name'] == $replicate_table) {
						$table_exists_on_slave  = true;
						// контрольные суммы таблиц на мастере и слейве отличаются
						if ($slave_checksum_row['Checksum'] != $master_checksum_row['Checksum']) {
							$table_need_replication = true;					
							break;
						}
					}
				}
				if (!$table_exists_on_slave) {
					msg( "Table {$replicate_table} does not exists on slave" );
					$errors_detected = true;
				}
				if (!$table_need_replication) {
					continue;
				}
				msg( "Table {$replicate_table} differs" );
				
				// получение структур всех таблиц
				if (!$tables_structure) {
					foreach ($master_tables_checksums as $master_checksum_row) {
						// реплицируются только таблицы, для которых в мастере есть контрольная суммма
						if (!$master_checksum_row['Checksum']) {
							continue;
						}
						$describe_table = queryDb('DESCRIBE ' . $master_checksum_row['Name'], $master_link, $master_params);
						if (!$describe_table) {
							onError('Error getting table structure: ' . $master_checksum_row['Name']);
						}
						foreach ($describe_table as $field_options) {
							if ($field_options['Key'] == 'PRI') {
								$tables_structure[ $master_checksum_row['Name'] ]['primary_key'][] = $field_options['Field'];
							}
							$tables_structure[ $master_checksum_row['Name'] ]['fields'][] = $field_options['Field'];
						}
						if (empty($tables_structure[ $master_checksum_row['Name'] ]['fields']) ||
							empty($tables_structure[ $master_checksum_row['Name'] ]['primary_key'])) {
							onError('Error getting table primary key: ' . $master_checksum_row['Name']);
						}
					}
				}
				//print_r( $tables_structure );
				
				// Получение контрольных сумм записей в таблице мастера
				// Сравнивать надо с учётом NULL
				// Если поле равно Null и "" команда SHOW TABLE STATUS выдаст разные контрольные суммы для таблиц,
				// При этом контрольная сумма строк будет совпадать
				$sql_rows_checksums = "SELECT " . implode(', ', $tables_structure[ $replicate_table ]['primary_key']) . ",
									  concat_ws('', " . getSqlFieldNamesCommaSeparated($tables_structure[ $replicate_table ]['primary_key']) . ") as concat_primary_key,
									  md5(concat_ws('', " . getSqlFieldNamesCommaSeparated($tables_structure[ $replicate_table ]['fields'], "IFNULL(:field, 'NULL')") 
									  . ")) as checksum 
									  FROM {$replicate_table}";
		
				if (empty($master_tables_rows_checksums[ $replicate_table ])) {
					$master_tables_rows_checksums[ $replicate_table ] = queryDb($sql_rows_checksums, $master_link, $master_params);
					if (empty($master_tables_rows_checksums[ $replicate_table ])) {
						onError('Error getting table rows checksums from master: ' . $replicate_table);
					}
				}
		
				// получение контрольных сумм записей в таблице слейва
				$slave_table_rows_checksums = queryDb($sql_rows_checksums, $slave_link, $slave);		
				if (empty($slave_table_rows_checksums)) {
					// учесть, что в таблице слейва может просто не быть полей
					$sql_count_records = "SELECT count(*) as cnt FROM `{$replicate_table}`";
					$count_records = queryDb($sql_count_records, $slave_link, $slave);
		
					if ($count_records[0]['cnt'] != 0) {
						$errors_detected = true;
						onError("Error getting table rows checksums from slave {$slave['server']}: {$replicate_table}", false);
						continue;
					}
				}
		
				$count_added = 0;
				$count_removed = 0;
				$count_updated = 0;				
				// построчное сравнение контрольных сумм записей таблицы мастера и слейва
				foreach ($master_tables_rows_checksums[ $replicate_table ] as $master_table_row_checksum) {
					$row_exists_in_slave  = false;
					$row_differs_in_slave = false;
					foreach ($slave_table_rows_checksums as $slave_table_row_checksum) {
						if ($slave_table_row_checksum['concat_primary_key'] == $master_table_row_checksum['concat_primary_key']) {
							$row_exists_in_slave = true;
							if ($slave_table_row_checksum['checksum'] != $master_table_row_checksum['checksum']) {
								$row_differs_in_slave = true;
							}
							break;
						}
					}
		
					// запись надо либо добавить либо обновить
					if (!$row_exists_in_slave || $row_differs_in_slave) {
		
						$sql_get_row_from_master = "SELECT " . getSqlFieldNamesCommaSeparated($tables_structure[ $replicate_table ]['fields'], "IFNULL(:field, 'NULL') as :field") 
													. " FROM {$replicate_table} WHERE " . 
													getSqlFieldValue($master_table_row_checksum, ' and ');
		
						list($master_row) = queryDb($sql_get_row_from_master, $master_link, $master_params);
						
						if (!$master_row) {
							$errors_detected = true;
							onError("Error getting table row from master: {$replicate_table}", false);
						}
		
						// Внимание!
						// если в мастере поле имеет формат даты и равно NULL, чтобы оно не превращалось в 000-00-00 в слейве
						// надо явно указывать NULL				
						
						if (!$row_exists_in_slave) {
							// добавляем новую запись в слейв
							$sql_insert_row_in_slave = 
								"INSERT INTO {$replicate_table} (" . getSqlFieldNamesCommaSeparated($tables_structure[ $replicate_table ]['fields']) . ") " .
								"VALUES (" . getSqlFieldValuesCommaSeparated($master_row) . ")";				
																				
							queryDb($sql_insert_row_in_slave, $slave_link, $slave);
							$count_added++;
						} else {
							// обновляем запись в слейве
							$sql_update_row_in_slave = "UPDATE {$replicate_table} SET " . getSqlFieldValue($master_row) . " WHERE " . 
														getSqlFieldValue($master_table_row_checksum, ' and ');					
							queryDb($sql_update_row_in_slave, $slave_link, $slave);
							$count_updated++;
						}	
					}
				}
				// поиск записей, которые надо удалить в слейве
				foreach ($slave_table_rows_checksums as $slave_table_row_checksum) {
					$row_exists_in_master = false;
					foreach ($master_tables_rows_checksums[ $replicate_table ] as $master_table_row_checksum) {	
						if ($master_table_row_checksum['concat_primary_key'] == $slave_table_row_checksum['concat_primary_key']) {
							$row_exists_in_master = true;
							break;
						}
					}
					// удаляем запись из слейва
					if (!$row_exists_in_master) {
						$sql_delete_row_in_slave = "DELETE FROM {$replicate_table} WHERE " . 
												    getSqlFieldValue($slave_table_row_checksum, ' and ');					
		
						queryDb($sql_delete_row_in_slave, $slave_link, $slave);
						$count_removed++;
					}
				}
				msg("Added: " . (int)$count_added . ", Removed: " . (int)$count_removed . ", Updated: " . (int)$count_updated)		;
			}
		}
		
		// закрытие соединений с БД
		foreach ($slaves_links as $slave_link) {
			mysql_close($slave_link);
		}
		mysql_close($master_link);
		
		// отправка уведомления, если были ошибки
		if ($errors_detected) {
			mail($email_to, $email_subject, ob_get_contents());
		}
		
		msg( "Replication finished" );
		
		// окончание буферизации вывода
		ob_flush();
	}	
}