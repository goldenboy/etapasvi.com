<?php

class Idea extends BaseIdea
{
	/**
	 * Handle I18n DB fields in Admin Generator
	 *
	 * @param string $method
	 * @param mixed $arguments
	 * @return mixed
	 */
	public function __call($method, $arguments)
	{
	  $data = preg_split('/I18n/', $method, 2);
	
	  if( count($data) != 2 )
	  {
	    // original call for support sfPropelBehavior
	    return parent::__call($method, $arguments);
	  }
	
	  list( $method, $culture ) = $data;
	
	  if (4 == strlen($culture))
	  {
	    $culture = strtolower(substr($culture, 0, 2)) . '_' . strtoupper(substr($culture, 2, 2));
	  }
	  else
	  {
	    $culture = strtolower($culture);
	  }
	
	  $this->setCulture( $culture );
	
	  return call_user_func_array(array($this, $method), $arguments);
	}	

	public function __toString() {
		if ($this->getBody()) {
			$body = $this->getBody();	
			if ( sfContext::getInstance()->getUser()->getCulture() == 'ru' ) {
				$body = iconv( 'UTF8', 'CP1251', $body );
			}
			$body = mb_substr($body, 0, 100);	
			if ( sfContext::getInstance()->getUser()->getCulture() == 'ru' ) {
				$body = iconv( 'CP1251', 'UTF8', $body );					
			}
			return $body;
		} else {
			return '';
		}
	}
	
	public function getBodyPrepared( $is_short = false ) {
		if ($is_short) {
			$body = $this->getBody();			
			$source_len = strlen($body);
			if ( sfContext::getInstance()->getUser()->getCulture() == 'ru' ) {
				$body = iconv( 'UTF8', 'CP1251', $body );
			}
			$body = mb_substr($body, 0, 300);	
			if ( sfContext::getInstance()->getUser()->getCulture() == 'ru' ) {
				$body = iconv( 'CP1251', 'UTF8', $body );
			}
			// убераем незакрытый тег
			//$body = preg_replace( '/<[^>]*$/i', '', $body );
			if ($source_len > 300) {
				$body .= '... ';
			}
			$body = nl2br($body);			
		} else {			
			$body = $this->getBody();
			$body = nl2br($body);			
		}
		return $body;
	}
	
	/**
	 * Сообщал ли пользователь о нарушении в этой идее
	 *
	 * @param unknown_type $user_id
	 * @return unknown
	 */
	public function isAbused()
	{	
		if (!UserPeer::authIsLoggedIn()) return true;
		
		$user_id = UserPeer::authUserId();
		
		if (!$user_id) return true;

    	$c = new Criteria();
    	$c->add(IdeaabusePeer::IDEA_ID, $this->getId());
    	$c->add(IdeaabusePeer::USER_ID, $user_id);
    	$isAbused = IdeaabusePeer::doCount($c);

    	return (bool)$isAbused;
	}	
	
	/**
	 * Голосовал ли пользователь за идею
	 *
	 * @param unknown_type $user_id
	 * @return unknown
	 */
	public function isVoted()
	{	
		if (!UserPeer::authIsLoggedIn()) return true;
		
		$user_id = UserPeer::authUserId();
		
		if (!$user_id) return true;

    	$c = new Criteria();
    	$c->add(IdeavotePeer::IDEA_ID, $this->getId());
    	$c->add(IdeavotePeer::USER_ID, $user_id);
    	$isVoted = IdeavotePeer::doCount($c);

    	return (bool)$isVoted;
	}	
	
	public function getCommentsCount()
	{		
		return (int)CommentsPeer::getCommentsCount( CommentsPeer::FOR_IDEA, $this->getId() );
	}
	
}
