<?php

class AlertPeer extends BaseAlertPeer
{
    /*const ITEM_TYPE_IDEA  = 1;
	const ITEM_TYPE_NEWS  = 2;
	const ITEM_TYPE_PHOTO = 3;
	const ITEM_TYPE_VIDEO = 4;
	
	// связано с CommentsPeer
	static protected $ITEM_TYPE_NAME = array(
	  self::ITEM_TYPE_IDEA  => 'idea',
	  self::ITEM_TYPE_NEWS  => 'news',
	  self::ITEM_TYPE_PHOTO => 'photo',
	  self::ITEM_TYPE_VIDEO => 'video'
	);*/
	
	const STATUS_NEW     = 0;
	const STATUS_OK      = 1;
	const STATUS_ERROR   = 2;
	
	static protected $STATUS_NAME = array(
	  self::STATUS_NEW  	=> 'new',
	  self::STATUS_OK  		=> 'ok',
	  self::STATUS_ERROR 	=> 'error'
	);	
	
	// для формирования URL элемента, о котором оповещаем
	//const SERVER_NAME = 'http://www.etapasvi.com';
	
	// максимальное время работы скрипта при отправке e-mail
	const MAX_EXECUTION_TIME = '600'; // 10 мин
	
    /*static public function getItemTypeName( $item )
    {
      return self::$ITEM_TYPE_NAME[ $item ];
    }
    
    static public function getItemTypeByName( $item_type_name )
    {
      foreach (self::$ITEM_TYPE_NAME as $item_type => $name ) {
      	if ($name == $item_type_name) {
      		return $item_type;
      	}
      }
      return 0;
    }   */ 
    
    static public function getStatusName( $item )
    {
      return self::$STATUS_NAME[ $item ];
    }    	
    
	static public function addAlert( $user, $item_type, $item_id, $item_lang, $item_by_user, $is_comment )  
	{  
	  if (!$user->isAdmin()) {

		  // проверка, активен ли пользователь
		  if ($user && !$user->getIsActive() ) {
		  	return false;
		  }

		  // проверяем, есть ли контент на языке пользователя
		  switch ($item_type) {
			case ItemtypesPeer::ITEM_TYPE_NEWS:
				$has_culture_content = NewsPeer::hasCultureContent($item_id, $item_lang);
				break;
			case ItemtypesPeer::ITEM_TYPE_PHOTO:
				$has_culture_content = PhotoPeer::hasCultureContent($item_id, $item_lang);
				break;
			case ItemtypesPeer::ITEM_TYPE_VIDEO:
				$has_culture_content = VideoPeer::hasCultureContent($item_id, $item_lang);
				break;
			case ItemtypesPeer::ITEM_TYPE_MAIL:
				// если нет текста на языке пользователя, отправляется английский текст
				$has_culture_content = MailPeer::hasCultureContent($item_id, $item_lang);
				if (!$has_culture_content) {
					$item_lang = UserPeer::DEFAULT_CULTURE;
				}
				$has_culture_content = true;
				break;
		  }

		  if (!$has_culture_content) {
		  	return false;
		  }
	  }
		
	  $alert = new Alert();
	  $alert->setUserId( $user->getId() );
	  $alert->setItemType( $item_type );
	  $alert->setItemId( $item_id );
	  $alert->setItemLang( $item_lang );
	  $alert->setItemByUser( $item_by_user );
	  $alert->setIsComment( $is_comment );
	  $alert->setStatus( AlertPeer::STATUS_NEW );
	
	  try {
	  	$result = $alert->save();
	  } catch (Exception $e) {
	  	$result = false;
	  }
	  
	  return $result;
	}
	
	// удаление задачи оповещения, удаляются только новые задачи
	static public function removeAlert( $user_id, $item_type, $item_id, $item_lang, $is_comment )  
	{  
	  $c = new Criteria();
	  
	  $c->add(AlertPeer::USER_ID, $user_id);
	  $c->add(AlertPeer::ITEM_TYPE, $item_type);
	  $c->add(AlertPeer::ITEM_ID, $item_id);
	  $c->add(AlertPeer::ITEM_LANG, $item_lang);
	  $c->add(AlertPeer::IS_COMMENT, $is_comment);
	  $c->add(AlertPeer::STATUS, AlertPeer::STATUS_NEW);
	  
	  $alert = AlertPeer::doSelectOne($c);
	  if ($alert) {
	  	$alert->delete();
	  	return true;
	  } else {
	  	return false;
	  }
	}	
		
}
