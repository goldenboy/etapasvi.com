<?php

class IdeaPeer extends BaseIdeaPeer
{
  	const ITEMS_PER_PAGE = 5;  	
	
	// думаем в 22:00 по Гринвичу	
	// суббота
	const THINKING_DAY_OF_WEEK = 6; 
	// 10:00
	const THINKING_HOUR 	   = 12; 
	// 1 час
	const THINKING_INTERVAL    = 3600;
	
	// пользователь для preview
	const DUMMY_USER_ID = 222;
	
	public static function addIdea( $body )
	{
		if ( self::isThinkingNow() || !UserPeer::authIsLoggedIn() || $body == '' ) {
			return false;
		}		
		// проверка есть ли у пользователя уже идея
		$c = new Criteria();
		$c->add(IdeaPeer::USER_ID, UserPeer::authUserId());
		$c->add(IdeaPeer::SHOW, 1);
		$find_idea = IdeaPeer::doSelectOne($c);
		if ($find_idea) {
			return false;
		}
	  	// сохранение идеи
	    $idea = new Idea();
	    $idea->setUserId( UserPeer::authUserId() );
	    $idea->setBody( $body );
	    $idea->setCreatedAt( gmdate("Y-m-d H:i:s") );
	    $idea->save();

  		if ($idea->getId()) {
  			// подписываем пользователя на созданную идею		   
	  		SubscribePeer::addSubscribe( 
	  			UserPeer::authUserId(), 
	  			$idea->getId(), 
	  			AlertPeer::ITEM_TYPE_IDEA, 
	  			sfContext::getInstance()->getUser()->getCulture() );
			return true;
  		} else {
  			return false;
  		}
	}
	
	public static function addAbuse( $idea_id )
	{
		if (self::isThinkingNow()) {
			return false;
		}
		
		$user_id = UserPeer::authUserId();
		// вернуться, если идея принадлежит пользователю
		$idea = IdeaPeer::retrieveByPk( $idea_id );
		if (!$idea || $idea->getUserId() == $user_id) {
			return false;
		}
				
  		$ideaabuse = new Ideaabuse();
  		$ideaabuse->setUserId( $user_id );
  		$ideaabuse->setIdeaId( $idea_id );
  		$ideaabuse->setCreatedAt( gmdate("Y-m-d H:i:s") );
  		try {
  			$ideaabuse->save();
  			return true;
		} catch (Exception $e) {
  			return false;
  		}  
	}	
	
	public static function addVote( $idea_id )
	{
		if (self::isThinkingNow()) {
			return false;
		}		
		$user_id = UserPeer::authUserId();
		// вернуться, если идея принадлежит пользователю
		$idea = IdeaPeer::retrieveByPk( $idea_id );
		if (!$idea || $idea->getUserId() == $user_id) {
			return false;
		}
		
  		$ideavote = new Ideavote();
  		$ideavote->setUserId( $user_id );
  		$ideavote->setIdeaId( $idea_id );
  		$ideavote->setCreatedAt( gmdate("Y-m-d H:i:s") );
  		try {
  			$ideavote->save();
  			
  			if ($idea) {
  				$idea->setVotes( $idea->getVotes() + 1 );
  				$idea->save();
  			}
  			return true;
		} catch (Exception $e) {
  			return false;
  		}  	
	}	
	
	public static function getThinkingTimeGMT()
	{
		$day_of_week = gmdate("N"); // текущий день недели по Гринвичу (1-7)
		if ($day_of_week < 7) {
			$plus_days = self::THINKING_DAY_OF_WEEK - $day_of_week;
		} else {
			$plus_days = 6;
		}

		$thinking_day_timestamp = time() + $plus_days * 24 * 60 * 60;
		$thinking_time_gmt = mktime( 
			self::THINKING_HOUR, 
			0, 
			0, 
			gmdate("m", $thinking_day_timestamp),
			gmdate("d", $thinking_day_timestamp),			
			gmdate("Y", $thinking_day_timestamp)
		);

		// если текущее время на Гринвиче больше
		// вычисленное время + интервал, в течение которого думаем,
		// то перескакиваем на следующую неделю
		
		if ( gmdate("Y-m-d H:i:s") > date("Y-m-d H:i:s", $thinking_time_gmt + self::THINKING_INTERVAL) ) {
			$thinking_time_gmt += 7 * 24 * 60 * 60;
		}
		return $thinking_time_gmt;
	}
	
