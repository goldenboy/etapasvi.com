<?php

class UserPeer extends BaseUserPeer
{
	// языки
	static protected $cultures = array( 
	
		'en' => array('name'    			 => 'en - English',
		              'iso'     			 => 'en',
		              //http://us2.admin.mailchimp.com/lists/settings/?id=428077
		              //'mail_id' 			 => '39719cc12b',
		              // категория Disqus
		              'comments_category_id' => 668704,
		              // язык интерфейса FeedBurner
		              'feedburner_loc' 		 => 'en_US'
		),		              
		'ru' => array('name'    			 => 'ru - Русский',
		              'iso'     			 => 'ru',		              
		              //'mail_id' 			 => '25b1a7f858',
		              'comments_category_id' => 686465,
		              'feedburner_loc' 		 => 'ru_RU'
		),
		'cs' => array('name'    			 => 'cz - Čeština',
		              'iso'     			 => 'cz',
		              //'mail_id' 			 => '876c7e23a7',
		              'comments_category_id' => 686584,
		              'feedburner_loc' 		 => ''
		),
		'hu' => array('name'    			 => 'hu - Magyar',
		              'iso'     			 => 'hu',
		              //'mail_id' 			 => 'e8a86fd73d',
		              'comments_category_id' => 686585,
		              'feedburner_loc' 		 => ''
		),
		'pl' => array('name'    			 => 'pl - Polski',
		              'iso'     			 => 'pl',
		              //'mail_id' 			 => '99862a8230',
		              'comments_category_id' => 686580,
		              'feedburner_loc' 		 => ''
		),
		'fr' => array('name'    			 => 'fr - Français',
		              'iso'     			 => 'fr',
		              //'mail_id' 			 => '430d7d6d8b',
		              'comments_category_id' => 686581,
		              'feedburner_loc' 		 => 'fr_FR'
		),
		// Mandarin Chinese (Simplified script) - упрошённый китайский
		'zh_CN'  => array(
					  'name'          		 => 'zh-cn - 简体中文',
		              'iso'           		 => 'zh-cn',
		              'hieroglyphic'  		 => true,
		              //'mail_id' 	  		 => '33bb475372',
		              'comments_category_id' => 686582,
		              'feedburner_loc' 		 => ''
		),
		'vi' => array('name'    			 => 'vn - Tiếng Việt',
		              'iso'     			 => 'vn',
		              //'mail_id' 			 => '68f2a2996d',
		              'comments_category_id' => 686583,
		              'feedburner_loc' 		 => ''
		),       
		'ja' => array('name'    			 => 'jp - 日本語',
		              'iso'     			 => 'jp',
		              'hieroglyphic'  		 => true,
		              //'mail_id' 			 => '77a5eb7cd2',
		              'comments_category_id' => 686578,
		              'feedburner_loc' 		 => 'ja_JP'
		),
		'es' => array('name'    			 => 'es - Español',
		              'iso'     			 => 'es',
		              //'mail_id' 			 => '6f9b50c196',
		              'comments_category_id' => 686579,
		              'feedburner_loc' 		 => 'es_ES'
		),
		'it' => array('name'    			 => 'it - Italiano',
		              'iso'     			 => 'it',
		              //'mail_id' 			 => 'ddd87d0746',
		              'comments_category_id' => 686577,
		              'feedburner_loc' 		 => ''
		)
/*		              
		'de' => array('name'    => 'de - Deutsch',
		              'iso'     => 'de'),			              

		'sk' => array('name'    => 'sk - Slovenčina',
		              'iso'     => 'sk'),	

		'uk' => array('name'    => 'ua - Українська',
		              'iso'     => 'ua'),*/
	);
	
	 
	//const DEFAULT_CULTURE = 'en';
	
	// доменное имя, которое используется по умолчанию вне приложения
	const DOMAIN_NAME_MAIN   		 = 'www.etapasvi.com';
	// список доменных имён
	public static $domain_name_list  = array('www.etapasvi.com', 'm.etapasvi.com');
	
	//const SITE_NAME       = 'eTapasvi';
	//const SITE_PROTOCOL   = 'http';
		
	// имена cookie
	//const REMEMBER_ME_COOKIE = 'sdfgjlk';
	//const CULTURE_COOKIE	 = '307c73fdf6de7';
	
