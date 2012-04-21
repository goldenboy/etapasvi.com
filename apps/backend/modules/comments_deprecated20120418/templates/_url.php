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
	$url = '/' . $comment_culture . '/news/show/id/' . $news2comments->getNewsId();
}

// photo
if (!$url) {
	$c = new Criteria();
	$c->add(Photo2commentsPeer::COMMENTS_ID, $comments->getId());
	$photo2comments = Photo2commentsPeer::doSelectOne( $c );

	if ($photo2comments) {
		$url = '/' . $comment_culture . '/photo/show/id/' . $photo2comments->getPhotoId();
	}	
}

// video
if (!$url) {
	$c = new Criteria();
	$c->add(Video2commentsPeer::COMMENTS_ID, $comments->getId());
	$video2comments = Video2commentsPeer::doSelectOne( $c );

	if ($video2comments) {
		$url = '/' . $comment_culture . '/video/show/id/' . $video2comments->getVideoId();
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
