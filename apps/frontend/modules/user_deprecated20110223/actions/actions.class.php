<?php

/**
 * user actions.
 *
 * @package    sf_sandbox
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */

class userActions extends sfActions
{

  public function executeSignup(sfWebRequest $request)
  {
  	if (UserPeer::authIsLoggedIn()) {
  		$this->redirect('@main');
  	}  	
  	
    $this->form = new UserForm();

	if ($request->isMethod('post') && $this->signupProcess($request)) {		
		$this->redirect('user/signedup');
	}
	// генерим капчу
    $g = new Captcha();
	$this->getUser()->setAttribute('captcha', $g->generate());	
  }

  public function executeSignedup(sfWebRequest $request)
  {
  	$this->user_name = UserPeer::authUserName();
  }

  public function executeLogin(sfWebRequest $request)
  {
  	if (UserPeer::authIsLoggedIn()) {
  		$this->redirect('@main');
  	}
	if ( $this->loginProcess($request) ) {
		if ($_POST['from']) {
			$this->redirect($_POST['from']);
		} else {
			$this->redirect('@main');
		}
	}
	$this->from = $request->getParameter('from'); 
  }
  protected function loginProcess(sfWebRequest $request)
  {
  	$this->error_name 		= '';
  	$this->error_password 	= '';
  	$this->error_login 		= '';
  	  	
  	if ( !$request->isMethod('post') || empty($_POST['submit_login'])) {
  	 	return false;
  	}
  	
	if ( $_POST['name'] == '' ) {
		$this->error_name = 1;
	}
	if ( $_POST['password'] == '' ) {
		$this->error_password = 1;
	}	  
	if ( !$this->error_name && !$this->error_password ) {
	  if ( UserPeer::authLogin($_POST['name'], $_POST['password'], $_POST['remember_me']) ) {
		return true;
	  } else {
		$this->error_login = 1;
	  }
	}
	$_POST['name'] = str_replace('"', '&quot;', $_POST['name']);
	return false;
  }
  
  public function executeLogout(sfWebRequest $request)
  {
    UserPeer::authLogout();

    //if (!empty($_SERVER['HTTP_REFERER'])) {
    //  $this->redirect($_SERVER['HTTP_REFERER']);
    //} else {
      $this->redirect('@main');
    //}
  }
  
  public function executeLoginorsignup(sfWebRequest $request)
  {  	  	
  	if (UserPeer::authIsLoggedIn()) {
  		$this->redirect('@main');
  	}  	
  	
  	$this->error_retype_password = 0;
  	$this->error_email			 = 0;
  	$this->error_dublicate_email = 0;
  	$this->error_captcha		 = 0;
  	
  	// body id
  	if ( $request->getParameter('from') ) {
    	$this->from = $request->getParameter('from');   
  	} elseif (!empty($_SESSION['loginorsignup_body_from'])) {
  		$this->from = $_SESSION['loginorsignup_body_from'];
  	} else {
  		$this->from = '';
  	}
	$this->form = new UserForm();		
    
	if ( $this->loginProcess($request) || $this->signupProcess($request) ) {		
	  $comment_result = false;
	  // проверка переданных значений
	  $post = unserialize($_SESSION['loginorsignup_post']);
	  		
	  if ( $_SESSION['loginorsignup_from'] == '' ) {
	  	if ($_SESSION['loginorsignup_from_location'] != '') {
	  		$this->redirect('Location: ' . $_SESSION['loginorsignup_from_location']);
	  		return sfView::NONE;	  		
	  	} else {
	  		$this->redirect('@user_member');
	  	}
	  	return sfView::NONE;
	  }
	  
	  // постинг
	  $comment_result = CommentsPeer::addComment( $post['body'], $_SESSION['loginorsignup_from'], $_SESSION['loginorsignup_id'] );	 
	  
	  // очистка сессии
	  $_SESSION['loginorsignup_post'] 			= '';
	  $_SESSION['loginorsignup_from'] 			= '';
	  $_SESSION['loginorsignup_id'] 			= '';
	  $location = $_SESSION['loginorsignup_from_location'];
	  $_SESSION['loginorsignup_from_location'] 	= '';

	  if ($comment_result) {
	  	$this->redirect($location);
	  } else {
	  	$this->redirect('@main');
	  }	  	 		 
	  return sfView::NONE;
	}	
	
	// генерим капчу
    $g = new Captcha();
	$this->getUser()->setAttribute('captcha', $g->generate());
  }
    
