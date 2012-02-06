<?php

class MailPeer extends BaseMailPeer
{
	// отправка почты
	const MAIL_ADDRESS     = 'info@etapasvi.com';
	//const MAIL_USERNAME    = 'etapasvi@gmail.com'; // Gmail
	const MAIL_USERNAME    = 'admin@etapasvi.com'; // Gmail
	//const MAIL_PASSWORD    = ''; //Gmail
	const MAIL_PASSWORD    = '?q63bSXV'; 
	//const MAIL_SMTP_HOST   = 'smtp.gmail.com'; // Gmail
	const MAIL_SMTP_HOST   = 'mail.etapasvi.com'; // Gmail
	//const MAIL_SMTP_PORT   = 465; // Gmail
	const MAIL_SMTP_PORT   = 25; // Gmail	
	//const MAIL_SSL   	   = true; // Gmail	
	const MAIL_SSL   	   = false;
	
	// Типы отправщиков
	// http://swiftmailer.org/docs/transport-types
	const MAILER_TYPE_SMTP 		= 'SMTP';
	const MAILER_TYPE_SENDMAIL  = 'SENDMAIL';
	const MAILER_TYPE_MAIL      = 'MAIL';
	
	// команда для запуска sendmail
	//const SENDMAIL_COMMAND      = '/usr/sbin/sendmail -bs';
	
	static protected $mail_cultures = array( 'en', 'ru' );
	
	/**
	 * Языки, на которых имеются письма-уведомления
	 *
	 * @return unknown
	 */
	public static function getMailCultures()
	{
		return self::$mail_cultures;
	}
	
	/**
	 * Отправка письма
	 *
	 * @param unknown_type $message
	 * @param unknown_type $subject
	 * @param unknown_type $mailTo
	 * @return unknown
	 */
	public static function sendEmail($message, $subject, $to) {
		$result = true;		
		
		// Соединение с Gmail
		$mailer = self::getMailer( self::MAILER_TYPE_SENDMAIL );
		if ($mailer) {		
			// Отправка		
			$result = self::mailerSend($mailer, $message, $subject, $to);
		    self::mailerDisconnect($mailer);
		}  		    
				
		return $result;
	}
	
	/**
	 * Получение объекта для отправки почты
	 *
	 * @return unknown
	 */
	public static function getMailer($type = self::MAILER_TYPE_SMTP) {		
		$mailer = null;
		
		switch ($type) {
			case self::MAILER_TYPE_SMTP:
				try
				{
					// Соединение с почтовым сервером
					if (self::MAIL_SSL) {
						$connection = new Swift_Connection_SMTP(self::MAIL_SMTP_HOST, self::MAIL_SMTP_PORT, Swift_Connection_SMTP::ENC_SSL);
					} else {
						$connection = new Swift_Connection_SMTP(self::MAIL_SMTP_HOST, self::MAIL_SMTP_PORT);
					}
					
					$connection->setUsername(self::MAIL_USERNAME);
					$connection->setPassword(self::MAIL_PASSWORD);									 					   
				} catch (Exception $e) {
					UserPeer::adminNotify('Error connecting to' . self::MAIL_SMTP_HOST . ' , Exception: ' . $e->getMessage());			
				}
				break;
				
			case self::MAILER_TYPE_MAIL:
				
				break;
				
			case self::MAILER_TYPE_SENDMAIL:
				$connection = new Swift_Connection_Sendmail();
				break;
		}
		
		if ($connection) {
			try {
				$mailer = new Swift($connection);
			} catch (Exception $e) {
				UserPeer::adminNotify('Error creating Swift from connection: ' . $e->getMessage());
			}
		}
		
		return $mailer;
	}	
	
	/**
	 * Отправка письма
	 *
	 * @param unknown_type $mailer
	 * @param unknown_type $message
	 * @param unknown_type $subject
	 * @param unknown_type $mailTo
	 * @return unknown
	 */
	public static function mailerSend( $mailer, $message, $subject, $to ) 
	{
		
	    $swift_message = new Swift_Message($subject, $message, 'text/html');	    
	    
	    try
		{
	    	$result = $mailer->send($swift_message, $to, self::MAIL_ADDRESS);
		}	    	
	    catch (Exception $e)
		{
			UserPeer::adminNotify('Error sending to ' . $to . ', subject: ' . $subject . ', Exception: ' . $e->getMessage());
			$result = false;
		}		

//		$headers  = 'MIME-Version: 1.0' . "\r\n";
//		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
//		
//		$headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
//		$headers .= 'From: ' . UserPeer::SITE_NAME . ' <' . self::MAIL_ADDRESS  . '>' . "\r\n";
//		
//		$result = mail($to, $subject, $message, $headers);


		return $result;
	}
	
	/**
	 * Отключение от почтового сервера
	 *
	 * @param unknown_type $mailer
	 */
	public static function mailerDisconnect($mailer) 
	{	
		//return true;	
		try
		{
		  $mailer->disconnect();
		}
		catch (Exception $e) {
			UserPeer::adminNotify('Error disconnecting' . ', Exception: ' . $e->getMessage());
		}
	}
	
	/**
	* Проверка есть ли контент на определённом языке
	*
	* @param unknown_type $item_id
	* @param unknown_type $item_lang
	*/
	public static function hasCultureContent($item_id, $item_lang)
	{
		$c = new Criteria();
		$c->add( MailPeer::ID, $item_id );
		$c->addJoin( MailPeer::ID, MailI18nPeer::ID );
		$c->add( MailI18nPeer::CULTURE, $item_lang );    
		
		self::addVisibleCriteria( $c );
		
		$count = MailPeer::doCount($c);
		
		if ($count) {
		  return true;
		} else {
		  return false;
		}
	}
	
	/**
	* Добавляет условие, при котором элемент отображается на языке пользователя
	*
	* @param unknown_type $c
	*/
	public static function addVisibleCriteria($c)
	{  
		$c->add( MailPeer::SHOW, 1 );    
		$c->add( MailI18nPeer::BODY, '', Criteria::NOT_EQUAL );    
	}
}
