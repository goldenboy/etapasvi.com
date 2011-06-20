<ul>
		<li><a href="<?php echo url_for('@main', true); ?>" title="<?php echo __('Home') ?>" id="mi_main"><?php echo __('Home') ?></a></li>
	<?php /*</ul>
	<h3><?php echo __('Dharma Sangha') ?></h3> 
	<ul>*/ ?>
		<?php /*<li><a href="<?php echo url_for('@intro', true); ?>" title="<?php echo __('Buddha Boy Nepal') ?>" id="mi_intro"><?php echo __('Intro') ?></a></li> */ ?>
        		<li><a href="<?php echo url_for('@biography', true); ?>" title="<?php echo __('Om Namo Guru Buddha Gyani Biography') ?>" id="mi_bio"><?php echo __('Biography') ?></a></li>
		<li><a href="<?php echo url_for('@news_index', true); ?>" title="<?php echo __('Buddha Boy News') ?>" id="mi_news"><?php echo __('News') ?></a></li>
		<li><a href="<?php echo url_for('@photo_albums', true); ?>" title="<?php echo __('Palden Dorje Photo') ?>" id="mi_photo"><?php echo __('Photo') ?></a></li>
		<li><a href="<?php echo url_for('@video_index', true); ?>" title="<?php echo __('Ram Bahadur Bomjan Video') ?>" id="mi_video"><?php echo __('Video') ?></a></li>
		<li><a href="<?php echo url_for('@audio_index', true); ?>" title="<?php echo __('Audio') ?>" id="mi_audio"><?php echo __('Audio') ?></a></li>
        <li><a href="<?php echo url_for('@teachings_index', true); ?>" title="<?php echo __('Teachings') ?>" id="mi_teachings"><?php echo __('Teachings') ?></a></li>
        <li><a href="<?php echo url_for('@feed', true); ?>" title="<?php echo __('Feed') ?>" id="mi_feed"><?php echo __('Feed') ?></a></li>
		<li><a href="<?php echo url_for('@faq', true); ?>" title="<?php echo __('FAQ') ?>" id="mi_faq"><?php echo __('FAQ') ?></a></li>
		<li><a href="<?php echo url_for('@blessing', true); ?>" title="<?php echo __('Blessing') ?>" id="mi_blessing"><?php echo __('Blessing') ?></a></li>
		<li><a href="<?php echo url_for('@project', true); ?>" title="<?php echo __('Dharma Hall') ?>" id="mi_project"><?php echo __('Dharma Hall') ?></a></li>
		<li><a href="<?php echo url_for('@religious_forest', true); ?>" title="<?php echo __('Religious Forest') ?>" id="mi_religious_forest"><?php echo __('Religious Forest') ?></a></li>
		<li><a href="<?php echo url_for('@encyclopedia', true); ?>" title="<?php echo __('Encyclopedia') ?>" id="mi_encyclopedia"><?php echo __('Encyclopedia') ?></a></li>
        <li><a href="<?php echo url_for('@donation', true); ?>" title="<?php echo __('Donation') ?>" id="mi_donation" x><?php echo __('Donation') ?></a></li>
		<?php /*<li><a href="<?php echo url_for('@livestream', true); ?>" title="<?php echo __('Buddha Boy Live Stream') ?>" id="mi_livestream"><?php echo __('Live Stream') ?></a></li>	*/ ?>
		<?php /* <li><a href="<?php echo url_for('@translation_fundraising', true); ?>" title="<?php echo __('Buddha Boy Live Stream') ?>" id="mi_ltj_fundraising"><?php echo __('Translation Fundraising') ?></a></li>	*/ ?>

	<?php /*</ul>

	<h3><?php echo __('Member') ?></h3> 
	<ul>
		<?php if (!UserPeer::authIsLoggedIn() ): ?>
			<li><a href="<?php echo url_for('@user_signup', true); ?>" title="<?php echo __('Sign up') ?>" id="mi_signup"><?php echo __('Sign up') ?></a></li>		
			<li><a href="<?php echo url_for('@user_login', true); ?>" title="<?php echo __('Login') ?>" id="mi_login"><?php echo __('Login') ?></a></li>
        <?php else: ?>
			<li><a href="<?php echo url_for('@user_profile', true); ?>" title="<?php echo __('Edit profile') ?>" id="mi_profile"><?php echo __('Profile') ?></a></li>
			<li>
				<a href="#" title="<?php echo __('Logout') ?>" id="mi_logout" class="logout"><?php echo __('Logout') ?></a>
			</li>
		<?php endif ?>
	</ul>
    */?>
