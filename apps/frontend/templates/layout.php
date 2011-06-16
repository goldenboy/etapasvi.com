<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php /*<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">*/ ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php $user_culture = $sf_user->getCulture(); echo $user_culture; ?>" >
<head>
<?php if (UserPeer::isCultureHieroglyphic()):?><meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" /><?php endif ?>
<?php include_http_metas() ?>
<?php include_metas() ?>
<?php include_slot('meta') ?>
<?php include_title() ?>	
<link rel="Shortcut Icon" type="image/x-icon" href="http://www.etapasvi.com/favicon.ico" />
<?php /*<script type="text/javascript" src="/<?php echo $user_culture; ?>/text/js"></script> */ ?>
</head>

<?php $body_id = get_slot('body_id'); ?>

<body id="<?php echo $body_id; ?>" class="<?php if (UserPeer::isCultureHieroglyphic()):?>hieroglyphic<?php endif ?> <?php include_slot('body_class') ?>">

<div id="wrapper">

<div id="header">
	<div id="buddle_title"><a href="<?php echo url_for('@main', true); ?>" title="<?php echo __('Home') ?>">Tapasvi.</a><a href="<?php echo url_for('@main', true); ?>" title="<?php echo __('Home') ?>" class="zone">com</a></div>
</div>

<div id="content_wrapper">    
	<div id="content">
		<?php echo $sf_content ?>
	</div>
	<div id="footer">
		<?php if ($user_culture != 'ru'): ?>
            If you would like to translate information into another language, please email us at <a href="mailto:<?php echo MailPeer::MAIL_ADDRESS ?>"><?php echo MailPeer::MAIL_ADDRESS ?></a><br/><br/>
        <?php endif ?>
        
        <table id="share">
        <tr>
        <td align="right" class="share_item">
        <a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="etapasvi" >Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script> 
        </td>
        <?php if ($user_culture == 'ru'): ?>     

            <td align="left" class="share_item">
                <script type="text/javascript" src="http://vkontakte.ru/js/api/share.js?10" charset="windows-1251"></script>
                <script type="text/javascript">document.write(VK.Share.button(false,{type: "round", text: "Сохранить"}));</script>   
            </td>

<?php /*
            <td align="center" class="share_item">           
            <link href="http://stg.odnoklassniki.ru/share/odkl_share.css" rel="stylesheet" /> 
            <script src="http://stg.odnoklassniki.ru/share/odkl_share.js" type="text/javascript" ></script> 
            <a class="odkl-klass-oc" href="<?php echo $_SERVER['SCRIPT_URI'] ?>" onclick="ODKL.Share(this);return false;" ><span>0</span></a> 
            <script type="text/javascript">jQuery(document).ready(function(){ODKL.init();});</script> 
            </td>
            */ ?>
            <td align="center" class="share_item">           
            <a target="_blank" class="mrc__plugin_like_button" href="http://connect.mail.ru/share" rel="{'type' : 'button', 'width' : '108'}">Нравится</a>
            <script src="http://cdn.connect.mail.ru/js/loader.js" type="text/javascript" charset="UTF-8"></script>
            </td>

            <?php /*<td>            
            <td align="right" class="share_item">                
            <a target="_blank" class="mrc__plugin_like_button " href="http://connect.mail.ru/share" rel="{'type' : 'button', 'width' : '150'}">Нравится</a><script src="http://cdn.connect.mail.ru/js/loader.js" type="text/javascript" charset="utf-8"></script>
            </td>*/ ?>
        <?php else: ?>
            <td align="center" class="share_item">           
            <script src="http://www.stumbleupon.com/hostedbadge.php?s=1" type="text/javascript"></script>
            </td>
            
            <td align="center" class="share_item">           
            <a title="Post on Google Buzz" class="google-buzz-button" href="http://www.google.com/buzz/post" data-button-style="small-count" data-url="<?php echo $_SERVER['SCRIPT_URI'] ?>"></a><script type="text/javascript" src="http://www.google.com/buzz/api/button.js"></script>
            </td>
        <?php endif ?>
        <td align="left" class="share_item">        
        <a rel="nofollow" name="fb_share" type="button_count" href="http://www.facebook.com/sharer.php">Share</a><script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>   
    
        </td>
        </tr>
        </table>

		<?php echo __('Copyright') ?> &copy; 2009-<?php echo date("Y"); ?>, www.eTapasvi.com
		<br/><?php echo __('All Rights Reserved') ?>.
		<?php /*<br/><a href="mailto:saynt2day@gmail.com" title="saynt2day/Semyon/etapasvi">saynt2day</a>		*/?>
	</div>
</div>

<div id="menu">
	<?php include_partial('global/menu', array('body_id'=>$body_id /*, 'is_logged_in'=>UserPeer::authIsLoggedIn()*/) ); ?>	
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
		$user_culture = $user_culture;
		$uri = $_SERVER['REQUEST_URI'];
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

	<span class="lang_name lang_selector" title="<?php echo UserPeer::getCultureName( $user_culture );?>"><?php echo UserPeer::getCultureIso( $user_culture );?></span> 
	<span class="slide_arrow lang_selector">▼</span>

	<div id="lang_list" class="box">
		<?php foreach(UserPeer::getCulturesData() as $culture => $culture_data): ?>
			<?php if ($user_culture == $culture): ?>
				<?php continue; ?>
			<?php endif ?>
			
			<?php $i++ ?>
			<?php if ($i > count(UserPeer::getCultures())) break; ?>
			<a href="http://<?php echo $_SERVER['HTTP_HOST'] . url_for('/'.$culture.$params) ?>" title="<?php echo $culture_data['name']?>"><?php echo $culture_data['name']?></a><br/>
		<?php endforeach ?>		
	</div>	
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
<?php include_component( 'text', 'js' );  ?>
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