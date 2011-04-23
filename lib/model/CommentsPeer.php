<?php

class CommentsPeer extends BaseCommentsPeer
{
	// для doCountWithI18n
	const COUNT_DISTINCT = 'COUNT(DISTINCT comments.ID)';
	
	const STATUS_VISIBLE = 0;
	const STATUS_HIDDEN  = 1;
	
	//const DISQUS_EMBED  = 'etapasvi.disqus.com/embed.js';
	const DISQUS_EMBED  = 'http://mediacdn.disqus.com/1299805542/build/system/embed.js';
	
	/*
	// Для чего выбираем комментарии
	const FOR_IDEA  = 'idea'; //1;
	const FOR_NEWS  = 'news'; //2;
	const FOR_PHOTO = 'photo'; //3;
	const FOR_VIDEO = 'video'; //4;
	*/
	
   /**
	* Returns the number of rows matching criteria with I18N criteria.
	*
	* @param       Criteria    $criteria   The criteria's object
	* @param       boolean     $distinct   Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	* @param       Connection  $con        An optional database connection
	* @param       string      $culture    The selected culture.
	* @return      int                     Number of matching rows.
	* @link        http://snippets.symfony-project.org/snippet/237 -- modified for Symfony 1.2
	*/
   /*
	public static function doCountWithI18n(Criteria $criteria = null, $distinct = false, PropelPDO $con = null, $culture = null)
	{
		// we're going to modify criteria, so copy it first
		if ($criteria === null){
		  $criteria = new Criteria();
		} else {
		  $criteria = clone $criteria;
		}
				
		$culture = sfContext::getInstance()->getUser()->getCulture();
		
		if ($culture === null) {
		  // We use current user culture.
		  $default_culture = sfConfig::get('sf_default_culture');
		}
		
		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		$criteria->addSelectColumn(CommentsPeer::COUNT_DISTINCT);
		
		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
		  $criteria->addSelectColumn($column);
		}
		
		$criteria->addJoin(CommentsPeer::ID, CommentsI18nPeer::ID);
		$criterion = $criteria->getNewCriterion(CommentsI18nPeer::CULTURE, $culture);
		$criterion->addOr($criteria->getNewCriterion(CommentsI18nPeer::CULTURE, $default_culture));
		$criteria->add($criterion);
		
		$rs = CommentsPeer::doSelectStmt($criteria, $con);
		if ($res = $rs->fetchColumn(0)) {
		  return $res;
		} else {
		  // no rows returned; we infer that means 0 matches.
		  return 0;
		}
	}*/	
	
	public static function getComments( $for, $id ) 
	{
		$c = self::getCommentsCriteria( $for, $id );
		//return CommentsPeer::doSelectWithI18n($c);		
		$c->addJoin(UserPeer::ID, CommentsPeer::USER_ID);
		$c->addJoin( CommentsI18nPeer::ID, CommentsPeer::ID);
		$c->add( CommentsI18nPeer::CULTURE, sfContext::getInstance()->getUser()->getCulture());		

		$c->addSelectColumn(CommentsPeer::ID);
		$c->addSelectColumn(CommentsPeer::CREATED_AT);
		$c->addSelectColumn(CommentsPeer::STATUS);
		$c->addSelectColumn(CommentsI18nPeer::BODY);
		$c->addSelectColumn(UserPeer::NAME);
		$c->addSelectColumn(UserPeer::PROFILE);
		
		$stmt = BasePeer::doSelect($c);
		$comments = array();
        while($row = $stmt->fetch(PDO::FETCH_BOTH)){
            $comments[] = array_change_key_case($row);
        }

		return $comments;
	}
	
	public static function getCommentsCount( $item_type_name, $id ) 
	{
		$c = self::getCommentsCriteria( $item_type_name, $id );
		$c->add(CommentsI18nPeer::CULTURE, sfContext::getInstance()->getUser()->getCulture());
		//return CommentsPeer::doCountWithI18n($c);
		return CommentsI18nPeer::doCountJoinComments($c);
	}	
	