  protected function signupProcess(sfWebRequest $request)
  {  
  	$parameters = $request->getParameter($this->form->getName());
  		
  	if (!$request->isMethod('post') || empty($parameters['name'])) {	
  		return false;
  	}  
  	
  	// убираем из логин посторонние символы
  	$parameters['name'] = preg_replace("/[^\w]/", "", $parameters['name']);
  	
    // форма регистрации    
	$this->form->bind( $parameters );
	// устанавливаем выбранный Часовой пояс
	//$this->form->getObject()->setTimezoneId( $request->getParameter('user[timezone_id]') );
    
    
    // запоминаем Подтверждени пароля, чтобы отобразить
    $this->retype_password = $request->getParameter('retype_password');
	
    $isValid 		= $this->form->isValid();
    $customErrors 	= $this->customIsValidForm($request);

    if ( $isValid && $customErrors ) {
    	
      $user = $this->form->save();
      
      if (!$user) {
      	return false;
      }
      // активируем пользователя
      $user->setIsActive( true );
      // шифруем пароль
      $user->setPasswordEncoded( $user->getPassword() );
      // дата регистрации
      $user->setCreatedAt( gmdate("Y-m-d H:i:s") );
      // IP
      $user->setIp( $_SERVER['REMOTE_ADDR'] );
      // Язык
      $user->setLang( $this->getUser()->getCulture() );    
      // Подписки 
      $user->setSubscribeNews( true );    
      $user->setSubscribePhoto( true );    
      $user->setSubscribeVideo( true );    
      
      /*
      Отключено, 20101128
      // рагистрация пользователя на форуме
		  // получаем timezone
//		  $timezone = TimezonePeer::retrieveByPk( $user->getTimeZoneId() );
//		  if ($timezone) {
//		  	$timezone_value = $timezone->getValue();
//		  } else {
		    $timezone_value = 0;
		  //}
			
		  $query_string =  UserPeer::USER_ADD_URL.'?action=add&username=' . $user->getName() . '&user_password=' . $request->getParameter( 'user[password]' ) 
							. '&user_lang=' . $this->getUser()->getCulture() . '&user_email=' . $user->getEmail() 
							. '&user_timezone=' . $timezone_value . '&secret=' . UserPeer::PHPBB_SECRET;
		  
		  $ch = curl_init();
		  curl_setopt($ch, CURLOPT_URL, $query_string);
		  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		  
		  //curl_setopt($ch, CURLOPT_HEADER, true);
		  //curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.1.5) Gecko/20091102 Firefox/3.5.5' );
		  //curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate' );
		  
		  $add_result = curl_exec($ch);	  
		  curl_close($ch);     
		  
		  // запоминаем PHPBB id
		  //$phpbb_id = $this->procAddResult( $add_result );
		  $phpbb_id = (int)$add_result;
		  $user->setPhpbbId( $phpbb_id );
		  
		  
//		   логинем в PHPBB
//		  $sessionId = $this->random() . $this->random();
//		  $sessionId = substr($sessionId, 0, 32); // Just in case
//		  $sessionKey = $this->random();
//		  $phpbbCookieName = ConfigPeer::getCookieName();
//		
//		  $this->insertDbSession($sessionId, $sessionKey, $user);
//		  $this->setCookies($phpbbCookieName, $sessionId, $sessionKey, $user);
		  */
      
	  // сохраняем пользователя
	  $user->save();
	  
	  // автризуем пользователя
      UserPeer::authForcedLogin($user, true);
    
      // отправка e-mail уведомления о регистрации
      $user_culture = $this->getUser()->getCulture();
      if ( !in_array($user_culture, MailPeer::getMailCultures()) ) {
      	$user_culture = UserPeer::DEFAULT_CULTURE;
      }
	  $componentNameBody 		= 'signupnotify' . $user_culture;
	  $componentNameSubject 	= 'signupnotifySubject' . $user_culture;
	  
	  $mailBody 	= $this->getComponent(
	    'mail', $componentNameBody, 
	  	array('name' => $user->getName(), 'login' => $user->getName(), 'password' => $request->getParameter('user[password]') )
	  );
	  $mailSubject 	= $this->getComponent('mail', $componentNameSubject);
	  
	  $sendResult 	= MailPeer::sendEmail($mailBody,
								      	  $mailSubject,
								      	  $user->getEmail() );	      
	  /*if ($sendResult) {
	    $this->logMessage('Signup notification sent to ' . $user->getEmail(), 'debug');
	  } else {
	  	$this->logMessage('Error occured sending signup notification to ' . $user->getEmail(), 'debug');
	  }*/	  
      return true;
    }    
    return false;
  }
  
