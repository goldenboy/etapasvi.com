<ul id="actions" <?php if ($isLoggedIn): ?>class="logged_in"<?php endif ?> >
	<?php if ($isLoggedIn): ?>
		<li>
			<a href="<?php echo url_for('@index_idea', true); ?>" title="<?php echo __('Ideas') ?>">
				<img src="/images/ideas.png" alt="<?php echo __('Ideas') ?>" />
			</a>
			<br/>
			<a href="<?php echo url_for('@index_idea', true); ?>" title="<?php echo __('All Ideas') ?>">
				<?php echo __('All Ideas') ?>
			</a>
		</li>
	<?php else: ?>
		<li>
			<a href="<?php echo url_for('@user_login', true); ?>" title="<?php echo __('Login') ?>">
				<img src="/images/login.png" alt="<?php echo __('Login') ?>" />
			</a>
			<br/>
			<a href="<?php echo url_for('@user_login', true); ?>">
				<?php echo __('Login') ?>
			</a>
		</li>
	<?php endif ?>

	<?php if ($isLoggedIn): ?>
		<li>
			<a href="<?php echo url_for('@best_idea', true); ?>" title="<?php echo __('Best Idea') ?>">
				<img src="/images/best_idea.png" alt="<?php echo __('Best Idea') ?>" />
			</a>
			<br/>
			<a href="<?php echo url_for('@best_idea', true); ?>">
				<?php echo __('Best') ?>
			</a>
		</li>
	<?php else: ?>
		<li>
			<a href="<?php echo url_for('@user_signup', true); ?>" title="<?php echo __('Sign up') ?>">
				<img src="/images/signup.png" alt="<?php echo __('Sign up') ?>" />
			</a>
			<br/>
			<a href="<?php echo url_for('@user_signup', true); ?>">
				<?php echo __('Sign up') ?>
			</a>
		</li>
	<?php endif ?>

	<?php if ($isLoggedIn): ?>
		<li>
			<a href="<?php echo url_for('@show_idea', true); ?>" title="<?php echo __('Your Idea') ?>">
				<img src="/images/idea.png" alt="<?php echo __('Your Idea') ?>" />
			</a>
			<br/>
			<a href="<?php echo url_for('@show_idea', true); ?>">
				<?php echo __('My') ?>
			</a>
		</li>
	<?php else: ?>
		<li>
			<a href="<?php echo url_for('@index_idea', true); ?>" title="<?php echo __('Ideas') ?>">
				<img src="/images/ideas.png" alt="<?php echo __('Ideas') ?>" />
			</a>
			<br/>
			<a href="<?php echo url_for('@index_idea', true); ?>">
				<?php echo __('Ideas') ?>
			</a>
		</li>
	<?php endif ?>

</ul>