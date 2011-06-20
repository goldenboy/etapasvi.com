<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php $user_culture = $sf_user->getCulture(); echo $user_culture; ?>" >
<head>
<?php include_title() ?>
<link rel="stylesheet" type="text/css" href="/css/m_css.css" />	
<link rel="shortcut icon" type="image/x-icon" href="http://<?php echo sfConfig::get('app_domain_name'); ?>/favicon.ico" />
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

            <td align="center" class="share_item">           
            <a target="_blank" class="mrc__plugin_like_button" href="http://connect.mail.ru/share" rel="{'type' : 'button', 'width' : '108'}">Нравится</a>
            <script src="http://cdn.connect.mail.ru/js/loader.js" type="text/javascript" charset="UTF-8"></script>
            </td>
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
		<strong><?php echo __('Mobile') ?></strong> | <a href="http://<?php echo sfConfig::get('app_domain_name'); ?>"><?php echo __('Classic') ?></a>
	</div>
</div>


<div id="bubble_lang">	
	<?php 
		$user_culture = $user_culture;
		$uri          = $sf_request->getPathInfo();
		foreach( UserPeer::getCultures() as $culture) {
			$user_cultures[] = '/' . $culture . '/';
		}

		$params = str_replace( $user_cultures, '/', $uri);

		$i = 0;
	?>


	<div id="lang_list" class="box">
		<?php foreach(UserPeer::getCulturesData() as $culture => $culture_data): ?>
			<?php if ($user_culture == $culture): ?>
				<?php continue; ?>
			<?php endif ?>
			
			<?php $i++ ?>
			<?php if ($i > count(UserPeer::getCultures())) break; ?>
			<a href="http://<?php echo $_SERVER['HTTP_HOST'] . '/'.$culture.$params; ?>" title="<?php echo $culture_data['name']?>"><?php echo $culture_data['name']?></a><br/>
		<?php endforeach ?>		
	</div>	
</div>



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
</body>
</html>