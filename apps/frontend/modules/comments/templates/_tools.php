<?php
$social_url 		= $_SERVER['SCRIPT_URI'];
$social_short_url 	= preg_replace( '/title\/.*/', '', $social_url);
$social_title 		= str_replace( array("'", "\""), '', html_entity_decode( html_entity_decode( $sf_response->getTitle() ) ) );
?>

<div class="social">

<?php if (!$empty): ?>	
  
<?php if ($sf_user->getCulture() != 'ru'): ?>	

<?php
/*
<!--
        <a href="http://del.icio.us/post?url=<?php echo $social_orl; ?>&amp;title=<?php echo social_title; ?>" rel="nofollow" title="post this at del.icio.us" target="_blank">
            <img src="http://www.etapasvi.com/i/social/delicious.png" alt="post this at del.icio.us" /></a>
        <a href="http://digg.com/submit?url=<?php echo $social_url; ?>&amp;media=<?php echo $for; ?>&amp;topic=odd_stuff" rel="nofollow" title="DiggThis" target="_blank">
            <img src="http://www.etapasvi.com/i/social/diggman.png" alt="DiggThis" /></a>
        <a href="http://twitter.com/home?status=<?php echo $social_title; ?>:<?php echo $social_url; ?>" rel="nofollow" title="Twitter" target="_blank">
            <img src="http://www.etapasvi.com/i/social/twitter.gif" alt="Twitter" /></a>
        <a href="http://www.newsvine.com/_tools/seed&amp;save?u=<?php echo $social_url; ?>&amp;h=<?php echo social_title;?>" rel="nofollow" title="post this at Newsvine" target="_blank">
            <img src="http://www.etapasvi.com/i/social/newsvine.png" alt="post this at Newsvine" /></a>
        <a href="http://myweb2.search.yahoo.com/myresults/bookmarklet?t=<?php echo social_title; ?>&amp;u=<?php echo $social_url; ?>" rel="nofollow" title="post this at Yahoo! my web" target="_blank">
            <img src="http://www.etapasvi.com/i/social/yahoomyweb.png" alt="post this at Yahoo! my web" /></a>
        <a href="http://www.facebook.com/sharer.php?u=<?php echo $social_url; ?>" rel="nofollow" title="Facebook" target="_blank">
            <img src="http://www.etapasvi.com/i/social/facebooksharer.jpeg" alt="Facebook" /></a>	
        <a href="http://buzz.yahoo.com/buzz?targetUrl=<?php echo $social_url; ?>" rel="nofollow" title="post this at Yahoo! Buzz" target="_blank">
            <img src="http://www.etapasvi.com/i/social/yahoo-buzz.png" alt="post this at Yahoo! Buzz" /></a>
        <a href="http://www.stumbleupon.com/submit?url=<?php echo $social_url; ?>" rel="nofollow" target="_blank" title="post this at Stumble Upon">
            <img src="http://www.etapasvi.com/i/social/stumleupon.gif" alt="post this at Stumble Upon"/></a>
-->*/
?>

    <div class="addthis_toolbox addthis_default_style">			
        <a class="addthis_button_twitter"></a>
        <a class="addthis_button_facebook"></a>
        <a class="addthis_button_myspace"></a>
        <a class="addthis_button_livejournal"></a>
        <a class="addthis_button_digg"></a>	
        <a class="addthis_button_stumbleupon"></a>
        <a class="addthis_button_delicious"></a>        		
        <a class="addthis_button_newsvine"></a>
        <a href="http://www.addthis.com/bookmark.php?v=250&amp;username=xa-4b3b29143d8dba08" class="addthis_button_compact" target="_blank">More</a>
    </div>
    <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=xa-4b3b29143d8dba08"></script>
    <script language="javascript" type="text/javascript">
        var addthis_share = { url: "<?php echo $social_url; ?>", title: "<?php echo $social_title; ?>" };
        var addthis_config = { ui_click: true, ui_hover_direction: -1 };
    </script>
<?php else: ?>

<?php
/*
<!--
        <a href="http://del.icio.us/post?url=<?php echo $social_orl; ?>&amp;title=<?php echo social_title; ?>" rel="nofollow" title="Delicious" target="_blank">
            <img src="http://www.etapasvi.com/i/social/delicious.png" alt="Delicious" /></a>
        <a href="http://twitter.com/home?status=<?php echo $social_title; ?>:<?php echo $social_url; ?>" rel="nofollow" title="Twitter" target="_blank">
            <img src="http://www.etapasvi.com/i/social/twitter.gif" alt="Twitter" /></a
        <a href="http://www.google.com/bookmarks/mark&amp;op=add&amp;bkmk=<?php echo $social_url; ?>" rel="nofollow" target="_blank" title="Google">
            <img src="http://www.etapasvi.com/i/social/googlebookmarks.gif" alt="Google"/></a>
        <a href="http://www.livejournal.com/update.bml?subject=<?php echo $social_title; ?>" rel="nofollow" target="_blank" title="LiveJournal">
            <img src="http://www.etapasvi.com/i/social/livejournal.gif" alt="LiveJournal"/></a>
        <a href="http://www.facebook.com/share.php?u=<?php echo $social_url; ?>" rel="nofollow" title="Facebook" target="_blank">
            <img src="http://www.etapasvi.com/i/social/facebooksharer.jpeg" alt="Facebook" /></a>
        <a href="http://memori.ru/link/?sm=1&u_data[url]=<?php echo $social_url; ?>" rel="nofollow" title="Memori" target="_blank">
            <img src="http://www.etapasvi.com/i/social/memori.gif" alt="Memori" /></a>
        <a href="http://www.postquickly.com/?link=<?php echo $social_url; ?>&amp;title=<?php echo $social_title; ?>" rel="nofollow" target="_blank" title="Все социальные закладки">
            <img src="http://www.etapasvi.com/i/social/postquickly.gif" alt="Все социальные закладки"/></a>
-->
*/
?>

    <div class="addthis_toolbox addthis_default_style">	
        <?php /*<a href="http://moemesto.ru/post.php?url=<?php echo $social_url; ?>" rel="nofollow" target="_blank" title="Моё Место" class="left">
            <img src="http://www.etapasvi.com/i/social/moemesto.gif" alt="Моё Место" style="margin-left:4px;"/>
        </a>*/ ?>
        <a class="addthis_button_vk"></a>			
        <a class="addthis_button_twitter"></a>
        <a class="addthis_button_facebook"></a>
        <a class="addthis_button_livejournal"></a>
        <a class="addthis_button_mymailru"></a>
        <a class="addthis_button_memori"></a>						
        <a class="addthis_button_delicious"></a>						
        <a class="addthis_button_digg"></a>							
        <a class="addthis_button_100zakladok"></a>
        <a href="http://www.addthis.com/bookmark.php?v=250&amp;username=xa-4b3b29143d8dba08" class="addthis_button_compact">Ещё</a>
    </div>
    <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=xa-4b3b29143d8dba08"></script>
    <script language="javascript" type="text/javascript">
        var addthis_share = { url: '<?php echo $social_url; ?>', title: '<?php echo $social_title; ?>' }
        var addthis_config = { ui_click: true, ui_hover_direction: -1 }
    </script>
<?php endif ?>
<?php endif ?>
</div>
