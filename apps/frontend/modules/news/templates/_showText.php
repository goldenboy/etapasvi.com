<?php if ($newsitem && $newsitem->getBody() != ''): ?>		
	<?php echo html_entity_decode($newsitem->getBodyPrepared() ); ?>
	<br/><br/>			
<?php endif ?>