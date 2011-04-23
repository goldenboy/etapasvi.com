<?php if ($idea): ?>

	<?php if ($from == 'archive'): ?>
		<?php $read_more = url_for('idea/archivedetails?id='.$idea->getId()); ?>
	<?php else: ?>
		<?php $read_more = url_for('idea/details?id='.$idea->getId()); ?>
	<?php endif ?>
	
	<div class="box <?php if ($isthinkingnow): echo 'error'; endif ?>">		

		<div class="idea_toolbar">
			<div class="votes_container">
				<span class="date"><?php echo __('Votes') ?>:</span> 
				<span id="idea_votes_<?php echo $idea->getId(); ?>" class="vote_value"><?php echo (int)$idea->getVotes(); ?></span>
			</div>
			<?php if (!$noLinks): ?>		
				<?php if ($voteLink): ?>
					<div id="idea_vote_<?php echo $idea->getId(); ?>" class="idea_action action_vote" onclick="ideaVote( '<?php echo $idea->getId(); ?>', '<?php echo $voteLink; ?>')" ></div>
				<?php else: ?>
					<div id="idea_vote_<?php echo $idea->getId(); ?>" class="idea_action action_vote_disabled"></div>
				<?php endif ?>
				<?php if ($reportAbuseLink): ?>
					<div id="idea_report_abuse_<?php echo $idea->getId(); ?>" class="idea_action action_abuse" onclick="ideaReportAbuse( '<?php echo $idea->getId(); ?>', '<?php echo $reportAbuseLink; ?>')" ></div>
				<?php else: ?>
					<div id="idea_report_abuse_<?php echo $idea->getId(); ?>" class="idea_action action_abuse_disabled"></div>
				<?php endif ?>
			<?php endif ?>			


		</div>

		<p>
			<?php echo str_ireplace( '&lt;br /&gt;', '&nbsp;</p><p>', $idea->getBodyPrepared($short) ); ?>&nbsp;
		</p>
		
		<div class="box_status">
			<div class="right">
				<span class="small">
					<a href="<?php echo UserPeer::getUserPhpbbUrl( $idea->getUser()->getPhpbbId() ); ?>" target="_blank"><?php echo $idea->getUser(); ?></a>
				</span>
				<span class="date">(<?php echo format_datetime( $idea->getCreatedAt(), 'd MMMM yyyy H:mm') ?>)</span>
			</div>
			<?php if ($short): ?>
				<a href="<?php echo $read_more; ?>" title="<?php echo __('Show Medtation Idea') ?>" class="read_more">
					<img src="/images/read_more.png" alt="<?php echo __('Read more') ?>"/> <?php echo __('Read more') ?>
				</a>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<img src="/images/comments.png" alt="comments" />
				<?php echo __('Comments') ?>: <a href="<?php echo $read_more; ?>" title="<?php echo __('Meditation Idea Comments') ?>">
				<?php echo $idea->getCommentsCount(); ?>
				</a>
			<?php endif ?>
		</div>
	</div>
<?php endif ?>