<ul>
		<li id="mi_main"><a href="<?php echo url_for('@main', true); ?>" title="<?php echo __('Home') ?>" ><?php echo __('Home') ?></a></li>
	<?php /*</ul>
	<h3><?php echo __('Dharma Sangha') ?></h3> 
	<ul>*/ ?>
		<?php /*<li><a href="<?php echo url_for('@intro', true); ?>" title="<?php echo __('Buddha Boy Nepal') ?>" id="mi_intro"><?php echo __('Intro') ?></a></li> */ ?>
        <li id="mi_bio"><a href="<?php echo url_for('@biography', true); ?>" title="<?php echo __('Dharma Sangha') ?> – <?php echo __('Biography') ?>"><?php echo __('Biography') ?></a></li>
		<li id="mi_news"><a href="<?php echo url_for('@news_index', true); ?>" title="<?php echo __('News') ?>"><?php echo __('News') ?></a></li>
		<li id="mi_photo"><a href="<?php echo url_for('@photoalbum_index', true); ?>" title="<?php echo __('Photo') ?>"><?php echo __('Photo') ?></a></li>
		<li id="mi_video"><a href="<?php echo url_for('@video_index', true); ?>" title="<?php echo __('Video') ?>"><?php echo __('Video') ?></a></li>
		<li id="mi_audio"><a href="<?php echo url_for('@audio_index', true); ?>" title="<?php echo __('Audio') ?>"><?php echo __('Audio') ?></a></li>
        <li id="mi_teachings"><a href="<?php echo url_for('@teachings_index', true); ?>" title="<?php echo __('Teachings') ?>"><?php echo __('Teachings') ?></a></li>
        <li id="mi_projects"><a href="<?php echo url_for('@projects_index', true); ?>" title="<?php echo __('Projects') ?>"><?php echo __('Projects') ?></a></li>
        <li id="mi_stories"><a href="<?php echo url_for('@stories_index', true); ?>" title="<?php echo __('Stories') ?>"><?php echo __('Stories') ?></a></li>
        <li id="mi_books"><a href="<?php echo url_for('@books_index', true); ?>" title="<?php echo __('Books') ?>"><?php echo __('Books') ?></a></li>        
        <li id="mi_feed"><a href="<?php echo url_for('@feed', true); ?>" title="<?php echo __('Feed') ?>"><?php echo __('Feed') ?></a></li>
		<li id="mi_faq"><a href="<?php echo url_for('@faq', true); ?>" title="<?php echo __('FAQ') ?>"><?php echo __('FAQ') ?></a></li>
		<li id="mi_blessing"><a href="<?php echo url_for('@blessing', true); ?>" title="<?php echo __('Blessing') ?>"><?php echo __('Blessing') ?></a></li>
		<li id="mi_project"><a href="<?php echo url_for('@project', true); ?>" title="<?php echo __('Dharma Hall') ?>"><?php echo __('Dharma Hall') ?></a></li>
<?php /*
		<li id="mi_religious_forest"><a href="<?php echo url_for('@religious_forest', true); ?>" title="<?php echo __('Religious Forest') ?>"><?php echo __('Religious Forest') ?></a></li>
*/
?>
		<li id="mi_encyclopedia"><a href="<?php echo url_for('@encyclopedia', true); ?>" title="<?php echo __('Encyclopedia') ?>"><?php echo __('Encyclopedia') ?></a></li>
        <li id="mi_donation"><a href="<?php echo url_for('@donation', true); ?>" title="<?php echo __('Donation') ?>"><?php echo __('Donation') ?></a></li>
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
		<li id="mi_chat"><a href="<?php echo url_for('@chat', true); ?>" title="<?php echo __('Chat') ?>"><?php echo __('Chat') ?></a></li>
		<li id="mi_forum"><a href="http://forum.etapasvi.com" title="<?php echo __('Forum') ?>"><?php echo __('Forum') ?></a></li>
		<li id="mi_social_tools"><a href="<?php echo url_for('@social_tools', true); ?>" title="<?php echo __('Social Tools') ?>"><?php echo __('Social Tools') ?></a></li>        
		<li id="mi_search"><a href="<?php echo url_for('@search', true); ?>" title="<?php echo __('Search') ?>"><?php echo __('Search') ?></a></li>
        <li id="mi_servers"><a href="<?php echo url_for('@servers', true); ?>" title="<?php echo __('Servers') ?>"><?php echo __('Servers') ?></a></li>
		<li id="mi_contactus"><a href="<?php echo url_for('@contactus', true); ?>" title="<?php echo __('Contact Us') ?>"><?php echo __('Contact Us') ?></a></li>
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