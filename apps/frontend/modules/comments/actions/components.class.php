<?php
 
class commentsComponents extends sfComponents
{ 
  public function executeShow(sfWebRequest $request)
  {	
  	/*if ($this->for != '' && $this->id != '') {
  		$this->comments_list	= CommentsPeer::getComments( $this->for, $this->id );
  	}*/
  	
  	// определение disqus_url
  	// http://bsds.etapasvi.com/issues/97
  	if (empty($this->comments_page_url)) {
  	  $this->comments_page_url = $request->getUri();
  	}
  	
  	$this->comments_identifier = CommentsPeer::getCommentsIdentifier();
  }
//  public function executePost(sfWebRequest $request)
//  {	
//	if ($request->isMethod('post') && $this->id != '') {		
//	  $this->processAddComment($request);
//  	} 
//  }   
//  public function processAddComment(sfWebRequest $request)
//  {  	  	
//  	$post_comments = $request->getParameter('comments');  	
//  	  	
//  	if ($post_comments['body'] != '') {
//  		
//  		$location = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];  		
//  		$location = preg_replace("/#.*/", "", $location);
//  		
//  		// если пользователь не вошёл просим войти/зарегистрироваться
//  		if ( !UserPeer::authIsLoggedIn() ) {
//	  		session_start();
//	  		$_SESSION['loginorsignup_body_from']		= $this->body_id;
//	  		$_SESSION['loginorsignup_post']				= serialize( $post_comments );
//	  		$_SESSION['loginorsignup_from']				= $this->from;
//	  		$_SESSION['loginorsignup_id']				= $this->id;
//	  		$_SESSION['loginorsignup_from_location'] 	= $location;	  	
//	  		//header( 'Location: http://' . $_SERVER['SERVER_NAME'] . '/' . $this->getUser()->getCulture() . '/user/loginorsignup'  );
//	  		sfContext::getInstance()->getController()->redirect('@loginorsignup');
//	  		exit();
//  		}
//  		
//  		// сохранение комментария
//  		$comment_id = CommentsPeer::addComment( $post_comments['body'], $this->from, $this->id );
//  		
//  		if ($comment_id) {	  			  		
//	  		// добавляем #comment_376
//	  		header( 'Location: ' . $location . '#comment_' . $comment_id);
//	  		exit();
//  		} else {
//  			$this->error_post = 1;	
//  		}
//  	} else {
//  		$this->error_comments = 1;
//  	}
//  }  
}