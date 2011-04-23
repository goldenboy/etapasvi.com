<?php
$cur_culture = $sf_user->getCulture();
foreach (UserPeer::getCultures()as $culture) {
	$sf_user->setCulture( $culture );

	$body = $photo2comments->getComments()->getBody();
	if ($body != '') {
		break;
	}
}
$sf_user->setCulture( $cur_culture );
?>

<a href="<?php
echo $_SERVER['SCRIPT_NAME'] . '/comments/edit/id/' . $photo2comments->getCommentsId();
?>" target="_blank"><?php echo $body ?></a>