<?/*
	<h3><?php echo __('Social Tools') ?></h3>
	<ul>
		<li><a href="http://www.etapasvi.com/forum/index.php?lang=<?php echo $sf_user->getCulture(); ?>" title="<?php echo __('Forum') ?>" ><?php echo __('Forum') ?></a></li>
		<li><a href="http://twitter.com/etapasvi" title="<?php echo __('Twitter') ?>"><?php echo __('Twitter') ?></a></li>
		<li><a href="http://etapasvi.livejournal.com/" title="<?php echo __('Live Journal') ?>"><?php echo __('LJ') ?></a></li>
		<?php if ($sf_user->getCulture() == 'ru'): ?>
            <li><a href="http://vkontakte.ru/club13542323" title="<?php echo __('Группа Палдена Дордже ВКонтакте') ?>">ВКонтакте</a></li>
        <?php else: ?>
            <li><a href="http://www.facebook.com/group.php?gid=113379818705184" title="<?php echo __('Facebook') ?>">Facebook</a></li>
		<? endif ?>
		<?php if ($sf_user->getCulture() != 'ru'): ?>
            <li><a href="http://groups.google.com/group/buddhaboy" title="<?php echo __('Goodle') ?>">Google</a></li>
		<? endif ?>
		<li><a href="http://www.youtube.com/user/etapasvi" ><?php echo __('YouTube') ?></a></li>
		<li><a href="<?php echo url_for('@news_rss', true); ?>" ><?php echo __('RSS') ?></a></li>
	</ul>
*/?>
	<?php /*<h3><?php echo __('Other') ?></h3>
	<ul>*/?>
		<?php /*<li><a href="<?php echo url_for('@user_member', true); ?>" title="<?php echo __('Member') ?>" id="mi_member"><?php echo __('Member') ?></a></li> */?>        
		<li><a href="<?php echo url_for('@social_tools', true); ?>" title="<?php echo __('Social Tools') ?>" id="mi_social_tools"><?php echo __('Social Tools') ?></a></li>
		<li><a href="<?php echo url_for('@search', true); ?>" title="<?php echo __('Search') ?>" id="mi_search"><?php echo __('Search') ?></a></li>
		<li><a href="<?php echo url_for('@contactus', true); ?>" title="<?php echo __('Contact Us') ?>" id="mi_contactus"><?php echo __('Contact Us') ?></a></li>
	</ul>
<?php /* 
	<h3><?php echo __('Idea of the Week') ?></h3>
	<ul>
		<li><a href="<?php echo url_for('@idea_ideaoftheweek', true); ?>" title="<?php echo __('What is this') ?>" id="mi_ideaoftheweek"><?php echo __('What is this') ?></a></li>
		<li><a href="<?php echo url_for('@index_idea', true); ?>" title="<?php echo __('Ideas for Meditation') ?>" id="mi_ideas"><?php echo __('All') ?></a></li>
		<li><a href="<?php echo url_for('@best_idea', true); ?>" title="<?php echo __('Best Idea for Meditation') ?>" id="mi_best"><?php echo __('Best') ?></a></li>
		<li><a href="<?php echo url_for('@show_idea', true); ?>" title="<?php echo __('Your Idea for Meditation') ?>" id="mi_idea"><?php echo __('My') ?></a></li>
		<li><a href="<?php echo url_for('@idea_archive', true); ?>" title="<?php echo __('Best Ideas Archive') ?>" id="mi_archive"><?php echo __('Archive') ?></a></li>
	</ul>
*/ ?>
