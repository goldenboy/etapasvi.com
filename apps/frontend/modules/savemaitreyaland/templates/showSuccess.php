<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php $user_culture = $sf_user->getCulture(); echo $user_culture; ?>" >
<head>
<?php if (UserPeer::isCultureHieroglyphic()):?><meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" /><?php endif ?>
<?php include_http_metas() ?>
<?php include_metas() ?>
<?php include_slot('meta') ?>

<title><?php echo __(html_entity_decode($sf_response->getTitle())); ?></title>
<?php $app_domain_name = sfConfig::get('app_domain_name'); ?>
<link rel="shortcut icon" type="image/x-icon" href="http://<?php echo $app_domain_name; ?>/favicon.ico" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script> 
<link rel="stylesheet" type="text/css" media="screen" href="http://<?php echo $app_domain_name; ?>/css/css_savejungle.css" /> 
<link rel="stylesheet" type="text/css" media="screen" href="http://<?php echo $app_domain_name; ?>/js/wow_slider/engine1/style.css" /> 
<script type="text/javascript" src="http://<?php echo $app_domain_name; ?>/js/wow_slider/engine1/jquery.js"></script>
</head>
<body style="background-color:#ffffff">

<h1><?php echo __('Save Tapasvi Jungle') ?></h1>        

<span class="desc"><?php echo __('Expand and Preserve Nepal\'s Dharmic Forest') ?></span>

<?php /* include_component('news', 'showText', array('id'=>71));  */ ?>

	<!-- Start WOWSlider.com BODY section -->
	<div id="wowslider-container1">
	<div class="ws_images"><ul>
<li><img src="http://<?php echo $app_domain_name; ?>/i/jquery/wow_slider/images/260400_10150699094915226_5401026_n.jpg" alt="260400_10150699094915226_5401026_n" title="Как и в любом месте <strong>на планете</strong>, леса в Непале вырубаются и загрязняются ради наживы, что приводит к исчезновению птиц, животных и растений. Хищническое отношение к лесным богатствам уже привело к множеству необратимых экологических катастроф в различных регионах нашей планеты. Непал был классифицирован Программой Организации Объединенных Наций по окружающей среде (ЮНЕП) как зона повышенного риска в Азии с точки зрения экологического состояния." id="wows1_0"/></li>
<li><img src="http://<?php echo $app_domain_name; ?>/i/jquery/wow_slider/images/263437_10150699069905226_7171240_n.jpg" alt="263437_10150699069905226_7171240_n" title="263437_10150699069905226_7171240_n" id="wows1_1"/></li>
</ul></div>

<a class="wsl" href="http://wowslider.com">jQuery Slider Width by WOWSlider.com v2.3</a>
	<div class="ws_shadow"></div>
	</div>
	<script type="text/javascript" src="http://<?php echo $app_domain_name; ?>/js/wow_slider/engine1/wowslider.js"></script>
	<script type="text/javascript" src="http://<?php echo $app_domain_name; ?>/js/wow_slider/engine1/script.js"></script>
	<!-- End WOWSlider.com BODY section -->

<a href="#" class="action_btn">Take action</a> 
<a href="#" class="no_action_btn">Stay indifferent</a>

<div id="footer">
<?php include_partial( 'global/share', array('no_counter'=>true) ); ?>
<div class="f_line"></div>
<?php include_partial( 'global/lang_plain', array('app_domain_name'=>sfConfig::get('app_save_jungle_domain_name')) ); ?>
</div>

</body>
</html>