  protected function customIsValidForm(sfWebRequest $request, $check_captcha = true)
  {
  	$result = true;
  	$this->error_retype_password = 0;
  	$this->error_email			 = 0;
  	$this->error_dublicate_email = 0;
  	$this->error_captcha		 = 0;
  	  	
  	$params = $request->getParameter('user');

  	if ($params['password'] != '' && ($params['password'] != $_POST['retype_password'])) {
  		$this->error_retype_password = 1;
  		$result = false;
  	}
  	if ( !UserPeer::validateEmail($params['email']) ) {
  		$this->error_email = 1;
  		$result = false;
  	}
  	if ( $check_captcha && strtolower($request->getParameter('captcha')) != sfContext::getInstance()->getUser()->getAttribute('iData') ) {
  		$this->error_captcha = 1;
  		$result = false;
  	}  	
  	if (!UserPeer::isEmailUnique($params['email'])) {  		
  		$this->error_dublicate_email = 1;
  		$result = false;
  	}
  	
  	return $result;
  }
  public function executeProfile(sfWebRequest $request)
  {
  	if (!UserPeer::authIsLoggedIn()) {
  		$this->redirect('@user_login');
  	}  	    
    
    //$user = UserPeer::authGetUser();
    $user = UserPeer::retrieveByPk( UserPeer::authUserId() );
    if (!$user) {
    	$this->redirect('@user_login');
    }
    
    // получение подписок пользователя
    $this->subscription_news 	= SubscribePeer::getSubscriptions($user->getId(), ItemtypesPeer::ITEM_TYPE_NEWS );
    $this->subscription_photo 	= SubscribePeer::getSubscriptions($user->getId(), ItemtypesPeer::ITEM_TYPE_PHOTO );
    $this->subscription_video 	= SubscribePeer::getSubscriptions($user->getId(), ItemtypesPeer::ITEM_TYPE_VIDEO );    
	
	if ($request->isMethod('post') ) {

		if ($request->getParameter('submit_save')) {
			// сохранение профайла
			$params = $request->getParameter('user');						
			
			// чтобы не возникало ошибки Required для name при isValid()
			$form_params = $params;
			$form_params['name'] = $user->getName() . time();
			$form_params['password'] = 123;
			
			$this->form = new UserForm();
			$this->form->bind( $form_params );	
    		$this->retype_password = $request->getParameter('retype_password');

			if ($this->form->isValid() && $this->customIsValidForm($request, false)) {
				
				$email = trim($params['email']);
		
				if ($params['email'] != '') {
					$user->setEmail( $email );
				}
				$user->setProfile( $params['profile'] );
				$user->setSubscribeNews( $params['subscribe_news'] );
				$user->setSubscribePhoto( $params['subscribe_photo'] );
				$user->setSubscribeVideo( $params['subscribe_video'] );
													
				/*if ($params['timezone_id'] != '') {
					$user->setTimezoneId($params['timezone_id']);
				}*/			
				if ( in_array($params['lang'], UserPeer::getCultures() ) ) {
					$user->setLang( $params['lang'] );
				}			
				if ($params['password'] != '') {
					$user->setPasswordEncoded($params['password']);
				}
	
	
				$user->save();
				
				// обновляем пользователя в сессии
				UserPeer::authCacheUser( $user );
				
				$_SESSION['profile_result'] = 'ok';
				
				// обновляем профайл в PHPBB
				//$user->phpbbUpdateProfile( $params['password'], $email );	
				$this->redirect('user/profile');					
			} else {
				$form_params['name'] 	 = $user->getName();
				$form_params['password'] = '';
				
				$this->form = new UserForm();
				$this->form->bind( $form_params );
			}

		} elseif ($request->getParameter('submit_delete')) {
			// удаление профайла
			$user->setIsActive(0);
			$user->save();			
			UserPeer::authLogout();
			$this->redirect('@main');	
		} else {
			$user->setPassword( '' );
			$this->form = new UserForm($user);
		}
	} else {
		if ($_SESSION['profile_result'] == 'ok') {
			$this->result = 'ok';
			unset($_SESSION['profile_result']);
		}	
		$user->setPassword( '' );
		$this->form = new UserForm($user);
	}	

  }  
  