	// указатели что добавляем при добавления комментариев
	// Не делать нулевыми, т.к. идёт проверка
	/*const FROM_IDEA 			= 1; // добавляем идею
	const FROM_IDEA_COMMENT 	= 2; // комментарий к идее
	const FROM_IDEA_VOTE		= 3; // голос к идее
	const FROM_IDEA_ABUSE		= 4; // жалоба на идею
	const FROM_NEWS_COMMENT		= 5; // комментарий к новости
	const FROM_PHOTO_COMMENT	= 6; // комментарий к фото
	const FROM_VIDEO_COMMENT	= 7; // комментарий к видео*/
	
	//const ADMIN_MAIL 	   = 'saynt2day@gmail.com';
	//const ADMIN_NAME 	   = 'eTapasvi';
	
	// PHPBB
	//const PHPBB_SECRET = 'f6de7e7537acc69fc9072bef307c73fdf6de7e7537acc69fc9072bef307c73fdf6de7e7537acc69fc9072bef307c73fdf6de7e7537acc69fc9072bef307c73fdf6de7e7537acc69fc9072bef307c73fdf6de7e7537acc69fc9072bef307c73fdf6de7e7537acc69fc9072bef307c73fdf6de7e7537acc69fc9072bef307c73fdf6de7e7537acc69fc9072bef307c73fdf6de7e7537acc69fc9072bef307c73fd';	
	//const USER_ADD_URL = 'http://www.etapasvi.com/forum/phpbb_user.php';
	
		
	/**
	 * Вся информация о языках
	 *
	 * @return unknown
	 */
	public static function getCulturesData()
	{
		return self::$cultures;
	}	
	
	/**
	 * Список языков
	 *
	 * @return unknown
	 */
	public static function getCultures()
	{
		return array_keys( self::$cultures );
	}
	
	/**
	 * Названия языков
	 *
	 * @return unknown
	 */
	public static function getCultureNames()
	{
	    $result = array();
	    foreach (self::$cultures as $culture => $culture_data) {
	       $result[$culture] = $culture_data['name'];	        
	    }	    
		return $result;
	}
	
	/**
	 * ISO-код языка
	 *
	 * @param unknown_type $culture
	 * @return unknown
	 */
	public static function getCultureIso( $culture )
	{
		return self::$cultures[ $culture ][ 'iso' ];
	}	
	
	/**
	 * Основная часть языка.
	 * Для zh_CN вернёт zh
	 *
	 * @param unknown_type $culture
	 * @return unknown
	 */
	public static function getCultureMain( $culture )
	{
		return substr( sfContext::getInstance()->getUser()->getCulture(), 0, 2 );
	}	
	
	/**
	 * Название языка
	 *
	 * @param unknown_type $culture
	 * @return unknown
	 */
	public static function getCultureName( $culture )
	{
		return self::$cultures[ $culture ][ 'name' ];
	}
	
	/**
	 * Название языка
	 *
	 * @param unknown_type $culture
	 * @return unknown
	 */
	public static function getCultureMailId( $culture = '' )
	{
		if (!$culture) {
			$culture = sfContext::getInstance()->getUser()->getCulture();
		}
		return self::$cultures[ $culture ][ 'mail_id' ];
	}
	
	/**
	 * Категория для системы комментирования
	 *
	 * @param unknown_type $culture
	 * @return unknown
	 */
	public static function getCultureCommentsCategoryId( $culture = '' )
	{
		if (!$culture) {
			$culture = sfContext::getInstance()->getUser()->getCulture();
		}
		return self::$cultures[ $culture ][ 'comments_category_id' ];
	}
	
	/**
	 * Получение языка интерфейса FeedBurner для языка
	 *
	 * @param unknown_type $culture
	 * @return unknown
	 */
	public static function getCultureFeedburderLoc( $culture = '' )
	{
		if (!$culture) {
			$culture = sfContext::getInstance()->getUser()->getCulture();
		}
		$loc = self::$cultures[ $culture ][ 'feedburner_loc' ];
		if (!$loc) {
			$loc = self::$cultures[ sfConfig::get('sf_default_culture') ][ 'feedburner_loc' ];
		}
		return $loc;
	}
	
