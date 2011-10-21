<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php /*<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">*/ ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php $user_culture = $sf_user->getCulture(); echo $user_culture; ?>" >
<head>
<?php if (UserPeer::isCultureHieroglyphic()):?><meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" /><?php endif ?>
<?php include_http_metas() ?>
<?php include_metas() ?>
<?php include_slot('meta') ?>
<?php /*include_title()*/ ?>
<title><?php echo __(html_entity_decode($sf_response->getTitle())); ?> - <?php echo sfConfig::get('app_site_name'); ?></title>
<link rel="shortcut icon" type="image/x-icon" href="http://<?php echo sfConfig::get('app_domain_name'); ?>/favicon.ico" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script> 
<script type="text/javascript" src="<?php echo url_for('@js'); ?>"></script> 
<link rel="stylesheet" type="text/css" media="screen" href="/css/css.css" /> 
</head>

<?php $body_id = get_slot('body_id'); ?>

<body id="<?php echo $body_id; ?>" class="<?php if (UserPeer::isCultureHieroglyphic()):?>hieroglyphic<?php endif ?> <?php include_slot('body_class') ?>">

<div id="wrapper">

<div id="header">
	<a href="<?php echo url_for('@main', true); ?>" title="<?php echo __('Home') ?>" class="no_decor"><i id="bubble_title">Tapasvi.<span>com</span></i></a>
</div>

<div id="content_wrapper">    
	<div id="content">
		<?php echo $sf_content ?>
        <?php include_component( 'text', 'offertranslation' ); ?>        
	</div>
    <div id="menu">
        <?php include_partial('global/menu', array('body_id'=>$body_id /*, 'is_logged_in'=>UserPeer::authIsLoggedIn()*/) ); ?>	
        <?php include_partial('global/share'); ?>
    </div>
	<div id="footer">    
        <div id="f_line"></div>        	       
        <?php $mobile_url = UserPeer::switchUrlMobile(sfContext::getInstance()->getRequest()->getUri());?>                
        <?php $mobile_url = preg_replace("/\?.*/", '', $mobile_url) ;?>                
        <div id="m_link">
            <br/>
            <a href="<?php echo $mobile_url; ?>" title="<?php echo __('Mobile') ?>"><img src="http://qrcode.kaywa.com/img.php?s=3&amp;d=<?php echo urlencode($mobile_url); ?>" alt="<?php echo __('Mobile') ?>"/></a>
            <br/><a href="<?php echo $mobile_url; ?>" title="<?php echo __('Mobile') ?>"><?php echo __('Mobile') ?></a>
        </div>
	</div>
</div>

<div id="bubble_click">
	<map name="bubble_click_map" id="bubble_click_map">
	<area shape="circle" coords="154,135,135" href="<?php echo url_for('@main', true); ?>" title="<?php echo __('Home') ?>" />
	</map>
	<img usemap="#bubble_click_map" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" width="300" height="308" alt=""/>	
</div>

<div id="bubble_mantra">
	<img src="/i/om_namo_guru_buddha_gyani.gif" title="<?php echo __('Om Namo Guru Buddha Gyani') ?>" />
<?php
/*
	<script type="text/javascript">
		$(document).ready(function() {
			var time = new Date(Date.parse('<?php include_component( 'idea', 'getthinkingtime' ); ?>')); 
			$('#countdown').countdown(
				{until: time, compact: true, compactLabels: ['y', 'm', 'w', '<?php echo __('d') ?>']}
			); 
		});
	</script>
	<acronym id="countdown" title="<?php echo __('Time remaining until meditation') ?>">
	</acronym>	
*/
?>	
</div>