  /**
   * Показать идею пользователя
   *
   * @param sfWebRequest $request
   */
  public function executeShow(sfWebRequest $request)
  {  	
  	$this->forward404Unless( $request->getParameter('id') );  

    $c = new Criteria();
    $c->add( IdeaPeer::USER_ID, $request->getParameter('id') );
    $c->add( IdeaPeer::SHOW, 1);
    $c->addJoin( UserPeer::ID, IdeaPeer::USER_ID);
    $c->add( UserPeer::IS_ACTIVE, 1);    
    $this->idea = IdeaPeer::doSelectOne($c);  

    if ( $this->idea ) {
    	$this->redirect( 'idea/details?id=' . $this->idea->getId() );    	  
    } else {
    	// ищем пользователя
	    $c = new Criteria();
	    $c->add( UserPeer::ID, $request->getParameter('id') );
	    $c->add( UserPeer::IS_ACTIVE, 1);    
	    $this->user = UserPeer::doSelectOne($c);
	     	
	    $this->forward404Unless( $this->user );
	    $this->setTemplate( 'userwithoutidea' );	  
    }
      	  	      
  }
  
  /*
  public function procAddResult( $add_result )
  {
  	//  Пример ответа:
  	//
	//	HTTP/1.1 200 OK
	//	Date: Wed, 18 Nov 2009 22:49:54 GMT
	//	Server: Apache
	//	X-Powered-By: PHP/5.2.9
	//	Set-Cookie: phpbb3_nqoeg_u=1; expires=Thu, 18-Nov-2010 22:49:56 GMT; path=/; domain=.eTapasvi.com; HttpOnly
	//	Set-Cookie: phpbb3_nqoeg_k=; expires=Thu, 18-Nov-2010 22:49:56 GMT; path=/; domain=.eTapasvi.com; HttpOnly
	//	Set-Cookie: phpbb3_nqoeg_sid=2e7ea9c6a87aec30fe87ec7725b20aca; expires=Thu, 18-Nov-2010 22:49:56 GMT; path=/; domain=.eTapasvi.com; HttpOnly
	//	Set-Cookie: phpbb3_nqoeg_u=99; expires=Thu, 18-Nov-2010 22:49:56 GMT; path=/; domain=.eTapasvi.com; HttpOnly
	//	Set-Cookie: phpbb3_nqoeg_k=; expires=Thu, 18-Nov-2010 22:49:56 GMT; path=/; domain=.eTapasvi.com; HttpOnly
	//	Set-Cookie: phpbb3_nqoeg_sid=c7fe28b727a1cf6757d7d7195f7c15d0; expires=Thu, 18-Nov-2010 22:49:56 GMT; path=/; domain=.eTapasvi.com; HttpOnly
	//	Vary: Accept-Encoding
	//	Content-Length: 2
	//	Content-Type: text/html
	//	
	//	99  	  	
  	
  	// получаем куки
  	preg_match_all( '/Set-Cookie.*\\\\/', $add_result, $header_cookies );
  	
  	// почему-то в браузер выдаётся максимум 2 куки
	foreach ( $header_cookies[0] as $i=>$header_cookie) {
		if ($i == 3 || $i == 5) {
			header( $header_cookie );			
			//$cookie = str_replace( 'Set-Cookie: ', '', $header_cookie );
			//$this->getResponse()->setHttpHeader('Set-Cookie', $cookie);
		}
	}
	
	// получаем PHP id
	$header_lines = split("\n", $data);
	
	mail( 'saynt2day@gmail.com', 'etapasvi', print_r( $header_cookies, true ));	     
	return (int)$header_lines[ count($header_lines) - 1];
  }*/

