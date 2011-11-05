<?php 
    $url = 'http://' . UserPeer::DOMAIN_NAME_MAIN . '/' . $revisionhistory->getPageMnemonicCulture() . '/revision/' . $revisionhistory->getId(); //$revisionhistory->getUrl();
	echo '<a href="' . $url . '" target="_blank">' . $url . '</a>';
?>
