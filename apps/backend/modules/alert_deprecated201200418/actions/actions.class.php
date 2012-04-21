<?php

/**
 * alert actions.
 *
 * @package    sf_sandbox
 * @subpackage alert
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 5125 2007-09-16 00:53:55Z dwhittle $
 */
class alertActions extends autoalertActions
{
  public function executeSpam($request)
  {
  	// добавление задач в очередь
  	if ( $request->isMethod('post') ) {
  		  		
  		$item_type = $request->getParameter('item_type');  		  		
  		
  		// получение пользователей  
  		$c = new Criteria();
  		$c->add( UserPeer::IS_ACTIVE, 1);
  		
  		switch ($item_type) {
  			case ItemtypesPeer::ITEM_TYPE_NEWS:
  				$item_id = $request->getParameter('news_id');
  				$c->add( UserPeer::SUBSCRIBE_NEWS, 1);
  				break;
  			case ItemtypesPeer::ITEM_TYPE_PHOTO:
  				$item_id = $request->getParameter('photo_id');
  				$c->add( UserPeer::SUBSCRIBE_PHOTO, 1);
  				break;    							
  			case ItemtypesPeer::ITEM_TYPE_VIDEO:
  				$item_id = $request->getParameter('video_id');
  				$c->add( UserPeer::SUBSCRIBE_VIDEO, 1);
  				break;
  			case ItemtypesPeer::ITEM_TYPE_MAIL:
  				$item_id = $request->getParameter('mail_id');
  				break;
  		}
  		
  		// выбор пользователей по именам
  		if (!empty($_POST['user_names'])) {
  			$user_names = split(',', $_POST['user_names']);
  			// обрезаем пробелы
  			foreach ($user_names as $i=>$v) {
  				$user_names[ $i ] = trim($v);
  			}
  			if ($_POST['user_exclude'] != 'Y') {
  				$cton1 = $c->getNewCriterion(UserPeer::NAME, $user_names, Criteria::IN);
  				$cton2 = $c->getNewCriterion(UserPeer::EMAIL, $user_names, Criteria::IN);
  				$cton1->addOr($cton2);
  				$c->add($cton1);
  			} else {
  				$c->add(UserPeer::NAME, $user_names, Criteria::NOT_IN);
  				$c->add(UserPeer::EMAIL, $user_names, Criteria::NOT_IN);
  			}
  		}
  		
  		$user_list = UserPeer::doSelect( $c );

  		if ( empty($item_type) || empty($item_id) ) {
  			$this->msg = 'Spam error';
  		}
  		
  		// счётчик добавленных или удалённых задач
  		$alertCounter = 0;
  		
  		if ( $request->getParameter('spam') ) {
  			
  			// добавляем задачи
	  		foreach ($user_list as $user) {	  			
	  			if ( !$user->getLang() ) {
	  				continue;
	  			}
	  			//for ($i=0; $i<190; $i++){  
	  						
		  		$add_result = AlertPeer::addAlert( 
		  			$user, 
		  			$item_type, 
		  			$item_id, 
		  			$user->getLang(), 
		  			null, 
		  			0 
		  		);
	  			//}
		  		if ($add_result) {
		  			$alertCounter++;
		  		}		  		
	  		}
	  		
	  		$this->msg = 'Added alerts: ' . $alertCounter;
	  		
  		} else {
  			
  			// отменяем задачи
	  		foreach ($user_list as $user) {		  			  			
	  			if ( !$user->getLang() ) {
	  				continue;
	  			}	  			
		  		$remove_result = AlertPeer::removeAlert( 
		  			$user->getId(), 
		  			$item_type, 
		  			$item_id, 
		  			$user->getLang(), 
		  			0 
		  		);
		  		if ($remove_result) {
		  			$alertCounter++;
		  		}		  		
	  		}  
	  		$this->msg = 'Removed alerts: ' . $alertCounter;
  		}
  		
  	}
  	  	
  	$c = new Criteria();
  	$c->addDescendingOrderByColumn( NewsPeer::ORDER );
  	$this->news_list = NewsPeer::doSelect( $c );
  	
  	$c = new Criteria();
  	$c->addDescendingOrderByColumn( PhotoPeer::ORDER );
  	$this->photo_list = PhotoPeer::doSelect( $c );  	
  	
  	$c = new Criteria();
  	$c->addDescendingOrderByColumn( VideoPeer::ORDER );
  	$this->video_list = VideoPeer::doSelect( $c ); 
  	
  	$c = new Criteria();
  	//$c->addSelectColumn( MailPeer::ID );
  	//$c->addSelectColumn( MailI18nPeer::TITLE );
  	$c->addDescendingOrderByColumn( MailPeer::CREATED_AT );
  	$this->mail_list = MailPeer::doSelect( $c ); 
  }
}