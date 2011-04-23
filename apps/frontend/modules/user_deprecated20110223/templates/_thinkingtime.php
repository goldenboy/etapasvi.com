<div id="thinking_time">
	<?php echo __('Hello') ?>,<br/><strong><a href="<?php echo url_for('@user_profile', true); ?>" title="<?php echo __('Your Idea for Meditation') ?>" ><?php echo $user_name; ?>!</a></strong>
    <br/><br/>
    <a href="#" title="<?php echo __('Logout') ?>" class="logout"><?php echo __('Logout') ?></a>

<?php /*
	<br/>
	<br/>
	<?php echo __('Time for thinking') ?>:
	<br/>
	<p class="no_decor day_of_week">
		<a href="<?php echo url_for('@best_idea'); ?>" >
			<?php //echo format_date( $thinking_time, 'EEEE' ); ?>

			<?php echo format_date( $thinking_time, 'd MMMM yyyy' ); ?>
			<br/>
			<?php echo __('at') ?> 
			<?php if ($sf_user->getCulture() == 'ru'): ?>
				<?php echo format_date( $thinking_time, 'HH:mm' ); ?>
			<?php else: ?>
				<?php echo format_date( $thinking_time, 'h:mm a' ); ?>
			<?php endif ?>
		</a>
	</p>

*/
?>
</div>