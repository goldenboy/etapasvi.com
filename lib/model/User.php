<?php

class User extends BaseUser
{
	public function __toString() {
		return $this->getName();
	}
	
	public function setPasswordEncoded($password) {
  		parent::setPassword( sha1(md5($password)) );
	}
		
	public function isAdmin() {
  		if ($this->getName() == UserPeer::ADMIN_NAME) {
  			return true;
  		} else {
  			return false;
  		}
	}
	/*
	public function getThinkingtime()
	{
		// время думать по Гринвичу
		$thinking_time_gmt = IdeaPeer::getThinkingTimeGMT();
		
		// разница в часах пользователя и Гринвича
		//$timezone = TimezonePeer::retrieveByPk( $this->getTimezoneId() );
		$timezone = $this->getTimezone();
		if (!$timezone) return 0;
		
		// разница в секундах
		$time_offset = $timezone->getValue() * 3600;
		
		// Летнее время не учитываем
		return $thinking_time_gmt + $time_offset;
	}*/
	public function saveLastLogin() {
  		$this->setLastLogin(gmdate("Y-m-d H:i:s"));
  		$this->save();
	}
	
	/**
	 * Обработка и сохранение Ссылки на профайл
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setProfile($v)
	{
		if (!empty($v) && !strstr($v, 'http://') && !strstr($v, 'https://')) {
			$v = 'http://' . $v;
		}
		parent::setProfile( $v );
	}
	
//	public function phpbbLogin()
//	{
//		$sessionId = md5(time());
//		//$sessionId = substr($sessionId, 0, 32); // Just in case
//		$sessionKey = '';
//			
//		if ($this->insertDbSession( $sessionId, $sessionKey, $this->phpbb_id )) {
//			$this->setCookies( $sessionId, $sessionKey, $this->phpbb_id );
//		}
//	}
//	
//	private function insertDbSession($sessionId, $sessionKey, $user_id)
//	{
//		try {
//			// удаляем запись, если есть
//			$c = new Criteria();
//			$c->add( Phpb7d3xSessionsKeysPeer::KEY_ID, $sessionKey );
//			$c->add( Phpb7d3xSessionsKeysPeer::USER_ID, $user_id );
//			$phpbb_sessions_key = Phpb7d3xSessionsKeysPeer::doSelectOne( $c );
//			if ($phpbb_sessions_key) {
//				$phpbb_sessions_key->delete();
//			}		
//			// добавляем
//			$phpbb_sessions_key = new Phpb7d3xSessionsKeys();
//			$phpbb_sessions_key->setKeyId( $sessionKey );
//			$phpbb_sessions_key->setUserId( $user_id );
//			$phpbb_sessions_key->setLastIp( sfContext::getInstance()->getRequest()->getHttpHeader('addr', 'remote') );
//			$phpbb_sessions_key->setLastLogin( time() );
//			$phpbb_sessions_key->save();
//			
//			// удаляем запись, если есть
//			$phpbb_session = Phpb7d3xSessionsKeysPeer::retrieveByPk( $sessionId );
//			if ($phpbb_session) {
//				$phpbb_session->delete();
//			}
//			// добавляем	
//			$phpbb_session = new Phpb7d3xSessions();
//			$phpbb_session->setSessionId( $sessionId );
//			$phpbb_session->setSessionUserId( $user_id );
//			$phpbb_session->setSessionStart( time() );
//			$phpbb_session->setSessionLastVisit( time() );
//			$phpbb_session->setSessionTime( time() );
//			$phpbb_session->setSessionBrowser( $_SERVER['HTTP_USER_AGENT'] );
//			$phpbb_session->setSessionIp( sfContext::getInstance()->getRequest()->getHttpHeader('addr', 'remote') );
//			$phpbb_session->setSessionAutologin(1);
//			$phpbb_session->setSessionAdmin(0);
//			$phpbb_session->setSessionViewonline(1);
//			$phpbb_session->save();
//		} catch (Exception $e) {
//			return false;
//		}
//		
//		return true;
//	}	
//	
//	private function setCookies($sessionId, $sessionKey, $user_id)
//	{
//		$phpbbCookieName = Phpb7d3xConfigPeer::getCookieName();
//		$domain = Phpb7d3xConfigPeer::getCookieDomain();
//		
//		// Two weeks should be ample
//		$response = sfContext::getInstance()->getResponse();
//		$response->setCookie($phpbbCookieName . '_k', $sessionKey, time() + 1209600, '/', $domain);
//		$response->setCookie($phpbbCookieName . '_u', $user_id , time() + 1209600, '/', $domain);
//		$response->setCookie($phpbbCookieName . '_sid', $sessionId, time() + 1209600, '/', $domain);
//	}
//	public function phpbbUpdateProfile( $password = '', $email = '')
//	{
//		if ($password || $email) {
//			$phpbb_user = Phpb7d3xUsersPeer::retrieveByPk( $this->phpbb_id );
//			if ($phpbb_user) {
//				if ($password) {
//					$phpbb_user->setUserPassword( $this->phpbb_hash($password) );
//				}
//				if ($email) {
//					$phpbb_user->setUserEmail( $email );
//				}
//				$phpbb_user->save();			
//			}
//		}
//	}
//	
//	// функции из PHPBB functinos.php
//	
//	/**
//	* Hash the password
//	*/
//	private function phpbb_hash($password)
//	{
//		$itoa64 = './0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
//	
//		$random_state = $this->unique_id();
//		$random = '';
//		$count = 6;
//	
//		if (($fh = @fopen('/dev/urandom', 'rb')))
//		{
//			$random = fread($fh, $count);
//			fclose($fh);
//		}
//	
//		if (strlen($random) < $count)
//		{
//			$random = '';
//	
//			for ($i = 0; $i < $count; $i += 16)
//			{
//				$random_state = md5($this->unique_id() . $random_state);
//				$random .= pack('H*', md5($random_state));
//			}
//			$random = substr($random, 0, $count);
//		}
//	
//		$hash = $this->_hash_crypt_private($password, $this->_hash_gensalt_private($random, $itoa64), $itoa64);
//	
//		if (strlen($hash) == 34)
//		{
//			return $hash;
//		}
//	
//		return md5($password);
//	}	
//	/**
//	* Return unique id
//	* @param string $extra additional entropy
//	*/
//	private function unique_id($extra = 'c')
//	{
//		$val = microtime();
//		$val = md5($val);
//	
//		return substr($val, 4, 16);
//	}
//	
//	private function _hash_crypt_private($password, $setting, &$itoa64)
//	{
//		$output = '*';
//	
//		// Check for correct hash
//		if (substr($setting, 0, 3) != '$H$')
//		{
//			return $output;
//		}
//	
//		$count_log2 = strpos($itoa64, $setting[3]);
//	
//		if ($count_log2 < 7 || $count_log2 > 30)
//		{
//			return $output;
//		}
//	
//		$count = 1 << $count_log2;
//		$salt = substr($setting, 4, 8);
//	
//		if (strlen($salt) != 8)
//		{
//			return $output;
//		}
//	
//		/**
//		* We're kind of forced to use MD5 here since it's the only
//		* cryptographic primitive available in all versions of PHP
//		* currently in use.  To implement our own low-level crypto
//		* in PHP would result in much worse performance and
//		* consequently in lower iteration counts and hashes that are
//		* quicker to crack (by non-PHP code).
//		*/
//		if (PHP_VERSION >= 5)
//		{
//			$hash = md5($salt . $password, true);
//			do
//			{
//				$hash = md5($hash . $password, true);
//			}
//			while (--$count);
//		}
//		else
//		{
//			$hash = pack('H*', md5($salt . $password));
//			do
//			{
//				$hash = pack('H*', md5($hash . $password));
//			}
//			while (--$count);
//		}
//	
//		return $output;
//	}	
//	
//	/**
//	* Encode hash
//	*/
//	private function _hash_encode64($input, $count, &$itoa64)
//	{
//		$output = '';
//		$i = 0;
//	
//		do
//		{
//			$value = ord($input[$i++]);
//			$output .= $itoa64[$value & 0x3f];
//	
//			if ($i < $count)
//			{
//				$value |= ord($input[$i]) << 8;
//			}
//	
//			$output .= $itoa64[($value >> 6) & 0x3f];
//	
//			if ($i++ >= $count)
//			{
//				break;
//			}
//	
//			if ($i < $count)
//			{
//				$value |= ord($input[$i]) << 16;
//			}
//	
//			$output .= $itoa64[($value >> 12) & 0x3f];
//	
//			if ($i++ >= $count)
//			{
//				break;
//			}
//	
//			$output .= $itoa64[($value >> 18) & 0x3f];
//		}
//		while ($i < $count);
//	
//		return $output;
//	}	
//	
//	/**
//	* Generate salt for hash generation
//	*/
//	private function _hash_gensalt_private($input, &$itoa64, $iteration_count_log2 = 6)
//	{
//		if ($iteration_count_log2 < 4 || $iteration_count_log2 > 31)
//		{
//			$iteration_count_log2 = 8;
//		}
//	
//		$output = '$H$';
//		$output .= $itoa64[min($iteration_count_log2 + ((PHP_VERSION >= 5) ? 5 : 3), 30)];
//		$output .= $this->_hash_encode64($input, 6, $itoa64);
//	
//		return $output;
//	}	
}