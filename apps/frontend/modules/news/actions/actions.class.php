<?php

/**
 * idea actions.
 *
 * @package    sf_sandbox
 * @subpackage idea
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class newsActions extends sfActions
{
 
  public function executeShow(sfWebRequest $request)
  {
  	$this->id 	 = $request->getParameter('id');
  	$this->title = $request->getParameter('title');
  	/*
  	$this->newsitem = NewsPeer::retrieveByPk( $request->getParameter('id') );
  	$this->forward404Unless( $this->newsitem && $this->newsitem->getBody() );
  	//if ( sfConfig::get('sf_environment') == 'prod' ) {
    $this->forward404Unless( $this->newsitem->getShow() );
    //}
  	$news_title = $this->newsitem->getTitle();
  	if ( $news_title ) {
  	  // если на страницу перешли с другого языка, то title неверный
  	  $news_title_translit = TextPeer::urlTranslit($news_title);
  	  if ( $news_title_translit && $request->getParameter('title') != $news_title_translit ) {
  		$this->redirect( $this->newsitem->getTypeName() . '/show?id=' . (int)$request->getParameter('id') . '&title=' . $news_title_translit );
  	  }
  		
	  $context = sfContext::getInstance();
	  $i18n =  $context->getI18N();
	
	  $title = $i18n->__('Dharma Sangha') . ' -';
	  $response = $this->getResponse(); 
	  $response->setTitle($title . ' ' . $news_title . ' - eTapasvi.com');
  	}*/
  	/*
  	// получаем привязанные Видео
  	$c = new Criteria();
  	$c->add( News2videoPeer::NEWS_ID, $request->getParameter('id') );
  	$c->addJoin( VideoPeer::ID, News2videoPeer::VIDEO_ID );
  	$c->addJoin( VideoI18nPeer::ID, VideoPeer::ID );
  	$c->add( VideoI18nPeer::CODE, '', Criteria::NOT_EQUAL );
  	$c->add( VideoI18nPeer::CULTURE, sfContext::getInstance()->getUser()->getCulture() );

  	$this->video_list = News2videoPeer::doSelect($c);  	
  	
  	// получаем привязанные Фотоальбомы
  	$c = new Criteria();
  	$c->add( News2photoalbumPeer::NEWS_ID, $request->getParameter('id') );
  	$c->addJoin( PhotoalbumPeer::ID, News2photoalbumPeer::PHOTOALBUM_ID );
  	$c->add( PhotoalbumPeer::SHOW, 1 );

  	$this->photoalbum_list = News2photoalbumPeer::doSelect($c);	*/
  	  	
  	// ссылка назад
  	//if ($_SESSION['back_to_news'] != '') {
  	//  $this->back_to_news = $_SESSION['back_to_news'];
  	//}  	  	  	
  }  
  
  public function executePreview(sfWebRequest $request)
  {
  	$this->id 	 = $request->getParameter('id');
  	$this->title = $request->getParameter('title'); 
    $this->setTemplate('show');	
  }  
  
  /**
   * Список новостей
   *
   * @param sfWebRequest $request
   */
  public function executeIndex(sfWebRequest $request)
  {  	

    $c = $this->getIndexCriteria();
    
	$pager = new sfPropelPagerI18n('News', NewsPeer::NEWS_PER_PAGE);
	
	//$c->add(constant('News' . 'I18nPeer::CULTURE'), sfContext::getInstance()->getUser()->getCulture());
	
    $pager->setCriteriaI18n($c);
    $pager->setPage($this->getRequestParameter('page', 1));
    $pager->init();
    $this->pager = $pager;
    
    // если передан номер страницы больше, чем имеется страниц
    if ($request->getParameter('page') > $this->pager->getLastPage()) {
    	$this->forward404();
    }
    
    // формируем заголовок
    /*$context = sfContext::getInstance();
	$i18n =  $context->getI18N();
    
    $news_type = ucfirst($this->getRequestParameter('type'));
    if (!$news_type) {
        $news_type = 'News';
    }
      
    $response = $this->getResponse(); 
    $response->setTitle($i18n->__('Dharma Sangha') . ' - ' . $i18n->__($news_type) . ' - eTapasvi.com');    */
  }
  
  /**
   * Список Учений
   *
   * @param sfWebRequest $request
   */
  public function executeTeachings(sfWebRequest $request)
  {
  	$this->executeIndex($request);
  }
  
  /**
   * Учение
   *
   * @param sfWebRequest $request
   */
  public function executeTeachings_show(sfWebRequest $request)
  {
  	$this->executeShow($request);
  }
  
  /**
   * Получения условия для выбора списка новостей
   *
   * @return unknown
   */
  private function getIndexCriteria()
  {
    $c = new Criteria();
    $c->add( NewsPeer::SHOW, 1);
    //$c->add( NewsI18nPeer::BODY, '', Criteria::NOT_EQUAL );      
    NewsPeer::addVisibleCriteria( $c );
    $c->addDescendingOrderByColumn( NewsPeer::ORDER );
    
    if ($this->getRequestParameter('type')) {
        $c->addJoin( NewstypesPeer::ID, NewsPeer::TYPE );
        $c->add( NewstypesPeer::NAME, $this->getRequestParameter('type') );
    }
    
    return $c;
  }
  
  public function executeMain(sfWebRequest $request)
  {
  	/*if (IdeaPeer::isThinkingNow()) {
      $this->best_idea = IdeaPeer::getBestIdea();
  	}*/
  }
  
  public function executeRss(sfWebRequest $request)
  {  	  	
  	$this->getResponse()->setHttpHeader('Content-type', 'text/xml; charset=UTF-8');  	
  	
  	// получаем элементы в $this->feed_list
  	self::getFeed($request, true);
  	
  	$user_culture = $this->getUser()->getCulture();
  	 	
  	$this->link 			 = UserPeer::SITE_ADDRESS;
  	$this->last_build_date   = date( 'r', time());
  	$this->language          = UserPeer::getCultureIso( $user_culture );
  	
  	$items = array();
	foreach ($this->feed_list as $group) {
	  foreach ($group['list'] as $item) {
	  	 $link    = $item->getRssLink();
	  	 
	  	 // description
	  	 $description = $item->getRssDescription();
	  	 if ($group['type'] != ItemtypesPeer::ITEM_TYPE_NAME_PHOTO && 
	  	     $group['type'] != ItemtypesPeer::ITEM_TYPE_NAME_VIDEO && $description
	  	 ) {
	  	 	$description = strip_tags( $description ) . '...';
	  	 } 
	  	
	     $items[] = array(
	       'title' 	     => $item->getRssTitle(),
	       'link'  	     => $link,
	       'guid'    	 => $link,
	       'description' => $description,
	       'pub_date'    => date("r", strtotime($item->getRssPubDate()))
	    );
	  }
	}
	$this->items = $items;  	
  }
  
  /**
   * Обновления
   *
   * @param sfWebRequest $request
   */
  public function executeFeed(sfWebRequest $request)
  {  	
	self::getFeed($request);
  }
  
  /**
   * Получение Ленты обновлений
   *
   * @param получение элементов для RSS $rss
   */
  public function getFeed( sfWebRequest $request, $rss = false )
  {  	
	$this->feed_list 	 = array();
	$limit_start 		 = 0;
	$feed_items_per_page = NewsPeer::FEED_ITEMS_PER_PAGE;
	// кол-во страниц влево и вправо от текущей
	$plus_digits 		 = 5;
  	
	// навигация
	$this->page = (int)$request->getParameter('page');
	if ($this->page < 1) {
		$this->page = 1;
	}
	
	$con = Propel::getConnection();
 /*
SELECT
    id, item_type, updated_at
FROM (SELECT news.id, updated_at, 'News' as item_type FROM `news`, `news_i18n` WHERE news.SHOW=1 AND news_i18n.BODY<>'' and news_i18n.id = news.id
                       and news_i18n.culture = 'ru' UNION SELECT photo.id, updated_at, 'Photo' as item_type FROM `photo` WHERE photo.SHOW=1 AND photo.IMG<>'' AND photo.FULL_PATH<>'' AND photo.PREVIEW_PATH<>'' AND photo.THUMB_PATH<>'' UNION SELECT photo.id, updated_at, 'Photo' as item_type FROM `photo` WHERE photo.SHOW=1 AND photo.IMG<>'' AND photo.FULL_PATH<>'' AND photo.PREVIEW_PATH<>'' AND photo.THUMB_PATH<>'' UNION SELECT video.id, updated_at, 'Video' as item_type FROM `video`, `video_i18n` WHERE video.SHOW=1 AND video_i18n.CODE<>'' and video_i18n.id = video.id
                       and video_i18n.culture = 'ru' UNION SELECT audio.id, updated_at, 'Audio' as item_type FROM `audio` WHERE audio.SHOW=1 AND audio.REMOTE<>'' AND audio.FILE<>'') as feed
ORDER BY
    updated_at DESC
LIMIT 0, 50

	$sql = "SELECT SUM(".LetterBannerPeer::VIEWS.") AS view_total,
		SUM(".LetterBannerPeer::CLICKS.") AS click_total
		FROM ".LetterBannerPeer::TABLE_NAME."
		WHERE ".LetterBannerPeer::LETTER." = ?
		AND ".LetterBannerPeer::REGION_ID." = ?
		GROUP BY (".LetterBannerPeer::LETTER.")";*/
 	
 	// Добавляем SELECT'ы выбора элементов
	$sub_query = '';
    $sub_query_counter = 0;
    
    // добавляем в ваборку каждый тип элемента
	foreach (NewsPeer::$feed_item_types as $type) {
	  $table_name = strtolower($type);
	  $c = new Criteria();
	  
	  // для RSS вызывается специальный метод, т.к. Фото без названий не должны показываться
	  if (!$rss) {
	    $fn = array($type . 'Peer', 'addVisibleCriteria');
	  } else {
	  	$fn = array($type . 'Peer', 'addVisibleCriteria');
	  }	  
	  
	  try {
	    call_user_func( $fn, $c );  	

	    $criteria_string = $c->toString();

	  	// Criteria:
		// SQL (may not be complete): SELECT  FROM `news`, `news_i18n` WHERE news.SHOW=:p1 AND news_i18n.BODY<>:p2
		// Params: news.SHOW => 1, news_i18n.BODY => '' 
	    if (!$criteria_string) {
	  	  continue;
	    }
	    $criteria_sql_list = explode("\n", $criteria_string);  	    
	    $criteria_sql      = str_replace('SQL (may not be complete): ', '', $criteria_sql_list[1]);
	    
	    // если в условии нет таблицы i18n, добавляем, чтобы получить updated_at_extra
	    if (!strstr($criteria_sql, '_i18n')) {
	    	$criteria_sql = str_replace('FROM ', "FROM {$table_name}_i18n, ", $criteria_sql);
	    }	    
	    
	    // прописываем выбираемые параметры
	    $criteria_sql      = str_replace(
	    	'SELECT  FROM', 
	    	"SELECT {$table_name}.id, if({$table_name}.updated_at > {$table_name}_i18n.updated_at_extra, {$table_name}.updated_at, {$table_name}_i18n.updated_at_extra) as updated_at, '" 
	    	. $type . "' as item_type FROM", 
	    	$criteria_sql
		);
		
	    //if (strstr($criteria_sql, '_i18n')) {
    	$criteria_sql .= " and {$table_name}_i18n.id = {$table_name}.id 
    					   and {$table_name}_i18n.culture = '" .  sfContext::getInstance()->getUser()->getCulture() . "'";
	    //}
	    
	    // для RSS 
	    if ($rss) {
	    	// ограничиваем по дате
	    	$criteria_sql .= " and updated_at >= '" . date("Y-m-d H:i:s", strtotime(NewsPeer::RSS_PERIOD)) . "' ";
	    	// выбираются только элементы с заголовками
	    	$criteria_sql .= " and {$table_name}_i18n.title != '' ";
	    }
		
	    // получаем значения параметров
	    preg_match_all("/ => ([^,]+)/", $criteria_sql_list[2], $criteria_params);
	    foreach ($criteria_params[1] as $i=>$param) {
	      $criteria_sql = str_replace(':p' . ($i + 1), $param, $criteria_sql);
	    }	    
	    
	    if ($sub_query_counter > 0) {
	      $sub_query .= ' UNION ';
	    }
	    $sub_query .= $criteria_sql;
	  } catch (Exception $e) {
	  	continue;
	  }
	  $sub_query_counter++;
	}

	// подсчитываем кол-во
	$query_count = "
	 	SELECT count(*) as count
		FROM ({$sub_query}) as feed"; 	
 	// выполняем сформированный запрос
 	try {
	  $stmt = $con->prepare($query_count);
	
	  // ограничиваем кол-во записей
	  //$stmt->bindValue(1, 0); 
	  //$stmt->bindValue(2, 20); 
	
	  if ($stmt->execute()) {
	    $count_items = $stmt->fetch();
	  }
 	} catch (Exception $e) {
		return;
	}

	
	// получение списка
	$query_list = "
	 	SELECT
		    id, item_type, updated_at
		FROM 
			({$sub_query}) as feed
		ORDER BY
		    updated_at DESC";
	
	// для RSS используется ограничение по дате, поэтому не используем LIMIT
	if (!$rss) {
	  $this->last_page = ceil($count_items['count'] / $feed_items_per_page);
	  $limit_start 	 = ($this->page-1) * $feed_items_per_page;
	  
	  $query_list .= " 
	  	LIMIT {$limit_start}, {$feed_items_per_page}";	  
	}

 	// выполняем сформированный запрос
 	try {
	  $stmt = $con->prepare($query_list);
	
	  // ограничиваем кол-во записей
	  //$stmt->bindValue(1, 0); 
	  //$stmt->bindValue(2, 20); 
	
	  if ($stmt->execute()) {
	    $all_items = $stmt->fetchAll();
	  }
 	} catch (Exception $e) {
		return;
	}
	
	// группируем элементы по типам
	$grouped_items = array();
	foreach ($all_items as $i=>$item) {

	  if ($i != 0 && $item['item_type'] == $all_items[$i - 1]['item_type']) {
	    // добавляем в предыдущую группу
	    $grouped_items[ count($grouped_items) - 1 ]['list'][] = $item['id'];
	  } else {
	    // создаём новую группу
	    $grouped_items[] = array('type'=>$item['item_type'], 'list'=>array($item['id']));
	  }
	}

	// выбираем объекты из БД
	foreach ($grouped_items as $group) {
		// получаем тип элементов группы по первому элементу группы
		$type = $group['type'];
		
		// Использование строки, как имени статического класса позволяет только PHP > 5.3, поэтому хардкодим
		$c = new Criteria();
		$c->add( strtolower($type) . '.ID', $group['list'], Criteria::IN);
		//$c->addDescendingOrderByColumn( strtolower($type) . '.UPDATED_AT' );
		
		$fn = array($type . 'Peer', 'doSelectWithI18n');
	    try {
	      $list = call_user_func( $fn, $c ); 
	    } catch (Exception $e) {
	      echo $e->getMessage();
	      continue;
	    }

	    // упорядочиваем элементы в списке по из ID
	    $list_sorted = array();
	    foreach ($group['list'] as $id) {
	    	foreach ($list as $list_item) {
	    		if ($list_item->getId() == $id) {
	    			$list_sorted[] = $list_item;
	    			break;
	    		}
	    	}
	    }
	    
		$this->feed_list[] = array('type'=>$type, 'list'=>$list_sorted);
	}
	
	// список номеров страниц навигации - 5 влево и вправо от текущей страницы
	$this->page_numbers_list = array();
	for($i = $this->page - $plus_digits; $i < $this->page + $plus_digits; $i++) {
	  if ($i < 1) {
		continue;
	  }
	  if ($i > $this->last_page) {
		break;
	  }	
	  $this->page_numbers_list[] = $i;	  	
	}	
  }
  
}