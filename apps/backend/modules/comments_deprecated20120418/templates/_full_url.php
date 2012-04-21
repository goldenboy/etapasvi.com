<?php
$cur_culture = $sf_user->getCulture();
foreach (UserPeer::getCultures()as $culture) {
	$sf_user->setCulture( $culture );
	
	if ($comments->getBody() != '') {
		$comment_culture = $culture;
		break;
	}
}
$sf_user->setCulture( $cur_culture );

// news
$c = new Criteria();
$c->add(News2commentsPeer::COMMENTS_ID, $comments->getId());
$news2comments = News2commentsPeer::doSelectOne( $c );

if ($news2comments) {	

    $news = $news2comments->getNews();
    $url = $news->getUrl( $comment_culture );
}

// photo
if (!$url) {
	$c = new Criteria();
	$c->add(Photo2commentsPeer::COMMENTS_ID, $comments->getId());
	$photo2comments = Photo2commentsPeer::doSelectOne( $c );

	if ($photo2comments) {		
        $news = $photo2comments->getPhoto();
        $url = $news->getUrl( $comment_culture );
	}	
}

// video
if (!$url) {
	$c = new Criteria();
	$c->add(Video2commentsPeer::COMMENTS_ID, $comments->getId());
	$video2comments = Video2commentsPeer::doSelectOne( $c );

	if ($video2comments) {
        $news = $video2comments->getVideo();
        $url = $news->getUrl( $comment_culture );
	}	
}

// idea
/*
if (!$url) {
	$c = new Criteria();
	$c->add(Idea2commentsPeer::COMMENTS_ID, $comments->getId());
	$idea2comments = Idea2commentsPeer::doSelectOne( $c );

	if ($idea2comments) {
		$url = '/' . $comment_culture . '/idea/details/id/' . $idea2comments->getIdeaId();
	}	
}*/

//$url = '/comments/edit/id/' . $news2comments->getCommentsId();
echo $url;
