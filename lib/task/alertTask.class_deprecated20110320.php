<?php
/**
 * Отправка писем-уведомлений.
 * У Gmail ограничение в 100 писем за подключение (http://forums.formtools.org/showthread.php?tid=129)
 * За отправку на несуществующие e-mails Gmail может заблокировать аккаунт на 24-48 часов.
 * Ограничения Gmail: 
 * http://mail.google.com/support/bin/answer.py?hl=ru&ctx=mail&answer=22839
 * http://www.labnol.org/internet/email/gmail-daily-limit-sending-bulk-email/2191/
 * 
 * Ограничения Dreamhost:
 * mail() - 200 писем в час, в случае превышения mail() всегда возвращает true
 * SMTP - 100 получателей в час http://wiki.dreamhost.com/SMTP_quota
 */


class alertTask extends sfBaseTask
{
  const APPLICATION 			= 'frontend';
  const ENV 					= 'prod';
  //const SEND_ATTEMPTS_COUNT 	= 1; // количество попыток отрпавки
  const SEND_LIMIT 	= 90; 	// количество отправок писем за подключение
  
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
      // add your own options here
    ));

    $this->namespace        = 'project';
    $this->name             = 'alert';
    $this->briefDescription = 'Send e-mail alerts';
    $this->detailedDescription = <<<EOF
