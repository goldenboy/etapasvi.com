<?php $uri = sfContext::getInstance()->getRequest()->getUri(); ?>
<div id="share">

<div class="s_item">
    <a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="etapasvi" >Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script> 
</div>

<?php if ($sf_user->getCulture() == 'ru'): ?>     
<?php /*
        <script type="text/javascript" src="http://vkontakte.ru/js/api/share.js?10" charset="windows-1251"></script>
        <script type="text/javascript">document.write(VK.Share.button(false,{type: "round", text: "ВК"}));</script>   
*/ ?>
<div class="s_item">
        <script type="text/javascript" src="http://userapi.com/js/api/openapi.js?33"></script>
        <script type="text/javascript">
          VK.init({apiId: 2405715, onlyWidgets: true});
        </script>
        <div id="vk_like"></div>
        <script type="text/javascript">
        VK.Widgets.Like("vk_like", {type: "mini"});
        </script>
</div>
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
    <?php endif ?>
    
          
        <a target="_blank" class="mrc__plugin_like_button" href="http://connect.mail.ru/share" rel="{'type' : 'button', 'width' : '108'}"></a>
    <script src="http://cdn.connect.mail.ru/js/loader.js" type="text/javascript" charset="UTF-8"></script>
*/ ?>
<?php else: ?>

<?php /*
    <td class="share_item">           
        <script src="http://www.stumbleupon.com/hostedbadge.php?s=1" type="text/javascript"></script>
    </td>   


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


    <td class="share_item">           
        <a title="Post on Google Buzz" class="google-buzz-button" href="http://www.google.com/buzz/post" data-button-style="small-count" data-url="<?php echo $uri; ?>"></a><script type="text/javascript" src="http://www.google.com/buzz/api/button.js"></script>
    </td>
*/ ?>

<?php endif ?>
<div class="s_item">
    <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
    <g:plusone size="medium" href="<?php echo $uri; ?>"></g:plusone>
</div>
 
 <?php /*
    <iframe src="http://www.facebook.com/plugins/like.php?app_id=242428519102205&amp;href=<?php echo urlencode($uri); ?>&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=trebuchet+ms&amp;height=21" scrolling="no" frameborder="0" allowTransparency="true" class="share_item_facebook"></iframe>
*/ ?>
<div class="s_item">
    <div id="fb-root"></div>
    <script>(function(d){
      var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
      js = d.createElement('script'); js.id = id; js.async = true;
      js.src = "//connect.facebook.net/en_US/all.js#appId=242428519102205&xfbml=1";
      d.getElementsByTagName('head')[0].appendChild(js);
    }(document));</script>
    <div class="fb-like" data-send="false" data-layout="button_count" data-width="200" data-show-faces="true"></div>
</div>
    
<?php /*
    <a rel="nofollow" name="fb_share" type="button_count" href="http://www.facebook.com/sharer.php">Share</a><script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>   
    */
?>

</div>