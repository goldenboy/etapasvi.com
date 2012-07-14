<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php $user_culture = $sf_user->getCulture(); echo $user_culture; ?>" >
<head>
<?php if (UserPeer::isCultureHieroglyphic()):?><meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" /><?php endif ?>
<?php include_http_metas() ?>
<?php include_metas() ?>
<?php include_slot('meta') ?>
<title><?php echo __(html_entity_decode($sf_response->getTitle())); ?></title>
<?php 
$app_domain_name = sfConfig::get('app_domain_name'); 
$uri = 'http://' . sfConfig::get('app_save_jungle_domain_name') . '/' . $user_culture . '/';
?>
<link rel="shortcut icon" type="image/x-icon" href="http://<?php echo $app_domain_name; ?>/favicon.ico" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script> 
<link rel="stylesheet" type="text/css" media="screen" href="http://<?php echo $app_domain_name; ?>/css/css_savejungle.css" /> 
<link rel="stylesheet" type="text/css" media="screen" href="http://<?php echo $app_domain_name; ?>/js/wow_slider/engine1/style.css" /> 

</head>
<body>

<h1><?php echo __('Save Nepal Tapasvi Forest') ?></h1>        

<span class="desc"><?php echo __('Preserve and Expand Nepal Dharmic Forest') ?></span>
<br/>
<?php include_partial( 'global/lang_plain', array('app_domain_name'=>sfConfig::get('app_save_jungle_domain_name'), 'uri'=>'/' . $user_culture . '/') ); ?>

<?php /* include_component('news', 'showText', array('id'=>71));  */ ?>

	<!-- Start WOWSlider.com BODY section -->
	<div id="wowslider-container1">
	<div class="ws_images"><ul>
    
<li><img src="http://<?php echo $app_domain_name; ?>/i/jquery/wow_slider/images/1.jpg" alt="" title="<?php echo __('A destructive attitude towards the forest has already led to a number of irreversible environmental disasters in various regions of our planet.') ?>" id="wows1_0"/></li>

<li><img src="http://<?php echo $app_domain_name; ?>/i/jquery/wow_slider/images/2.jpg" alt="" title="<?php echo __('As is happening all over the planet, forests in Nepal are being cut and polluted for monetary gains, which leads to disappearance of birds, animals and plants.') ?>" id="wows1_1"/></li>

<li><img src="http://<?php echo $app_domain_name; ?>/i/jquery/wow_slider/images/3.jpg" alt="" title="<?php echo __('Nepal has been classified by the United Nations Environmental Programme (UNEP) as the highest risk zone in Asia in terms of the ecological crisis.') ?>" id="wows1_2"/></li>

<li><img src="http://<?php echo $app_domain_name; ?>/i/jquery/wow_slider/images/4.jpg" alt="" title="<?php echo __('Now we have the opportunity to protect the flora and fauna of a pristine jungle in Nepal.') ?>" id="wows1_3"/></li>

<li><img src="http://<?php echo $app_domain_name; ?>/i/jquery/wow_slider/images/5.jpg" alt="" title="<?php echo __('Maha Sambodhi Dharma Sangha has been meditating for six years (2005-2011) “for the happiness and well-being of the world, for the jungle, for conservation of plants” (') ?>&lt;a href='<?php echo preg_replace('/http:\/\/[^\/]+\//', 'http://' . $app_domain_name . '/', VideoPeer::getUrl(25)); ?>' target='_blank' &gt;<?php echo __('Discovery Channel Documentary') ?>&lt;/a&gt;<?php echo __('.)') ?>" id="wows1_4"/></li>

<li><img src="http://<?php echo $app_domain_name; ?>/i/jquery/wow_slider/images/7.jpg" alt="" title="<?php echo __('The jungle area surrounding Tapasvi’s (spiritual practitioner) meditation site is an ancient land.') ?>" id="wows1_5"/></li>

<li><img src="http://<?php echo $app_domain_name; ?>/i/jquery/wow_slider/images/6.jpg" alt="" title="<?php echo __('Halkhoriya is the historical forest: some events, described in the oldest epics (Ramayana, Mahabharata), took place here; the divine avatar Ram and legendary warrior Arjuna came to this place thousands years ago.') ?>" id="wows1_6"/></li>

