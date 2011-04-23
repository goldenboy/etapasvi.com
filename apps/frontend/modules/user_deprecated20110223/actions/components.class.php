<?php
 
class userComponents extends sfComponents
{
  public function executeActions()
  {
	$this->isLoggedIn = UserPeer::authIsLoggedIn();
  }
  public function executeMinilogin()
  {
  	// чтобы после входа вернуться на прежнюю страницу
    $this->from = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
  }   
  public function executeThinkingtime()
  {	
    $auth_user = UserPeer::authGetUser();    
	if ($auth_user) {
		$this->user_name = $auth_user->getName();
	}
    //$this->thinking_time = $auth_user->getThinkingtime();
  }  
  public function executeThinkingnow()
  {

  }   
}