	public static function getCommentsCriteria( $item_type_name, $id, $order = 'desc' ) {
		$c = new Criteria();		
		switch (ucfirst($item_type_name)) {
			/*case self::FOR_IDEA:
				$c->addJoin( Idea2commentsPeer::COMMENTS_ID, CommentsPeer::ID );
				$c->add( Idea2commentsPeer::IDEA_ID, $id );
				break;*/
			case ItemtypesPeer::ITEM_TYPE_NAME_NEWS:
				$c->addJoin( News2commentsPeer::COMMENTS_ID, CommentsPeer::ID );
				$c->add( News2commentsPeer::NEWS_ID, $id );							
				break;
			case ItemtypesPeer::ITEM_TYPE_NAME_PHOTO:
				$c->addJoin( Photo2commentsPeer::COMMENTS_ID, CommentsPeer::ID );
				$c->add( Photo2commentsPeer::PHOTO_ID, $id );							
				break;
			case ItemtypesPeer::ITEM_TYPE_NAME_VIDEO:
				$c->addJoin( Video2commentsPeer::COMMENTS_ID, CommentsPeer::ID );
				$c->add( Video2commentsPeer::VIDEO_ID, $id );							
				break;	
		}		
		//$c->addJoin( UserPeer::ID, CommentsPeer::USER_ID );			
		//$c->add( UserPeer::IS_ACTIVE, 1 );
		$c->add( CommentsI18nPeer::BODY, '', Criteria::NOT_EQUAL );
		$c->add( CommentsPeer::SHOW, 1 );	
		if ($order == 'asc') {
		    $c->addAscendingOrderByColumn( CommentsPeer::CREATED_AT );		
		} else {
		    $c->addDescendingOrderByColumn( CommentsPeer::CREATED_AT );		
		}
		
		return $c;
	}