<li><img src="http://<?php echo $app_domain_name; ?>/i/jquery/wow_slider/images/13.jpg" alt="" title="<?php echo __('A very small part of this jungle has been already legalized as The Dharmic Forest (Dharma – universal and cosmic truth, righteous duty, virtuous path, liberating law.)') ?>" id="wows1_7"/></li>

<li><img src="http://<?php echo $app_domain_name; ?>/i/jquery/wow_slider/images/8.jpg" alt="" title="<?php echo __('It is forbidden to cut trees or grass, kill living beings or pollute the area inside of this area.') ?>" id="wows1_8"/></li>

<li><img src="http://<?php echo $app_domain_name; ?>/i/jquery/wow_slider/images/9.jpg" alt="" title="<?php echo __('If the whole area were given The Dharmic Forest status, this would allow it become a safe sanctuary for numerous beautiful birds, animals and plants and help in their conservation.') ?>" id="wows1_9"/></li>

<li><img src="http://<?php echo $app_domain_name; ?>/i/jquery/wow_slider/images/10.jpg" alt="" title="<?php echo __('Destiny of the living creatures and plants is in your hands.') ?>" id="wows1_10"/></li>

<li><img src="http://<?php echo $app_domain_name; ?>/i/jquery/wow_slider/images/12.jpg" alt="" title="<?php echo __('Now it\'s your turn...') ?>" id="wows1_11"/></li>

<li><img src="http://<?php echo $app_domain_name; ?>/i/jquery/wow_slider/images/11.jpg" alt="" title="" id="wows1_12"/></li>

</ul></div>

<a class="wsl" href="http://wowslider.com">jQuery Slider Width by WOWSlider.com v2.3</a>
	<div class="ws_shadow"></div>
	</div>
	<script type="text/javascript" src="http://<?php echo $app_domain_name; ?>/js/wow_slider/engine1/wowslider.js"></script>
	<script type="text/javascript" src="http://<?php echo $app_domain_name; ?>/js/wow_slider/engine1/script.js"></script>
	<!-- End WOWSlider.com BODY section -->

<a href="javascript:$('#petition_container').show(); $('html, body').animate({scrollTop: $('#petition_container').offset().top}, 3000); void(0);" class="action_btn"><?php echo __('Take action') ?></a> 
<a href="javascript:$('#petition_container').fadeOut('slow'); void(0);" class="no_action_btn"><?php echo __('Stay indifferent') ?></a>

<div id="petition_container">
<?php echo __('We, the undersigned, respectfully submit to the Ministry of Forests and Soil Conservation, Nepal, this petition for due consideration to grant the legal status of "Dharmic Forest" to the entire jungle area including Pathlaiya, Halkoriya, and Ratanpuri. This petition is also addressed to all Citizens of Nepal whose proactive and loving participation is urgently needed by this beautiful part of Nepal\'s Nature now being threatened.') ?>
<br/><br/>
<script type="text/javascript" src="http://dingo.care2.com/petitions/embed.js"></script><div class="care2PetitionEmbed" rssPath="http://www.thepetitionsite.com/xml/petitions/853/615/922/feed.swf" adSize="large" publisherId="345996060" grabbed="0" flags="#000000" buttonColor="#1aaca6" style="margin: 0 auto; width: 460px;"></div>
<div class="instr"><?php echo __('Instructions: fill out your details and click "Sign petition" button and then click it again on the next page to approve signing.') ?></div>
<a target="_blank" href="http://www.thepetitionsite.com/36/international-petition-for-a-dharmik-ban-religious-forest/"><?php echo __('View signers') ?></a>
</div>

<div id="footer">
<?php include_partial( 'global/share', array('no_counter'=>true, 'uri'=>$uri, 'only_horizontal'=>true, 'vk_api_id'=>sfConfig::get('app_save_jungle_vk_api_id')) ); ?>
<div class="f_line"></div>

<a href="http://www.etapasvi.com" class="simple">www.eTapasvi.com</a>
</div>


<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter15924151 = new Ya.Metrika({id:15924151,
                    accurateTrackBounce:true});
        } catch(e) {}
    });
    
    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/15924151" style="position:absolute; left:-9999px;" alt="" /></div></noscript>

<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-33386015-1']);
  _gaq.push(['_setDomainName', 'www.savenepaltapasviforest.info']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
</body>
</html>