<div id="bubble_lang">	
	<?php 
		$uri          = $sf_request->getPathInfo();
		foreach( UserPeer::getCultures() as $culture) {
			$user_cultures[] = '/' . $culture . '/';
		}

		$params = str_replace( $user_cultures, '/', $uri);
        // всё, что идёт после #
        /*preg_match('/#.*$/', $uri, $matches);
        if (!empty($matches[0])) {
            $anchor = $matches[0];
        } else {
            $anchor = '';
        }*/
		$i = 0;
	?>

	<span class="lang_name lang_selector b-fg b-fg_<?php echo strtoupper(UserPeer::getCultureIso( $user_culture ));?>" title="<?php echo UserPeer::getCultureName( $user_culture );?>"><img src="/i/fg.png" alt="<?php echo UserPeer::getCultureIso( $user_culture );?>" /></span> 
	<?php /* <span class="slide_arrow lang_selector">▼</span>*/ ?>
    <?php /* id используется в /lib/symfony/exception/sfError404Exception.class.php */ ?>
	<div id="lang_list"><div id="lang_box">
		<?php foreach(UserPeer::getCulturesData() as $culture => $culture_data): ?>			
			<?php $i++ ?>
			<?php if ($i > count(UserPeer::getCultures())) break; ?>
			<i class="b-fg b-fg_<?php echo strtoupper($culture_data['iso']);?>"><img src="/i/fg.png"/></i> 
            <?php if ($user_culture == $culture): ?>
				<span class="light"><?php echo $culture_data['name']?></span>
			<?php else: ?>
                <a href="http://<?php echo $_SERVER['HTTP_HOST'] . '/'.$culture.$params; ?>" title="<?php echo $culture_data['name']?>"><?php echo $culture_data['name']?></a>
			<?php endif ?>
            <br/>
		<?php endforeach ?>		
	</div></div>	
</div>

<div id="bubble_quote">

<?php /*if (IdeaPeer::isThinkingNow()): ?>
	<?php include_component( 'user', 'thinkingnow' ); ?>
<? else: */?>
	<?php /*if (!UserPeer::authIsLoggedIn() ): ?>
		<?php include_component( 'user', 'minilogin' ); ?>
	<?php else: ?>
		<?php include_component( 'user', 'thinkingtime' ); ?>
	<?php endif */?>
<?php /*endif */?>    
    <p id="quote_p"><?php /*
        $quote = include_component( 'quote', 'showtitle' ); 
        if ($quote) {
            echo $quote;
        }*/
    ?>&nbsp;</p>
</div>

<div id="bubble_sound">
<?php /*if ($_GET['debug'] != 1): ?>
    <?php 
        $song = get_component( 'song', 'randomsong' );
    ?>
	<div id="mp3" title="<?php echo $song; ?>" class="audio_player"><span><?php echo $song; ?></span></div>
<?php else: */?>
    <?php 
        //$audio = get_component( 'audio', 'random' );
    ?>
	<div id="mp3" title="<?php /*echo $audio;*/ ?>" class="audio_item"><span><?php /*echo $audio;*/ ?>&nbsp;</span></div>
<?php /*endif */?>
</div>

<noscript>
	<div id="enable_javascript">
		<p class="error_list p1 center_text"><?php echo __('Please, enable JavaScript!') ?></p>
	</div>
</noscript>

</div>

<script type="text/javascript">
<?php /*include_component( 'text', 'js' ); */ ?>
var _gaq = _gaq || [];
_gaq.push(
    ['_setAccount', 'UA-4047144-3'],
    ['_setDomainName', 'www.etapasvi.com'],
    ["_addOrganic", "mail.ru", "q"],
    ["_addOrganic","rambler.ru", "words"],
    ["_addOrganic","nigma.ru", "s"],
    ["_addOrganic","blogs.yandex.ru", "text"],
    ["_addOrganic","webalta.ru", "q"],
    ["_addOrganic","aport.ru", "r"],
    ["_addOrganic","akavita.by", "z"],
    ["_addOrganic","meta.ua", "q"],
    ["_addOrganic","bigmir.net", "q"],
    ["_addOrganic","tut.by", "query"],
    ["_addOrganic","all.by", "query"],
    ["_addOrganic","i.ua", "q"],
    ["_addOrganic","online.ua", "q"],
    ["_addOrganic","a.ua", "s"],
    ["_addOrganic","ukr.net", "search_query"],
    ["_addOrganic","search.com.ua", "q"],
    ["_addOrganic","search.ua", "query"],
    ["_addOrganic","poisk.ru", "text"],
    ["_addOrganic","km.ru", "sq"],
    ["_addOrganic","liveinternet.ru", "ask"],
    ["_addOrganic","gogo.ru", "q"],
    ["_addOrganic","gde.ru", "keywords"],
    ["_addOrganic","quintura.ru", "request"],
    ['_trackPageview'],
    ['_trackPageLoadTime']
);
(function() {
 var ga = document.createElement('script');
 ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
 ga.setAttribute('async', 'true');
 document.documentElement.firstChild.appendChild(ga);
})();</script>
<img style="width:0px;height:0px" src="http://www.maploco.com/vm24/s/3901457.png" />
</body>
</html>