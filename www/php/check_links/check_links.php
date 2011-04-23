<?php
/**
 * Check Links
 * 
 * Run Examples:
 * 
 * 1) php /www/cgu.dev.armd.ru/common/data/lib/php/linkchk/check_links.php 
 * apachay@armd.ru\;mrymar@armd.ru\;ichalin@armd.ru cgu.dev.armd.ru 
 * 
 * 2) php /www/cgu.dev.armd.ru/common/data/lib/php/linkchk/check_links.php 
 * saynt2day@gmail.com cgu.dev.armd.ru 500000
 *
 * @author Shekhovtsov Semyon
 * @version 20090821
 * 
 */

require_once( "phpcrawler/phpcrawler.class.php" );

//define( 'AUTH_USER', 'cguuser' );
//define( 'AUTH_PASS', 'icecirby' );

// сайт для поиска мёртвых ссылок по умолчанию
define( 'DEFAULT_SITE', 'etapasvi.com' );

set_time_limit(10000);


// Создание потомка класса и переопределение метода handlePageData()
class DeadLinksMyCrawler extends PHPCrawler 
{
	//public $dead_links;	
	
	function handlePageData(&$page_data)
	{		
			
		if ($page_data["http_status_code"] == '404') {
			$is_dead_link = true;
		} else {
			$is_dead_link = false;
		}
		
		// Сохранение мёртвой ссылки
		if ( $is_dead_link==true ) {
			$this->dead_links[] = array( 	
								  	'link'    => $page_data["url"], 
									'referer' => $page_data["referer_url"]
								  );
		}
		$this->page_index++;
		
	    // Номер
	    echo "# " . $this->page_index . "\n";
	    		
	    // Ссылка
	    echo "Page requested: ".$page_data["url"]."\n";
	    
	    // Статус
	    echo "Status: ".strtok($page_data["header"], "\n")."\n";
	    
	    // Страница со ссылкой
	    echo "Referer-page: ".$page_data["referer_url"]."\n";
	    
	    // Была ли прочитана ссылка
	    if ( $is_dead_link==false ) {
	    	echo "Content received: ".$page_data["bytes_received"]." bytes";
	    } else {
	    	echo "Content not received";
	       
	    }

	    echo "\n\n";
	}
}

function usage()
{
   echo "\n";
   echo "Check Links\n";
   echo "-----------------------------------------------\n";
   echo "Syntax:", "\n";
   echo "  php check_links.php email [site] [traffic limit]\n";
   echo "Arguments:", "\n";
   echo "  email: e-mail addresses for sending results\n";
   echo "  site: web site address\n";
   echo "  traffic limit: traffic limit in bites\n";
   echo "-----------------------------------------------\n\n";   
}

function main($argc,$argv) {
	
    usage();
    
    if ($argv[2] != '') {
    	$site_address = $argv[2];
    } else {
    	$site_address = DEFAULT_SITE;
    }
    
    if ($argv[1] != '') {
    	$email_address = $argv[1];
    } else {
    	echo "Specify e-mail address";
    	return 0;
    }
    if ($argv[3] != '') {
    	$traffic_limit = $argv[3];
    }  
    
    // Содание объекта для сканирования сайта
	$crawler = &new DeadLinksMyCrawler();
	
	// Сайт для сканирования
	$crawler->setURL( $site_address );
	
	// Читать только ссылк с типом содержимого "text/html"
	// (regular expression, preg)
	$crawler->addReceiveContentType("/text\/html/");
	
	// Не загружать картинки
	// (preg_match)
	$crawler->addNonFollowMatch("/.(jpg|gif|png|swf)$/ i");
	
	// Не обрабатывать javascript ссылки
	$crawler->setAggressiveLinkExtraction(false);
	
	// Хранить cookie
	//$crawler->setCookieHandling(true);
	
	// Лимит траффика
	if ($traffic_limit != 0) {
		$crawler->setTrafficLimit( $traffic_limit );
	}
	
	//$crawler->addBasicAuthentication('#.*#', AUTH_USER, AUTH_PASS );
		
	// Сканирование
	$crawler->go();
	
	// Отправка e-mail
	if ( count($crawler->dead_links) != 0 ) {
				
		$mail_body  = 'Ссылки, ведущие на 404:<br/><br/>';
		$mail_body .= '<table border="1" cellpadding="5">';
		$mail_body .= '<tr><th>№</th><th>Ссылка</th><th>Страница сайта</th></tr>';
		
		foreach ( $crawler->dead_links as $i=>$dead_link_info ) {
			$mail_body .= '<tr>';
			$mail_body .= '<td>' . ($i+1) . '</td>';
			$mail_body .= '<td>' . $dead_link_info['link'] . '</td>';
			$mail_body .= '<td>' . $dead_link_info['referer'] . '</td>';
			$mail_body .= '</tr>';
		}
		$mail_body .= '</table>';
		
		$subject = "Результат проверки ссылок на " . $site_address;			
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	
		if ( mail($email_address, $subject, $mail_body, $headers ) ) {
			echo "E-mail was sent to {$email_address}\n\n";
		} else {
			echo "Error occured sending e-mail to {$email_address}\n\n";
		}
	} else {
		echo "Dead links not found\n\n";
	}
	
	// Печать отчёта
	$report = $crawler->getReport();
	
	echo "Summary:\n";
	if ( $report["traffic_limit_reached"]==true ) {
		echo "Traffic-limit reached \n";
	}
	  
	echo "Links followed: ".$report["links_followed"]."\n";
	echo "Files received: ".$report["files_received"]."\n";
	echo "Bytes received: ".$report["bytes_received"]."\n";

    return 0;
}

main( intVal($argc),$argv );
?>