<?php
/**
 * Пингер. Период запуска: раз в час.
 * 
 * Запуск: 
 * cd /home/say10okt/etapasvi.com 
 * ./symfony project:ping
 * 
 * 20101008
 *
 */

class pingTask extends sfBaseTask
{
  //const PING_URL      = 'http://www.etapasvi.com/en/';
  const PING_TIMEOUT  = 30;
  const CHECK_PATTERN = '<\/html>';
    
  protected function configure()
  {
    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
      // add your own options here
    ));

    $this->namespace        = 'project';
    $this->name             = 'ping';
    $this->briefDescription = 'Pinger';
    $this->detailedDescription = <<<EOF
Ping website
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    $ch = curl_init();
    
	curl_setopt( $ch, CURLOPT_FAILONERROR, 1 );  
	//curl_setopt( $ch, CURLOPT_HEADER, 1 ); // allow redirects  
	//curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1 ); // allow redirects  
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1) ; // return into a variable			
	curl_setopt( $ch, CURLOPT_TIMEOUT, self::PING_TIMEOUT); // times out
			
	$msg = '';
	foreach(UserPeer::getCultures() as $culture) {
		$url = 'http://' . UserPeer::SITE_ADDRESS . '/' . $culture . '/';
		curl_setopt( $ch, CURLOPT_URL, $url ); // set url to post to 
		$response = curl_exec( $ch );
	
		if ( curl_error($ch) ) {
			$error  = 'Ошибка соединения';
		} elseif ( !preg_match("/" . self::CHECK_PATTERN . "/", $response) ) {
			$error  = 'Не найден элемент ' . self::CHECK_PATTERN;	
			
		}
		if ($error) {
			$msg .= $url . ' - Ошибка: ' . $error . "\r\n";
		}
	}
		
	if ($msg) {	  	  
	  // уведомление отправляется раз в час
  	  UserPeer::adminNotify($msg, 'pinger');	  
  	  echo $msg;
	} else {
	    echo 'Пинг успешно выполнен';
	}
    
  }
  
}
