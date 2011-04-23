<?php slot('body_id') ?>body_ideaoftheweek<?php end_slot() ?>

<h1><?php echo __('Idea of the Week') ?></h1>
<h2><?php echo __('What is this') ?>?</h2>

<p class="center_text p1_no_bottom">
	<?php echo __('Our thoughts are powerful. One man alone can do') ?> <a href="<?php echo url_for('@intro', true); ?>" title="<?php echo __('Meditating Buddha Boy') ?>"><?php echo __('miracles') ?></a> <?php echo __('using power of thought') ?>.
</p>
<p class="center_text">
	<?php echo __('What would happen if a lot of') ?> <a href="<?php echo url_for('@index_idea', true); ?>" title="<?php echo __('Meditation Ideas') ?>"><?php echo __('people') ?></a> <?php echo __("think about the same at one time? Let's check out") ?>!
</p>
<p class="center_text">
	<?php echo __('This is global experiment, flashmob, collective consciousness, world meditation.') ?>
</p>
<p class="p1 center_text">
	<?php echo __('Spread the message of World Peace to all') ?>!
</p>

<?php if ( !empty($best_idea) ): ?>
	<p class="error_list p1_no_bottom center_text">
		<?php echo __('Time for thinking has come') ?>!
	</p>
	<p class="error_list center_text">
		<?php echo __('Please send this link to your relatives and friends') ?>: <strong>http://www.etapasvi.com</strong>
	</p>
	<?php include_component('idea', 'show', array('idea'=>$best_idea, 'from'=>'best', 'isthinkingnow'=>true)) ?>
	<br/>
<?php else: ?>
	<?php include_component( 'user', 'actions' ); ?>
<?php endif ?>

<h3 class="low_h"><?php echo __('How it Works') ?></h3>
<ul class="in_text">		
	<li><?php echo __('Every week you offer') ?> <a href="<?php echo url_for('@show_idea', true); ?>" title="<?php echo __('Offer Idea for Meditation') ?>"><?php echo __('new Idea') ?></a>.
<?php echo __('You can offer') ?> <acronym title="<?php echo __("'Help my friend to survive after crash' or 'Stop Killing Animals for Fur'") ?>"><?php echo __('any Ideas') ?></acronym> 
	<?php echo __('excepting') ?> <acronym title="<?php echo __('causing harm to someone') ?>"><?php echo __('negative Ideas') ?></acronym>.</li>
	<li>
		<?php echo __('Every week you') ?> <a href="<?php echo url_for('@index_idea', true); ?>" title="<?php echo __('Vote for Idea') ?>"><?php echo __('choose') ?></a> <?php echo __('the best one') ?>.
	</li>
	<li>
		<?php echo __('Every week we together think of one Idea at one time') ?>.
	</li>
</ul>

<h3><?php echo __('When time for thinking has come') ?>:</h3>
<ol>
	<li><?php echo __('Check') ?> <a href="<?php echo url_for('@best_idea', true); ?>" title="<?php echo __('Best meditation idea') ?>"><?php echo __('the best Idea') ?></a> <?php echo __('of the week.') ?></li>
	<li><?php echo __('Try to imagine the benefit of this Idea for all beings') ?>...</li>
	<li><?php echo __('Think about this Idea for a few minutes dedicating the positive energy') ?>.</li>	
</ol>