<?php 
    $url = 'http://' . UserPeer::DOMAIN_NAME_MAIN . $revisionhistory->getPageMnemonic();
	echo '<a href="' . $url . '" target="_blank">' . $revisionhistory->getPageMnemonic() . '</a>';
?>
