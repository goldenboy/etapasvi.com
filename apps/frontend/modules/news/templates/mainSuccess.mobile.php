<?php slot('body_id') ?>body_main<?php end_slot() ?>

<div id="menu">
<?php include_partial('global/menu', array('body_id'=>$body_id /*, 'is_logged_in'=>UserPeer::authIsLoggedIn()*/) ); ?>	
</div>