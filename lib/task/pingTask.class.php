<?php
/**
 * Пингер.
 * Запускается по крону.
 * Проверяет доступность главных страниц вебов (полная и мобильная версии) на всех языках.
 * Номер вебов получаются из Google Docs.
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
  	// чтобы можно было получить настройки с помощью sfConfig::get() указываем application = frontend
  	
    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'frontend'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'prod'),
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
  	// получение списка вебов из Google Docs
  	$webs_array = TextPeer::getGoogleDocAsArray(TextPeer::GOOGLE_DOC_SERVERS);
  	foreach ($webs_array as $i=>$web_row) {
  		if ($i==0) {
  			continue;
  		}
  		$webs_list[] = $web_row[0];
  	}


			
	$msg = '';
	foreach(UserPeer::getCultures() as $culture) {
	  $error = false;
	  // цикл по вебам
	  foreach ($webs_list as $web) {
	  	// полная и мобильная версии
	  	for ($f_m=0; $f_m<=1; $f_m++) {
	      $url = 'http://' . UserPeer::getWebDomain($web, $f_m) . '/' . $culture . '/';
	      
	      echo $url . "\r\n";
	      
	      // curl каждый раз создаём заново, т.к. в противном случае при возникновении ошибки
	      // все последующие вызовы curl_error будут говорить, что произошла ошибка
	      try {
		    $ch = curl_init();
		    
	        curl_setopt( $ch, CURLOPT_FAILONERROR, 1 );  
		    //curl_setopt( $ch, CURLOPT_HEADER, 1 ); // allow redirects  
		    //curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1 ); // allow redirects  
		    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1) ; // return into a variable			
		    curl_setopt( $ch, CURLOPT_TIMEOUT, self::PING_TIMEOUT); // times out
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
	        curl_close($ch);
	      } catch(Exception $e)	{
	      	if (!empty($ch)) {
	      	  curl_close($ch);
	      	}
	      	$msg .= $url . ' - Ошибка: ' . $e->getMessage() . "\r\n";
	      }
	  	}
	  }
	}
		
	if ($msg) {	  	  
	  // отправка уведомления админу
  	  UserPeer::adminNotify($msg, sfConfig::get('app_site_name') . ': pinger');	  
  	  echo "\r\n";
  	  echo $msg;
	} else {
	  echo "Пинг успешно выполнен\r\n";
	}
    
  }
  
}
