<?php if ($newsitem && $newsitem->getBody() != ''): ?>	
	<p class="p1_no_top">
		<?php echo html_entity_decode($newsitem->getBodyPrepared() ); ?>
	</p>			
<?php endif ?>