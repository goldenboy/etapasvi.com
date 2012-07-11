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

<h1><?php echo __('Save Tapasvi Forest') ?></h1>        

<span class="desc"><?php echo __('Expand and Preserve Nepal\'s Dharmic Forest') ?></span>

<?php /* include_component('news', 'showText', array('id'=>71));  */ ?>

	<!-- Start WOWSlider.com BODY section -->
	<div id="wowslider-container1">
	<div class="ws_images"><ul>
    
<li><img src="http://<?php echo $app_domain_name; ?>/i/jquery/wow_slider/images/836.jpg" alt="260400_10150699094915226_5401026_n" title="As is happening all over the planet, forests in Nepal are being cut and polluted for monetary gains, which leads to disappearance of birds, animals and plants." id="wows1_0"/></li>

<li><img src="http://<?php echo $app_domain_name; ?>/i/jquery/wow_slider/images/263437_10150699069905226_7171240_n.jpg" alt="263437_10150699069905226_7171240_n" title="A destructive attitude towards the forest has already led to a number of irreversible environmental disasters in various regions of our planet." id="wows1_1"/></li>

<li><img src="http://<?php echo $app_domain_name; ?>/i/jquery/wow_slider/images/263437_10150699069905226_7171240_n.jpg" alt="263437_10150699069905226_7171240_n" title="Nepal has been classified by the United Nations Environmental Programme (UNEP) as the highest risk zone in Asia in terms of the ecological crisis." id="wows1_2"/></li>

<li><img src="http://<?php echo $app_domain_name; ?>/i/jquery/wow_slider/images/263437_10150699069905226_7171240_n.jpg" alt="263437_10150699069905226_7171240_n" title="Now we have the opportunity to protect the flora and fauna of a pristine jungle in Nepal." id="wows1_3"/></li>

<li><img src="http://<?php echo $app_domain_name; ?>/i/jquery/wow_slider/images/263437_10150699069905226_7171240_n.jpg" alt="263437_10150699069905226_7171240_n" title="Maha Sambodhi Dharma Sangha has been meditating for six years (2005-2011) “for the happiness and well-being of the world, for the jungle, for conservation of plants” (&lt;a href='http://www.etapasvi.com/en/video/25/the-boy-with-divine-powers-documentary-on-buddha-boy' target='_blank' &gt;Discovery Channel Documentary&lt;/a&gt;.)" id="wows1_4"/></li>

<li><img src="http://<?php echo $app_domain_name; ?>/i/jquery/wow_slider/images/263437_10150699069905226_7171240_n.jpg" alt="263437_10150699069905226_7171240_n" title="The jungle area surrounding Tapasvi’s (spiritual practitioner) meditation site is an ancient land. " id="wows1_5"/></li>

<li><img src="http://<?php echo $app_domain_name; ?>/i/jquery/wow_slider/images/263437_10150699069905226_7171240_n.jpg" alt="263437_10150699069905226_7171240_n" title="A very small part of this jungle has been already legalized as The Dharmic Forest (Dharma – universal and cosmic truth, righteous duty, virtuous path, liberating law.)" id="wows1_6"/></li>

<li><img src="http://<?php echo $app_domain_name; ?>/i/jquery/wow_slider/images/263437_10150699069905226_7171240_n.jpg" alt="263437_10150699069905226_7171240_n" title="It is forbidden to cut trees or grass, kill living beings or pollute the area inside of this area." id="wows1_7"/></li>

<li><img src="http://<?php echo $app_domain_name; ?>/i/jquery/wow_slider/images/263437_10150699069905226_7171240_n.jpg" alt="263437_10150699069905226_7171240_n" title="If the whole area were given The Dharmic Forest status, this would allow it become a safe sanctuary for numerous beautiful birds, animals and plants and help in their conservation." id="wows1_8"/></li>

<li><img src="http://<?php echo $app_domain_name; ?>/i/jquery/wow_slider/images/263437_10150699069905226_7171240_n.jpg" alt="263437_10150699069905226_7171240_n" title="Now it's your turn." id="wows1_9"/></li>

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

<a href="http://www.etapasvi.com" class="simple">www.eTapasvi.com</a>
</div>

</body>
</html>