	/**
	 * Используются ли в языке иероглифы
	 *
	 * @param unknown_type $culture
	 * @return unknown
	 */
	public static function isCultureHieroglyphic( $culture = '' )
	{
	    if (!$culture) {
	        $culture = sfContext::getInstance()->getUser()->getCulture();
	    }
	    if (!empty(self::$cultures[ $culture ][ 'hieroglyphic' ])) {
			return (bool)self::$cultures[ $culture ][ 'hieroglyphic' ];
	    } else {
	    	return false;
	    }
	}
	
	/**
	 * Проверка, является ли страница главной
	 *
	 * @param string $url адрес для проверки
	 * @return unknown
	 */
	public static function isHomePage( $url = '' )
	{
	    if (!$url) {
	        $url = sfContext::getInstance()->getRequest()->getUri();
	    }
	    // если в адресе только 2 слэша, значит мы на главной
	    $parse_url = parse_url($url);
	    if ( in_array( str_replace('/' , '', $parse_url['path']), UserPeer::getCultures()) ) {
	        return true;
	    } else {
	        return false;
	    }
	}
	
	/**
	 * Переключение адреса на мобильную версию и обратно
	 *
	 * @param string $url адрес
	 * @return string
	 */
	public static function switchUrlMobile( $url = '' )
	{
	    if (!$url) {
	        $url = sfContext::getInstance()->getRequest()->getUri();
	    }

	    if (strstr($url, sfConfig::get('app_domain_name_full'))) {
	        // переключаем на мобильную версию
	        $result_url = str_replace(sfConfig::get('app_domain_name_full'), sfConfig::get('app_domain_name_mobile'), $url);
	    } else {
	        // переключение на полную версию
	        $result_url = str_replace(sfConfig::get('app_domain_name_mobile'), sfConfig::get('app_domain_name_full'), $url);
	    }
	    return $result_url;
	}
		
	
//	/**
//	 * Проверка и авторизация пользователя
//	 * Не делаем static, чтобы можно было устанавливать куки
//	 */
//	public function authLogin( $name, $password, $remember_me = false ) {
//  		
//  		$c = new Criteria();
//  		
//  		$c->add( UserPeer::NAME, trim($name) );
//  		$c->add( UserPeer::PASSWORD, sha1(md5(trim($password))) );
//  		$c->add( UserPeer::IS_ACTIVE, 1 );
//  		$user_records = UserPeer::doSelect($c);
//  		
//  		if ( count($user_records) == 1 ) {
//  			// успешный вход
//  			$user = $user_records[0];
//  			self::authCacheUser( $user );  			
//  		
//  			if ($remember_me) {
//  				self::authSetCookies();
//  			}
//  			// запоминаем время входа
//  			$user->saveLastLogin();
//  			// вход в PHPBB
//  			//$user->phpbbLogin();
//  			return true;
//  		} else {
//  			self::authUnsetCookies();	  			
//  			return false;  			
//  		}  	
//	}
//	
//	/**
//	 * Сохранение пользователя
//	 *
//	 * @param unknown_type $user
//	 */
//	public function authCacheUser( $user ) {		
//		unset($_SESSION['user_cached']);			
//  		$_SESSION['user_cached'] = $user;
//	}
//	
//	/**
//	 * Авторизуем пользователя
//	 */
//	public function authForcedLogin( $user, $remember_me ) {		
//  		if ( $user->getId() ) {  			  			
//  			self::authCacheUser( $user ); 
//  			if ($remember_me) {
//  				self::authSetCookies();
//  			}
//  			// запоминаем время входа
//  			//$user = UserPeer::retrieveByPk( $user_id );
//  			//if ($user) {
//  			$user->saveLastLogin();
//  			// вход в PHPBB
//  			//$user->phpbbLogin();
//  			//}
//  		}
//	}	
//	
//	/**
//	 * Проверка, авторизован ли пользователь
//	 *
//	 * @return unknown
//	 */
//	public static function authIsLoggedIn() {
//  		// проверка Remember me
//  		if ( ( !self::authUserId() ) 
//  		     && isset($_COOKIE[self::REMEMBER_ME_COOKIE]) && $_COOKIE[self::REMEMBER_ME_COOKIE] != '') 
//  		{
//	  		$c = new Criteria();
//	  		$c->add( UserPeer::REMEMBER_ME_CODE, $_COOKIE[self::REMEMBER_ME_COOKIE] );
//	  		$c->add( UserPeer::IS_ACTIVE, 1 );
//	  		$user_records = UserPeer::doSelect($c);
//	  		
//	  		if ( count($user_records) == 1 ) {
//	  			
//	  			self::authCacheUser( $user_records[0] ); 
//	  			
//	  			// переход на язык, сохранённый в cookie только если открыли морду
//	  			/*$culture = substr($_SERVER['REQUEST_URI'], 1, 2);
//	  			if ( in_array($_COOKIE[self::CULTURE_COOKIE], array('en', 'ru')) 
//	  			     && $culture != $_COOKIE[self::CULTURE_COOKIE] ) 
//	  			{
//	  				$uri 	= $_SERVER['REQUEST_URI'];
//					$params = str_replace( array('/ru','/ru/', '/en', '/en/'), '', $uri);
//					//$this->redirect( '/' . $_COOKIE[self::CULTURE_COOKIE] . $params);
//					header( 'Location: http://' . $_SERVER['SERVER_NAME'] . '/' . $_COOKIE[self::CULTURE_COOKIE] . $params  );
//	  				exit();
//	  			}*/
//	  			
//	  			// отключён 2010.08.27, т.к. при если язык URL отличался от языка пользователя
//	  			// при открытии http://www.etapasvi.com/en/news/show/id/49 кидало на главную на языке пользователя
//	  			/*  			
//	  			$uri 	 = $_SERVER['REQUEST_URI'];
//	  			$culture = substr($uri, 1, 2);
//	  			
//	  			if ( $_SERVER['PATH_INFO'] < 4 && !empty($_COOKIE[self::CULTURE_COOKIE]) && $culture != $_COOKIE[self::CULTURE_COOKIE] ) {
//					header( 'Location: http://' . $_SERVER['SERVER_NAME'] . '/' . $_COOKIE[self::CULTURE_COOKIE] );
//	  				exit();	  				
//	  			}*/
//	  		} else {
//	  			self::authUnsetCookies();
//	  		}
//  		}  		
//  		return self::authUserId();  		
//	}
//	
//	/**
//	 * Получение ID пользователя
//	 *
//	 * @return unknown
//	 */
//	public static function authUserId() {
//		if ( !empty($_SESSION['user_cached']) ) {
//			return $_SESSION['user_cached']->getId();
//		} else {
//  			return '';
//		}
//	}	
//	
//	/**
//	 * Получение логина пользователя
//	 *
//	 * @return unknown
//	 */
//	public static function authUserName() {
//		$user = self::authGetUser();
//		if ($user) {
//			return $user->getName();
//		}
//		return '';
//	}	
//	
//	/**
//	 * Получение текущего пользователя
//	 *
//	 * @return unknown
//	 */
//	public static function authGetUser() {	  		
//  		return $_SESSION['user_cached'];
//	}		
//	
//	/**
//	 * Выход
//	 *
//	 */
//	public static function authLogout() {
//		self::authUnsetCookies();
//		session_unset();
//		@session_destroy();
//		@session_start();
//		$_SESSION = array();
//		session_commit();		
//	}
//	
//	/**
//	 * Установка кук посла авторизации
//	 *
//	 */
//	public static function authSetCookies() {
//
//		$remember_me_code = md5( time() );
//
//  		$c = new Criteria();
//  		$c->add( UserPeer::ID, self::authUserId() );
//  		$c->add( UserPeer::IS_ACTIVE, 1 );
//  		$user_records = UserPeer::doSelect($c);
//
//  		if (count($user_records)) {
//  			$user = $user_records[0];
//  			$user->setRememberMeCode( $remember_me_code );
//  			$user->save();  			
//  			// remember me
//  			setcookie( self::REMEMBER_ME_COOKIE, $remember_me_code, time() + 3600 * 24 * 365, '/' );  			
//  			// язык
//  			setcookie( self::CULTURE_COOKIE, sfContext::getInstance()->getUser()->getCulture(), time() + 3600 * 24 * 365, '/' );
//  		}
//	}
//	
//	/**
//	 * Удаление кук
//	 *
//	 */
//	public static function authUnsetCookies() {
//  		setcookie( self::REMEMBER_ME_COOKIE, "", time() - 3600, '/');
//  		setcookie( self::CULTURE_COOKIE, "", time() - 3600, '/');  		
//	}		
//	
//	/**
//	 * Валидация e-mail
//	 *
//	 * @param unknown_type $email
//	 * @return unknown
//	 */
//	public static function validateEmail($email)
//	{
//	   $isValid = true;
//	   $atIndex = strrpos($email, "@");
//	   if (is_bool($atIndex) && !$atIndex)
//	   {
//	      $isValid = false;
//	   }
//	   else
//	   {
//	      $domain = substr($email, $atIndex+1);
//	      $local = substr($email, 0, $atIndex);
//	      $localLen = strlen($local);
//	      $domainLen = strlen($domain);
//	      if ($localLen < 1 || $localLen > 64)
//	      {
//	         // local part length exceeded
//	         $isValid = false;
//	      }
//	      else if ($domainLen < 1 || $domainLen > 255)
//	      {
//	         // domain part length exceeded
//	         $isValid = false;
//	      }
//	      else if ($local[0] == '.' || $local[$localLen-1] == '.')
//	      {
//	         // local part starts or ends with '.'
//	         $isValid = false;
//	      }
//	      else if (preg_match('/\\.\\./', $local))
//	      {
//	         // local part has two consecutive dots
//	         $isValid = false;
//	      }
//	      else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
//	      {
//	         // character not valid in domain part
//	         $isValid = false;
//	      }
//	      else if (preg_match('/\\.\\./', $domain))
//	      {
//	         // domain part has two consecutive dots
//	         $isValid = false;
//	      }
//	      else if(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',
//	                 str_replace("\\\\","",$local)))
//	      {
//	         // character not valid in local part unless 
//	         // local part is quoted
//	         if (!preg_match('/^"(\\\\"|[^"])+"$/',
//	             str_replace("\\\\","",$local)))
//	         {
//	            $isValid = false;
//	         }
//	      }
//	      if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A")))
//	      {
//	         // domain not found in DNS
//	         $isValid = false;
//	      }
//	   }
//	   return $isValid;
//	}			

