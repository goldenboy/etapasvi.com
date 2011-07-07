<?php $uri = sfContext::getInstance()->getRequest()->getUri(); ?>
<table id="share">
<tr>
<td align="right" class="share_item">
    <a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="etapasvi" >Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script> 
</td>
<?php if ($sf_user->getCulture() == 'ru'): ?>     
    <td class="share_item">
<?php /*
        <script type="text/javascript" src="http://vkontakte.ru/js/api/share.js?10" charset="windows-1251"></script>
        <script type="text/javascript">document.write(VK.Share.button(false,{type: "round", text: "ВК"}));</script>   
*/ ?>
        <script type="text/javascript" src="http://userapi.com/js/api/openapi.js?33"></script>
        <script type="text/javascript">
          VK.init({apiId: 2405715, onlyWidgets: true});
        </script>
        <div id="vk_like"></div>
        <script type="text/javascript">
        VK.Widgets.Like("vk_like", {type: "mini"});
        </script>
    </td>
    <?php // http://forumvk.com/news/knopki_vidjet_mne_nravitsya/2011-06-18-572             ?>
    <?php // Если на странице есть кнопка Одноклассники и Дискус, в IE при переходе по фотографиям не загружаются комментарии.  ?>
    <?php /*if ($sf_context->getModuleName() == 'photo' && $sf_context->getActionName() == 'show'): ?>        
    <?php else: ?> 
        <td class="share_item"> 
            <link href="http://stg.odnoklassniki.ru/share/odkl_share.css" rel="stylesheet">
            <script src="http://stg.odnoklassniki.ru/share/odkl_share.js" type="text/javascript" ></script>
            <a class="odkl-klass-stat" href="<?php echo $uri; ?>" onclick="ODKL.Share(this);return false;" ><span>0</span></a>
            <script type="text/javascript">$(document).ready(function(){ODKL.init()})</script>
        </td>
    <?php endif*/ ?>
    
    <td class="share_item">           
        <a target="_blank" class="mrc__plugin_like_button" href="http://connect.mail.ru/share" rel="{'type' : 'button', 'width' : '108'}">Нравится</a>
    <script src="http://cdn.connect.mail.ru/js/loader.js" type="text/javascript" charset="UTF-8"></script>
    </td>
<?php else: ?>

<?php /*
    <td class="share_item">           
        <script src="http://www.stumbleupon.com/hostedbadge.php?s=1" type="text/javascript"></script>
    </td>   
*/ ?>
    <td class="share_item">    
        <script type="text/javascript">
        (function() {
        var s = document.createElement('SCRIPT'), s1 = document.getElementsByTagName('SCRIPT')[0];
        s.type = 'text/javascript';
        s.async = true;
        s.src = 'http://widgets.digg.com/buttons.js';
        s1.parentNode.insertBefore(s, s1);
        })();
        </script>
        <a class="DiggThisButton DiggCompact"></a>
    </td>
<?php /*
    <td class="share_item">           
        <a title="Post on Google Buzz" class="google-buzz-button" href="http://www.google.com/buzz/post" data-button-style="small-count" data-url="<?php echo $uri; ?>"></a><script type="text/javascript" src="http://www.google.com/buzz/api/button.js"></script>
    </td>
*/ ?>
<?php endif ?>

<td class="share_item">           
    <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
    <g:plusone size="medium" href="<?php echo $uri; ?>"></g:plusone>
</td>
<td align="left" class="share_item">   
<?php /* 
    <iframe allowtransparency="true" frameborder="0" scrolling="no" src="http://www.facebook.com/plugins/like.php?app_id=229732383723932&amp;href=<?php echo urlencode($uri); ?>&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font=trebuchet+ms&amp;height=21" style="border: none; overflow: hidden; width: 95px; height: 21px; margin: 0px 5px 0px 0px;"></iframe>
*/ ?>
    <a rel="nofollow" name="fb_share" type="button_count" href="http://www.facebook.com/sharer.php">Share</a><script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>   
</td>
</tr>
</table>