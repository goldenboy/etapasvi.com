<table id="share">
<tr>
<td align="right" class="share_item">
<a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="etapasvi" >Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script> 
</td>
<?php if ($sf_user->getCulture() == 'ru'): ?>     
    <td align="center" class="share_item">
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
    <a title="Post on Google Buzz" class="google-buzz-button" href="http://www.google.com/buzz/post" data-button-style="small-count" data-url="<?php echo sfContext::getInstance()->getRequest()->getUri(); ?>"></a><script type="text/javascript" src="http://www.google.com/buzz/api/button.js"></script>
    </td>
<?php endif ?>
<td align="left" class="share_item">        
<a rel="nofollow" name="fb_share" type="button_count" href="http://www.facebook.com/sharer.php">Share</a><script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>   

</td>
</tr>
</table>