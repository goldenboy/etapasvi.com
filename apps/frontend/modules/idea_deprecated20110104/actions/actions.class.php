<?php

/**
 * idea actions.
 *
 * @package    sf_sandbox
 * @subpackage idea
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class ideaActions extends sfActions
{
  public function executeBest(sfWebRequest $request)
  {	
  	//IdeaPeer::detectBestIdea();
	// выводим лучшую идею по результатам голосования
    $this->idea = IdeaPeer::getBestIdea();
  }
  
  public function executeMain(sfWebRequest $request)
  {

  }
  
  public function executeIdeaoftheweek(sfWebRequest $request)
  {
  	if (IdeaPeer::isThinkingNow()) {
      $this->best_idea = IdeaPeer::getBestIdea();
  	}
  }  

  public function executeNew(sfWebRequest $request)
  {
  	//IdeaPeer::detectBestIdea();
  	
  	// если у пользователя уже есть Идея, показвыаем её
  	if (UserPeer::authIsLoggedIn()) {
	  $c = new Criteria();
	  $c->add( IdeaPeer::USER_ID, UserPeer::authUserId() );
	  $c->add( IdeaPeer::SHOW, 1);
	  $idea_list = IdeaPeer::doSelect($c);
	    
	  if ( count($idea_list) ) {
	 	$this->redirect('@show_idea');
	  }  
  	}	
  	
  	// если сейчас думаем, то не разрешаем создавать идею
  	if (IdeaPeer::isThinkingNow()) {
  		$this->setTemplate( 'thinkingnow' );
  	}
  	
    if ( $request->isMethod('post') ) {
		if ( $request->getParameter('preview') ) {
			$idea_post = $request->getParameter('idea');
			$user_id = UserPeer::authUserId();
			if (!$user_id) {
				$user_id = IdeaPeer::DUMMY_USER_ID;
			}
			$this->preview_idea = new Idea();
			
			$this->preview_idea->setId( -1 );
			$this->preview_idea->setUserId( $user_id );
			$this->preview_idea->setCreatedAt( date('Y-m-d H:i:s') );
			$this->preview_idea->setVotes( 0 );
			$this->preview_idea->setShow( 1 );
			$this->preview_idea->setBody( $idea_post['body'] );
		} else {
		    $idea_post = $request->getParameter('idea');
		
		    if ($idea_post['body'] == '') {
		      $this->error_idea = 1;
		      return;
		    }
		      		  		
			// если пользователь не вошёл просим войти/зарегистрироваться
			if ( !UserPeer::authIsLoggedIn() ) {
			  session_start();
			  $_SESSION['loginorsignup_body_from']		= 'idea';
			  $_SESSION['loginorsignup_post']			= serialize( $idea_post );
			  $_SESSION['loginorsignup_from']			= UserPeer::FROM_IDEA;
			  $_SESSION['loginorsignup_from_location'] 	= 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
			  $this->redirect( '@loginorsignup' );
			}
			if (IdeaPeer::addIdea( $idea_post['body'] )) {
			  $this->redirect( '@show_idea' );
			} else {
			  $this->error_post = 1;
			}
		}
    }
  }  

  public function executeShow(sfWebRequest $request)
  {
  	//IdeaPeer::detectBestIdea();
  	
	// если пользователь не вошёл или у него нет идеи, показываем Новая идея
	if (UserPeer::authIsLoggedIn()) {
	    $c = new Criteria();
	    $c->add( IdeaPeer::USER_ID, UserPeer::authUserId() );
	    $c->add( IdeaPeer::SHOW, 1);
	    $this->idea = IdeaPeer::doSelectOne($c);

	    if ( $this->idea ) { 		      
		  // если у пользователя есть Идея на другом языке показываем ссылку
		  if ( !$this->idea->getBody() ) {
		  	// определяем язык, на котором у пользователя идея
		  	foreach (UserPeer::getCultures() as $culture) {
			    $c = new Criteria();
			    $c->add( IdeaI18nPeer::ID, $this->idea->getId() );
			    $c->add( IdeaI18nPeer::CULTURE, $culture );
			    $idea_other_lang = IdeaI18nPeer::doSelectOne($c);
			    if ( $idea_other_lang && $idea_other_lang->getBody() ) {
			    	$this->other_lang = $culture; 	
			    	break;	  		
			    }
		  	}
		  	$this->setTemplate( 'ideaotherlang' );
		  }
	    } else {
	 	  $this->redirect('@new_idea');
	    }
	} else {
		$this->redirect('@new_idea');
	}
  }  
  
  public function executeIndex(sfWebRequest $request)
  {
  	//IdeaPeer::detectBestIdea();
  	
    $c = new Criteria();
    $c->add( IdeaPeer::SHOW, 1);
    $c->add( IdeaI18nPeer::BODY, '', Criteria::NOT_EQUAL );
	$c->addJoin( IdeaPeer::USER_ID, UserPeer::ID );
	$c->add( UserPeer::IS_ACTIVE, 1 );    
    if ($request->getParameter('orderby') == 'votes') {
      $c->addDescendingOrderByColumn( IdeaPeer::VOTES );
    } else {
      $c->addDescendingOrderByColumn( IdeaPeer::CREATED_AT );
    }
    
	//$pager = new sfPropelPager('Idea', 2);
	$pager = new sfPropelPagerI18n('Idea', IdeaPeer::ITEMS_PER_PAGE);
    $pager->setCriteriaI18n($c);
    $pager->setPage($this->getRequestParameter('page', 1));
    $pager->init();
    $this->pager = $pager;
    
    // если передан номер страницы больше, чем имеется страниц
    if ($request->getParameter('page') > $this->pager->getLastPage()) {
    	$this->forward404();
    }    
    
    // запоминаем адрес
    $_SESSION['back_to_ideas'] = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
  }
  
  public function executeArchive(sfWebRequest $request)
  {
  	//IdeaPeer::detectBestIdea();
  	
    $c = new Criteria();
    // если для Bestidea нет условия, то почему-то выборка идёт из Idea
    //$c->add( BestideaPeer::ID, 0, Criteria::GREATER_THAN );
    $c->add( IdeaI18nPeer::BODY, '', Criteria::NOT_EQUAL );
    $c->addJoin( IdeaPeer::ID, BestideaI18nPeer::IDEA_ID );
    //$c->add( BestideaPeer::ID, 0, Criteria::GREATER_THAN );
    
    if ($request->getParameter('orderby') == 'votes') {
      $c->addDescendingOrderByColumn( IdeaPeer::VOTES );
    } else {
      $c->addDescendingOrderByColumn( IdeaPeer::CREATED_AT );
    }
    
	//$pager = new sfPropelPager('Idea', 2);
	$pager = new sfPropelPagerI18n('Idea', IdeaPeer::ITEMS_PER_PAGE);
    $pager->setCriteriaI18n($c);
    $pager->setPage($this->getRequestParameter('page', 1));
    $pager->init();
    $this->pager = $pager;
    
    // если передан номер страницы больше, чем имеется страниц
    if ($request->getParameter('page') > $this->pager->getLastPage()) {
    	$this->forward404();
    }
    // запоминаем адрес
    $_SESSION['back_to_archive'] = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];    
  }  
  
  public function executeDetails(sfWebRequest $request)
  {  	
  	//IdeaPeer::detectBestIdea();
  	
    $this->idea = IdeaPeer::retrieveByPk( $request->getParameter('id') );
  	$this->forward404Unless($this->idea);
  	/*
  	if ( !$this->idea->getBody() ) {
	  	// получаем имя пользователя
	  	$user = UserPeer::retrieveByPk( $this->idea->getUserId() );
	  	if ($user) {
	  		$this->user_name = $user->getName();
	  	}  		
  		$this->setTemplate( 'detailsideaotherlang' );
  	}*/
  	if ( !$this->idea->getBody() ) {
  		$this->redirect('@index_idea');
  	}  	
  	
  	// ссылка назад
  	if ($_SESSION['back_to_ideas'] != '') {
  	  $this->back_to_ideas = $_SESSION['back_to_ideas'];
  	}
  }
  
  public function executeArchivedetails(sfWebRequest $request)
  {  	
  	//IdeaPeer::detectBestIdea();
  	
    $this->idea = IdeaPeer::retrieveByPk( $request->getParameter('id') );
  	$this->forward404Unless($this->idea);
  	
  	if ( !$this->idea->getBody() ) {
  		$this->redirect('@idea_archive');
  	}
  	
  	// ссылка назад
  	if ($_SESSION['back_to_archive'] != '') {
  	  $this->back_to_archive = $_SESSION['back_to_archive'];
  	}
  }   
  
  public function executeAbuse(sfWebRequest $request)
  {
  	$idea_id = (int)$request->getParameter('id');
  	if ($idea_id) {
  		
	  	if (UserPeer::authIsLoggedIn()) {
			IdeaPeer::addAbuse( $idea_id );
	  	} else {	  		  
	  		// если пользователь не вошёл просим войти/зарегистрироваться
	  		session_start();
	  		$_SESSION['loginorsignup_from']				= UserPeer::FROM_IDEA_ABUSE;
	  		$_SESSION['loginorsignup_id']				= $idea_id; 
	  		$_SESSION['loginorsignup_from_location'] 	= base64_decode( $request->getParameter('from_location') );
	  		sfLoader::LoadHelpers(array('Url'));
	  		$redirect = url_for( 'user/loginorsignup?from=' . $request->getParameter('from') );
	  	}
  	}
	$response = $this->getResponse();  
	
	$response->setContent( '{"redirect": "' . $redirect . '"}' ); 
	
	return sfView::NONE;
  }
  
  public function executeVote(sfWebRequest $request)
  {
  	$idea_id = (int)$request->getParameter('id');
  	if ($idea_id) {
  		
	  	if (UserPeer::authIsLoggedIn()) {
			IdeaPeer::addVote( $idea_id );
	  	} else {	  		  
	  		// если пользователь не вошёл просим войти/зарегистрироваться
	  		session_start();
	  		$_SESSION['loginorsignup_from']				= UserPeer::FROM_IDEA_VOTE;
	  		$_SESSION['loginorsignup_id']				= $idea_id; 
	  		$_SESSION['loginorsignup_from_location'] 	= base64_decode( $request->getParameter('from_location') );
	  		sfLoader::LoadHelpers(array('Url'));
	  		$redirect = url_for( 'user/loginorsignup?from=' . $request->getParameter('from') );
	  	}
  	}

	$response = $this->getResponse();  
	
	$response->setContent( '{"redirect": "' . $redirect . '", "idea_id": "' . $idea_id . '"}' ); 
	
	return sfView::NONE;  	
  }  
  
  public function executeThinkingnow(sfWebRequest $request)
  {

  }   
}