	public static function getPrevThinkingTimeGMT()
	{
		return self::getThinkingTimeGMT() - 7 * 24 * 60 * 60;
	}
	
	public static function isThinkingNow()
	{
		$thinking_time_gmt = self::getThinkingTimeGMT();
		$now_gmt 		   = strtotime( gmdate("Y-m-d H:i:s") );
		
		if ( $now_gmt >= $thinking_time_gmt && $now_gmt <= $thinking_time_gmt + self::THINKING_INTERVAL) {
			return true;
		}
		return false;
	}
	
	public static function isBestIdeaDetected()
	{
		// если не найдена лучшая идея, определённая после окончания предыдущего голосования
		// то считаем, что лучшая идея ещё не определена	
		// CREATED_AT - время по Гринвичу
		// Должна быть создана пустая запись в bestidea
	    $c = new Criteria();

	    $c->add( 
	    	BestideaPeer::CREATED_AT, 
	    	date("Y-m-d H:i:s", self::getPrevThinkingTimeGMT() + self::THINKING_INTERVAL ), 
	    	Criteria::GREATER_THAN
	    );
	    $bestideas_count = BestideaPeer::doCount($c);
	    
	    if ($bestideas_count == 0) {
	    	return false;
	    } else {
	    	return true;
	    }		
		// если все идеи скрыты, значит лучшая идея определена
		/*
	    $c = new Criteria();
	    $c->add( IdeaPeer::SHOW, 1);
	    $ideas_count = IdeaPeer::doCount($c);
	    if ($ideas_count = 0) {
	    	return true;
	    } else {
	    	return false;
	    }*/
	}
	
	public static function detectBestIdea()
	{	
	  //if ( !UserPeer::authIsLoggedIn() ) return;
	  if ( self::isBestIdeaDetected() ) return;
	  
	  // сохраняем язык
	  //$curr_culture = sfContext::getInstance()->getUser()->getCulture();
	  
	  // лучшие идеи сохраняются в историю
	  $bestidea = new Bestidea();
	  $bestidea->setCreatedAt( gmdate("Y-m-d H:i:s") );
	  //$bestidea->save();

	  foreach (UserPeer::getCultures() as $culture) {
	  	//$this->getUser()->setCulture($culture);
	  	//sfContext::getInstance()->getUser()->setCulture($culture);
	  	$idea = self::getBestIdea( $culture );
	  	if ($idea) {
	  	  $bestidea->setCulture( $culture );
	  	  $bestidea->setIdeaId( $idea->getId() );
	  	}
	  }
	  $bestidea->save();	  	  
	  
	  // восстанавливаем язык
	  //$this->getUser()->setCulture($curr_culture);
	  //sfContext::getInstance()->getUser()->setCulture($curr_culture);
	  
	  // скрываем все текущие идеи
	  $con = Propel::getConnection();
	  $c = new Criteria();
      $c->add(IdeaPeer::SHOW, '1');
      $v = new Criteria();
      $v->add(IdeaPeer::SHOW, '0');
      BasePeer::doUpdate($c, $v, $con);
	}
	
	public static function getBestIdea($culture)
	{
	  if (empty($culture)) {
	  	$culture = sfContext::getInstance()->getUser()->getCulture();
	  }
		
	  $c = new Criteria();
	  $c->addJoin( IdeaPeer::USER_ID, UserPeer::ID );
	  //$c->add( UserPeer::IS_ACTIVE, 1 );
	  $c->add( IdeaPeer::SHOW, 1 );
	  $c->addJoin( IdeaI18nPeer::ID, IdeaPeer::ID );
	  $c->add( IdeaI18nPeer::BODY, '', Criteria::NOT_EQUAL );
	  $c->add( IdeaI18nPeer::CULTURE, $culture );
	  $c->addDescendingOrderByColumn( IdeaPeer::VOTES );
	  $c->setLimit(1);
	
	  //$idea_list 	= IdeaPeer::doSelectWithI18n($c);
	  $idea_list 	= IdeaPeer::doSelect($c);
	
  	  if ( count($idea_list[0]) ) {
	    return $idea_list[0];
	  }
	  return false;
	}
}