  public function executeForgotpassword(sfWebRequest $request)
  {  	
  	if (UserPeer::authIsLoggedIn()) {
  		$this->redirect('@main');
  	}
  	  	
  	if ($request->getParameter('result') == 'ok') {
  		$this->result = 'ok';
  		return;  		
  	}
  	
  	$this->result = '';
  	$this->email = '';
  	
    if ( $request->isMethod('post') && $request->getParameter('submit_remind') != '' ) {		  	
    	$this->email = trim( $request->getParameter('remind_email') );
    	
    	// ищем пользователя по логину
    	
    	$c = new Criteria();
    	$c->add( UserPeer::EMAIL, $this->email );
    	$c->add( UserPeer::IS_ACTIVE, 1 );
    	$user = UserPeer::doSelectOne( $c );
    	
    	if ($user) {    
    		$remind_code = md5(time());
    		$user->setRemindCode( $remind_code );
    		$user->save();
			
			// отправка e-mail с кодом
		    $user_culture = $this->getUser()->getCulture();
		    if ( !in_array($user_culture, MailPeer::getMailCultures()) ) {
		      $user_culture = UserPeer::DEFAULT_CULTURE;
		    }			
			$componentNameBody 		= 'forgotpassword' . $user_culture;
			$componentNameSubject 	= 'forgotpasswordSubject' . $user_culture;
			
			$mailBody 	 = $this->getComponent( 'mail', 
											     $componentNameBody, 
												 array('remind_code' => $remind_code ) );
			$mailSubject = $this->getComponent('mail', $componentNameSubject);
			
			$sendResult  = MailPeer::sendEmail( $mailBody,
										      	$mailSubject,
										      	$user->getEmail() );
										      	  
    		$this->redirect('user/forgotpassword?result=ok');
    	} else {
    		$this->result = 'error';
    	}
    }      	  	      
  } 
  
  public function executeNewpassword(sfWebRequest $request)
  {   
  	if (UserPeer::authIsLoggedIn()) {
  		$this->redirect('@main');
  	}
  	
  	if ($request->getParameter('result') == 'ok') {
  		$this->result = 'ok';
  		return;  		
  	}
  	
  	$this->result = '';
  	
  	// если передан код ищем польователя по коду
  	if ( strlen($request->getParameter('remind_code')) == 32 ) {  	
  	  
	  $c = new Criteria();
	  $c->add( UserPeer::REMIND_CODE,  $request->getParameter('remind_code') );
	  $user = UserPeer::doSelectOne( $c );
		
	  if ($user) { 
	  	
	  	if ( $request->isMethod('post') && $request->getParameter('submit_new_password') != '' ) {	
	      // совпадают ли пароли
	  	  $password 		= $request->getParameter('new_password');
	      $password_confirm = $request->getParameter('new_password_confirm');
	  	  
	      if ($password != '' && $password != $password_confirm) {
	  	    $this->result = 'error';
	  	    return;
	  	  }
	  	  
	  	  // сохранение пароля
	  	  $user->setRemindCode('');
	  	  $user->setPasswordEncoded($password);
	  	  $user->save();
	  	  
	  	  // изменнение пароля в PHPBB
	  	  //$user->phpbbUpdateProfile( $password, '' );
	  	  
	  	  $this->redirect('user/newpassword?result=ok');
	  	}		
	  		
	  } else {
		$this->redirect('@main');
	  }
  	} else {
  	  $this->redirect('@main');
  	}
  } 
  
  public function executeMember(sfWebRequest $request)
  {   
  	if (!UserPeer::authIsLoggedIn()) {
  		$this->redirect('@loginorsignup');
  	}
  	
  	
  }
  
  /*
  public function executeChecklogin(sfWebRequest $request)
  {
  	$user_name = $request->getParameter('user_name');
  	$response = $this->getResponse();
  	
  	if ( !$request->isMethod('post') || empty($user_name) ) {
      $response->setContent( '{"busy":"1"}' ); 	
  	} else {	  	
	  $c = new Criteria();
	  $c->add(UserPeer::NAME, $user_name);
	  if (UserPeer::doSelectOne($c)) {
	    $response->setContent( '{"busy":"1"}' ); 		   		
	  } else {
	  	$response->setContent( '{"busy":"0"}' ); 
	  }
  	}

	return sfView::NONE;  	
  } */
}