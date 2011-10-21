<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php $user_culture = $sf_user->getCulture(); echo $user_culture; ?>" >
<head>
<?php include_http_metas() ?>
<meta name="ROBOTS" content="NOINDEX, NOFOLLOW" />
<?php /*include_title()*/ ?>	
<?php if (UserPeer::isHomePage()): ?>
    <title><?php echo sfConfig::get('app_site_name'); ?></title>
<?php else: ?>
    <title><?php echo __(html_entity_decode($sf_response->getTitle())); ?> - <?php echo sfConfig::get('app_site_name'); ?></title>
<?php endif ?>
<link rel="stylesheet" type="text/css" href="/css/m_css.css" />	
<link rel="shortcut icon" type="image/x-icon" href="http://<?php echo sfConfig::get('app_domain_name'); ?>/favicon.ico" />
<script type="text/javascript">
    function switchCulture() {
        var c_list_top = document.getElementById("culture_list_top");

        if (!c_list_top) {
            var c_list = document.getElementById("culture_list").cloneNode(true);
            c_list.id = "culture_list_top";
            document.getElementById("header").appendChild(c_list);
        } else {
            c_list_top.parentNode.removeChild(c_list_top);
        }
    }    
</script>
</head>

<?php $body_id = get_slot('body_id'); ?>

<body id="<?php echo $body_id; ?>" class="<?php if (UserPeer::isCultureHieroglyphic()):?>hieroglyphic<?php endif ?> <?php include_slot('body_class') ?><?php if (UserPeer::isCultureLargeText()):?> large_text<?php endif ?>" <?php /*onload="javascript: try { ODKL.init(); } catch(e) {}"*/ ?>>

<div id="wrapper">

<div id="header">
    <table cellspacing="0" cellpadding="0">
    <tr>
        <td width="118">
            <a href="<?php echo url_for('@main', true); ?>" title="<?php echo __('Home') ?>" class="no_decor" id="bubble_title"><i></i>Tapasvi.<span>com</span></a>
        </td>
        <td>  
            <a href="#" onclick="switchCulture()" id="bubble_lang"><?php echo UserPeer::getCultureIso($user_culture); ?></a>      
        </td>
        <td>
            <i class="slide_arrow" onclick="switchCulture()"></i>
        </td>
    </tr>
    </table>
</div>

<div id="content_wrapper">    
	<div id="content">
		<?php echo $sf_content ?>
	</div>
    <?php /* id используется в /lib/symfony/exception/sfError404Exception.class.php */ ?>
	<div id="footer">        
        <?php include_partial('global/share'); ?>        
        <div id="culture_list">
            <?php 
                $uri          = $sf_request->getPathInfo();
                foreach( UserPeer::getCultures() as $culture) {
                    $user_cultures[] = '/' . $culture . '/';
                }
                $params = str_replace( $user_cultures, '/', $uri);
                $i = 0;
            ?>

            <?php foreach(UserPeer::getCulturesData() as $culture => $culture_data): ?>                                
                <?php $i++ ?>
                <?php if ($i > count(UserPeer::getCultures())) break; ?>
                
                <?php if ($user_culture == $culture): ?>
                    <strong><?php echo UserPeer::getCultureIso( $culture ) ?></strong>&nbsp;
                <?php else: ?>
                    <a href="http://<?php echo sfConfig::get('app_domain_name') . '/'.$culture.$params; ?>" title="<?php echo $culture_data['name']?>"><?php echo UserPeer::getCultureIso( $culture )?></a>&nbsp;
                <?php endif ?>
            <?php endforeach?>
        </div>
		<?php echo __('Copyright') ?> &copy; 2009-<?php echo date("Y"); ?>, www.eTapasvi.com
        <?php 
            // Генерация ссылки на Полную версию
            $url_full = UserPeer::switchUrlMobile();
            // В ссылке на гланую страницу Полной версии добавляется /version/full
            if (UserPeer::isHomePage($url_full)) {
                $url_full = $url_full . 'version/full';
            }
        ?>
		<br/><?php /*<strong><?php echo __('Mobile') ?></strong> | */ ?><a href="<?php echo $url_full; ?>"><?php echo __('Classic') ?></a>
	</div>
</div>


</div>

<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-4047144-4']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<?php /* если стили для кнопки Одноклассников подключить выше, в Sony Ericsson K750i пропадает или глючит всё, что находится ниже  ?>
<link href="http://stg.odnoklassniki.ru/share/odkl_share.css" rel="stylesheet">
*/ ?>
</body>
</html>