	/**
	 * Добавление комментария
	 *
	 * @param unknown_type $body - текст
	 * @param unknown_type $to - к чему добавляется комментарий
	 * @param unknown_type $id - ID того, к чему добавляем
	 * @return unknown - результат добавления
	 */
	public static function addComment( $body, $to, $id )
	{
		if ( !UserPeer::authIsLoggedIn() ) {
			return false;
		}
		
		$body = self::processBody($body);
		
	  	// сохранение комментария
  		$comments = new Comments();
  		$comments->setBody( $body );
  		$comments->setUserId( UserPeer::authUserId() );
  		$comments->setCreatedAt( gmdate("Y-m-d H:i:s") );
  		$comments->save();

  		if ($comments->getId()) {
  			
  			$culture = sfContext::getInstance()->getUser()->getCulture();
  			
  			// для удаления кэша
  			//$cacheManager = sfContext::getInstance()->getViewCacheManager();
			//$cacheManager->remove('@sf_cache_partial?module=comments&action=_show&sf_cache_key=*');
			
        	// параметры для формирования ключа
        	//$cache_parameters = 
        	//	'id=' . $id . 
        	//	'&sf_culture=' . sfContext::getInstance()->getUser()->getCulture();
        		
        	// получаем title, если есть
        	if ($_SESSION['loginorsignup_from_location']) {
        		$location = $_SESSION['loginorsignup_from_location'];
        	} else {
        		$location = $_SERVER['REQUEST_URI'];
        	}
        	//if (strstr($location, '/title/')) {
        	//	preg_match("/\/title\/([^#]+)/", $location, $matches);
        	//	$cache_parameters .=  '&title=' . $matches[1];
        	//}
        	// чтобы после входа по loginorsignup кинуло на нужный коммент
        	$location = preg_replace("/#.*/", "", $location);
        	$location = $location . '#comment_' . $comments->getId();
        	$_SESSION['loginorsignup_from_location'] = $location;

	  		// создание связи 
	  		switch (ucfirst($to)) {
	  			case ItemtypesPeer::ITEM_TYPE_NAME_NEWS:
			  		$news2comments = new News2comments();
			  		$news2comments->setCommentsId( $comments->getId() );
			  		$news2comments->setNewsId( $id );
			  		$news2comments->save();			  		
			  		$subscribe_item_type = ItemtypesPeer::ITEM_TYPE_NEWS;
			  		
			  		//$cacheManager->remove('news/show?id=' . $id . '*');			  		
			  		//$cacheManager->remove('news/teachings_show?id=' . $id . '*');			  		
			  		//$cacheManager->remove('news/show?' . $cache_parameters );		
                    //foreach (NewstypesPeer::$type_names as $name) {
                    //    $cacheManager->remove('news/' . $name . '_show?' . $cache_parameters );			  		    
                    //}
			  		break;
				case ItemtypesPeer::ITEM_TYPE_NAME_PHOTO:
			  		$photo2comments = new Photo2comments();
			  		$photo2comments->setCommentsId( $comments->getId() );
			  		$photo2comments->setPhotoId( $id );
			  		$photo2comments->save();			  		
			  		$subscribe_item_type = ItemtypesPeer::ITEM_TYPE_PHOTO;
			  		
			  		//$cacheManager->remove('photo/show?id=' . $id . '*');
			  		//$cacheManager->remove('photo/show?' . $cache_parameters);
			  		break;	
				case ItemtypesPeer::ITEM_TYPE_NAME_VIDEO:
			  		$video2comments = new Video2comments();
			  		$video2comments->setCommentsId( $comments->getId() );
			  		$video2comments->setVideoId( $id );
			  		$video2comments->save();
			  		$subscribe_item_type = ItemtypesPeer::ITEM_TYPE_VIDEO;
			  		
			  		//$cacheManager->remove('video/show?id=' . $id . '*');
			  		//$cacheManager->remove('video/show?' . $cache_parameters);
			  		break;				  		
			    default: 
			    	return false;			    	
	  		}
	  		
	  		// очищаем кэш
	  		//$cacheManager = sfContext::getInstance()->getViewCacheManager();
			//$cacheManager->remove('@sf_cache_partial?module=comments&action=_show&sf_cache_key=*');
			$cacheManager = sfContext::getInstance()->getViewCacheManager();
			$cache_parameters = array( 'for'=>strtolower($to), 'id'=>$id . '', 'culture'=>$culture );
			$sf_cache_key = $cacheManager->computeCacheKey( $cache_parameters );
			$cacheManager->remove('@sf_cache_partial?module=comments&action=_show&sf_cache_key=' . $sf_cache_key);	

	  		// подписываем пользователя на созданный элемент		   
			SubscribePeer::addSubscribe( 
				UserPeer::authUserId(), 
				$id, 
				$subscribe_item_type, 
				$culture );
			// уведомляем подписавшихся о новом комментарии
			SubscribePeer::alertSubscribers( 
				$id, 
				$subscribe_item_type, 
				UserPeer::authUserId(), 
				$culture );
			return $comments->getId();
  		} else {
  			return false;
  		}
	}
	
	/**
	 * Обработка комментария перед сохранением
	 *
	 * @param unknown_type $body
	 */
	public static function processBody($body)
	{
	    //$body = preg_replace("/(\r\n)/")
	    return $body;
	}
	
	public static function prepareBody($body, $splitter = '<br /><br />')
	{	    
	    return preg_replace("/(\n|\r\n)+/", $splitter, trim($body));
	}
	
	/**
	 * ID страницы для систем комментирования, пример:
	 * '/cs/photo/show/502'
	 *
	 * @return unknown
	 */
	public static function getCommentsIdentifier($culture = '', $module = '', $action = '', $parameters = array())
	{
		if (!$culture || !$module || !$action) {
			
			$sf_context  = sfContext::getInstance();
			$culture	 = $sf_context->getUser()->getCulture();			
		  	$module    	 = $sf_context->getModuleName();
		  	// для Учений - хардкод
		  	
			if ($module == 'news') {
				$action = 'show';
			} else {
				$action      = $sf_context->getActionName();
			}
		  	
		  	$parameters  = array('id' => $sf_context->getRequest()->getParameter('id'));
		}
		$identifier = 	'/' . $culture . '/' . $module . '/' . $action;
		foreach ($parameters as $k=>$v) {
			if ($v) {
				$identifier .= '/' . $k . '/' . $v;
			}
		}
		return $identifier;
	}

	
	
}
