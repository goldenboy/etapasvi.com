<?php

/**
 * revisionhistory actions.
 *
 * @package    sf_sandbox
 * @subpackage revisionhistory
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class revisionhistoryActions extends autorevisionhistoryActions
{
  /**
   * Разные функции для Истории изменений
   *
   * @param unknown_type $request
   */
  public function executeTools($request)
  {
  	if (!empty($_POST['url'])) {

  	  // получение роутинга фронтенда
  	  $routing = UserPeer::getRouting();
  	
  	  $url_info = parse_url($_POST['url']);
  	  
  	  // включаем перезапись
  	  sfRoute::$force_url_rewrite = true;
  	  // получение параметров URL от роутинга
	  $params = $routing->parse($url_info['path']);
	  // включаем перезапись
	  sfRoute::$force_url_rewrite = false;

	  // Внимание: не учитываются параметры кроме языка, модуля и экшена
	  if (count($params)) {
	  	// из параметров берём только id
	    $this->page_mnemonic = CommentsPeer::getCommentsIdentifier($params['sf_culture'], $params['module'], $params['action'], array('id'=>$params['id']));	  
	  }
  	}
  }
}