	/**
	 * Отправка уведомления администратору
	 *
	 * @param unknown_type $msg
	 * @param unknown_type $subject
	 */
	public static function adminNotify( $msg, $subject = 'mailer' ) 
	{			
		mail(sfConfig::get('app_admin_email'), $subject . ' (' . sfConfig::get('app_domain_name') . ')', $msg );	
	}
	
	/*
	public static function getUserPhpbbUrl( $user_phpbb_id ) {	
		return 'http://' . $_SERVER['SERVER_NAME'] . '/forum/memberlist.php?mode=viewprofile&u=' 
				. $user_phpbb_id . '&lang=' . sfContext::getInstance()->getUser()->getCulture();
	}*/

//	/**
//	 * Получение администратора
//	 *
//	 * @return unknown
//	 */
//	public static function getAdminUser()
//	{
//		$c = new Criteria();
//		$c->add(UserPeer::NAME, UserPeer::ADMIN_NAME);
//		return UserPeer::doSelectOne($c);
//	}
//	
//	/**
//	 * Проверка e-mail на уникальность
//	 *
//	 * @param unknown_type $email
//	 * @return unknown
//	 */
//	public static function isEmailUnique($email) {
//  		$c = new Criteria();
//  		$c->add(UserPeer::EMAIL, $email);
//  		$c->add(UserPeer::ID, self::authUserId(), Criteria::NOT_EQUAL);
//  		if (UserPeer::doCount($c)) {
//  			return false;
//  		} else {
//  			return true;
//  		}
//	}
	
	/**
	 * Управление кэшированием
	 *
	 * @param unknown_type $email
	 * @return unknown
	 */
	/*
	public static function cacheControl() {
  		if (UserPeer::authIsLoggedIn()) {
			// если пользователь авторизован, не кэшируем страницы
			//header('Cache-Control: no-cache, must-revalidate');
			//header('Pragma: no-cache');
		    header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' );
	        header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
	        header( 'Cache-Control: no-store, no-cache, must-revalidate' );
	        header( 'Cache-Control: post-check=0, pre-check=0', false );
	        header( 'Pragma: no-cache' );
			echo 123;
		} else {
			// для неавторизованных - кэшируем
			$cache_time = 60*60*24;
			header('Expires: ' . gmdate('D, d M Y H:i:s', time()+$cache_time) . ' GMT');
			header('Cache-Control:max-age=' . $cache_time . ', must-revalidate');
			header('Last-Modified: ' . gmdate("D, d M Y H:i:s", time()-60) . ' GMT');
			//exit();
		}
	}*/
}