The [alert|INFO] task does things.
Call it with:

  [php symfony alert|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
  	ini_set( 'max_execution_time', AlertPeer::MAX_EXECUTION_TIME );
  	
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();
    
    // create a context, and load the helper
    $configuration = ProjectConfiguration::getApplicationConfiguration(self::APPLICATION, self::ENV, true);
    $context = sfContext::createInstance($configuration);
    $configuration->loadHelpers('Partial');
    //$configuration->loadHelpers('Url');
    $context->getRequest()->setRequestFormat('html');    
    
    // Определение лучших идей
    //IdeaPeer::detectBestIdea();

    // Получение задач из очереди
    $c = new Criteria();
    $c->add( AlertPeer::STATUS, 0 );    
    //$c->add( AlertPeer::USER_ID, 72 );    
    $alert_list = AlertPeer::doSelect($c);   
    
    if ( empty($alert_list) ) {
    	return;
    }
    
    // Соединение с Gmail
    $mailer = MailPeer::getMailer();    
    
    if ( !$mailer ) {  
    	return;
    }  	

    // счётчик отправленных за подключение писем
    $alert_counter = 0;
    // предыдущая отправка закончилась неудачно
    $prev_error = false;
    foreach ($alert_list as $i => $alert) {
      	
        $item_lang = $alert->getItemLang();        
      
        if (empty($item_lang)) {
          continue;
        } 
        // установка языка
        // почему-то не работает, поэтому выбираем прямо из таблиц ...I18n
        //$context->getUser()->setCulture( $item_lang );
		//sfContext::getInstance()->getUser()->setCulture( $item_lang );
		//echo sfContext::getInstance()->getUser()->getCulture();
		//$this->changeCulture( $item_lang );
        

        // формирование ссылки        
        //$url = $this->getRouting()->generate('default', array('module' => 'foo', 'action' => 'bar'));                                
		$url = $alert->getUrl();		
		$error = false;		
		
		try {		
			
		  // заголовок элемента
		  $item_title = $alert->getItemTitle();
		
		  // имя получателя
		  $user = $alert->getUserRelatedByUserId();
		  if ($user) {
			$user_name  = $user->getName();
			$user_email = $user->getEmail();
			
		    $user_lang = $user->getLang();
		    if ( !in_array($user_lang, MailPeer::getMailCultures()) ) {
		      $user_lang = UserPeer::DEFAULT_CULTURE;
		    }
		  }
		
		  // имя обновившего		  
		  $item_by_user = $alert->getUserRelatedByItemByUser();
		  if ($item_by_user) {
			$item_by_user_name = $item_by_user->getName();
		  }		  
				
          // получение partial	  	   
          if ($alert->getIsComment()) {
          	
          	$is_comment = 'Comment';
          	
            //$c = new Criteria();
            $c = CommentsPeer::getCommentsCriteria( $alert->getItemTypeName(), $alert->getItemId(), 'desc' );
            $c->add(CommentsPeer::USER_ID, $item_by_user->getId());
            $c->addJoin(CommentsI18nPeer::ID, CommentsPeer::ID);
            $c->add(CommentsI18nPeer::CULTURE, $alert->getItemLang());            
            //$c->setLimit(1);

            $comment = CommentsI18nPeer::doSelectOne($c);            
                        
            // возможно комментарий был скрыт или удалён
            if ($comment) {
              $comment_body = CommentsPeer::prepareBody( $comment->getBody() );
              $comment_id   = $comment->getId();
            }
          }
          
          // body получаем только для Mail
          if ($alert->getItemType() == ItemtypesPeer::ITEM_TYPE_MAIL) {
            $mail = ItemtypesPeer::getItem($alert->getItemId(), $alert->getItemType(), $alert->getItemLang());
            if ($mail) {
              $item_body = $mail->getBody();
            }
          }
          
	      $mailBody 	 = get_partial(
	      	  'mail/alert' . $is_comment . $user_lang, 
	    	  array( 
	    		'item_title' 		=> $item_title,	    		
	    		'item_body' 		=> $item_body,
	    		'comment_body' 		=> $comment_body,	    		
	    		'comment_id' 		=> $comment_id,	    		
	    		'user_name'			=> $user_name,	    		
	    		'url' 				=> $url,	    		
	    		'item_by_user_name' => $item_by_user_name,	    		
	    		'item_type' 		=> $alert->getItemType(),	    		
	    	  )
	      );
	      
	      $mailSubject = get_partial(
	    	'mail/alert' . $is_comment . 'Subject' . $user_lang, 
	    	array('item_type' => $alert->getItemType(), 'item_title' => $item_title, 'user_name' => $item_by_user_name )
	      );
	      // чтобы в теме были корректные символы
	      $mailSubject = html_entity_decode( $mailSubject, ENT_QUOTES, "utf-8" );
	      echo "\r\n" . ($i+1) . ')' . $mailSubject;
	  
	      // отправка письма
	      // 3 попытки
	      //for($i=0; $i<110; $i++) {
	      	$sendResult = MailPeer::mailerSend($mailer, $mailBody, $mailSubject, $user_email);
	      // 	if ($sendResult) {
	      //		break;	
		  //	}\
		  //echo $i . ', ';
	      //}

  		  if ($sendResult) {	      	
	      	$alert->delete();
	      	continue;							      	     
  		  } else {
  		  	$error = true;
  		  }
	      
		} catch (Exception $e) {
		  $error = true;
		  //$alert->setStatus( AlertPeer::STATUS_ERROR );
		}
		
		// если в эту и предыдущую попытку произошла ошибка, прекращаем
		if ($error && $prev_error) {
			break;
		}
		
		// в случае ошибки переподключаемся ждём, чтобы дождаться, когда Gmail разрешит снова отправлять письма
        if ( $error || $alert_counter == self::SEND_LIMIT) {
          /*$alert_copy = $alert->copy();
          $alert_copy->setStatus( AlertPeer::STATUS_ERROR );	
          $alert_copy->setCreatedAt( date("Y-m-d H:i:s") );	
          $alert->delete();
          $alert_copy->save();*/
          //break;
          MailPeer::mailerDisconnect($mailer);
          sleep(3);
          $mailer = MailPeer::getMailer(); 
          $alert_counter = 0;
          $prev_error = true;      
		} else {
		  $alert_counter++;
		}
    }
      
  	// отключение от Gmail 
    MailPeer::mailerDisconnect($mailer);    
    
  }
  
  /*
  protected function getI18N()
  {
    if (!$this->i18n)
    {
      $config = sfFactoryConfigHandler::getConfiguration($this->configuration->getConfigPaths('config/factories.yml'));
      $class  = $config['i18n']['class'];
 
      $this->i18n = new $class($this->configuration, null, $config['i18n']['param']);
 
      $this->i18n->setCulture($this->commandManager->getOptionValue('culture'));
    }
 
    return $this->i18n;
  }
 
  protected function changeCulture($culture)
  {
    $this->getI18N()->setCulture($culture);
  } */
  
}
