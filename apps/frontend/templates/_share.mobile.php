<?php $uri = sfContext::getInstance()->getRequest()->getUri(); ?>
<div id="share">
    <div class="share_item">
        <a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="etapasvi" >Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script> 
    </div>
    <?php if ($sf_user->getCulture() == 'ru'): ?>    

        <div class="share_item">
            <script type="text/javascript" src="http://userapi.com/js/api/openapi.js?33"></script>
            <script type="text/javascript">
              VK.init({apiId: 2405715, onlyWidgets: true});
            </script>
            <div id="vk_like"></div>
            <script type="text/javascript">
            VK.Widgets.Like("vk_like", {type: "mini"});
            </script>   
        </div>   
        <div class="share_item">
            <a target="_blank" class="mrc__plugin_like_button" href="http://connect.mail.ru/share" rel="{'type' : 'button', 'width' : '108'}">Нравится</a><script src="http://cdn.connect.mail.ru/js/loader.js" type="text/javascript" charset="UTF-8"></script>
        </div>
    <?php else: ?>
        <div class="share_item">
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
        </div>
    <?php endif ?>
    <div class="share_item">     
        <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
        <g:plusone size="medium" href="<?php echo $uri; ?>"></g:plusone>
    </div>  
    <div class="share_item">    
            <a rel="nofollow" name="fb_share" type="button_count" href="http://www.facebook.com/sharer.php">Share</a><script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
    </div>
</div>