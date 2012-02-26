<div id="disqus_thread"></div>
<script type="text/javascript">
<?php
/*
    // изменение размера всплывающего окна после загрузки комментариев
    function disqus_config() {        
        this.callbacks.afterRender = [function() {
            if (page_mode == "enlarge_photo") {
                //setTimeout(function(){ cbResize(); }, cb_resize_period);
            }
        }];
    }
*/ ?>
    var disqus_shortname    = 'etapasvi';
    var disqus_identifier   = '<?php echo $comments_identifier?>';
    <?php if (!empty($comments_page_url)): ?>var disqus_url   = '<?php echo $comments_page_url?>';<?php endif ?>
    var disqus_category_id  = '<?php echo UserPeer::getCultureCommentsCategoryId() ?>';
    var disqus_language     = '<?php echo UserPeer::getCultureMain() ?>';
    <?php /*
    $(document).ready(function(){
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true; dsq.cache = true;
        <?php /* //dsq.src = '/js/disqus_embed.js';
        dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
        //dsq.src = '/<?php echo $sf_user->getCulture(); ?>/text/disqusembed'; 
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);                                
    });
    */ ?>
</script>
<?php
/*
//$.getScript = function(url, callback, cache){
        //    $.ajax({
        //            type: "GET",
        //            url: url,
        //            success: callback,
        //            dataType: "script",
        //            cache: cache
        //    });
        //};
        //$.ajaxSetup({ cache: true });
        //$.getScript('/<?php echo $sf_user->getCulture(); ?>/text/disqusembed');
        
        var disqus_code =  $("#disqus_iframe").contents().find("#disqus_embed").text();
        //alert( disqus_code );
        //alert( disqus_code );
        //$("#disqus_script").text( disqus_code );
        // http://blog.client9.com/2008/11/javascript-eval-in-global-scope.html   
        //alert( disqus_code );
        //eval( disqus_code );
        
        //if (disqus_code) {
            // в IE переменные, объявленные с использованием var не будут доступны в глобальной области видимости
            //if (typeof window.execScript != "undefind") {
            //    window.execScript(disqus_code);        
            //} else { // other browsers
            //    eval.call(null, disqus_code);
            //}
        result = jQuery.globalEval( disqus_code );
        
        //}
        //$("#disqus_script").attr("src", "/<?php echo $sf_user->getCulture(); ?>/text/disqusembed");
*/ 
?>
<?php /*<iframe src="/<?php echo $sf_user->getCulture(); ?>/text/disqusembed" width="0" height="0" id="disqus_iframe"></iframe> 
*/ ?>
<script type="text/javascript" src="/<?php echo $sf_user->getCulture(); ?>/text/disqusembed" ></script>

<?php
/*
<style type="text/css">
    #wrapper #dsq-content {
    font-size: 11px;
    font-family: Verdana;
    }
    #dsq-content .dsq-item-trackback,
    #dsq-content #dsq-pagination {
    display: none;
    }
</style>
*/ ?>
<?php /*<noscript><p class="error_list p1 center_text"><?php echo __('Please, enable JavaScript!') ?></p></noscript> */ ?>
<a href="http://disqus.com" id="dsq-brlink">blog comments powered by DISQUS</a> 

<?php /*include_partial('comments/showlist', array('comments_list'=>$comments_list) ); */?>
<?php /*
<div id="elComments">
	<?php if ($comments_list): ?>
		<?php /*<hr class="light"/>/ ?>
		<?php foreach($comments_list as $i=>$comment): ?>
			<p class="comments_author no_decor small" id="comment_<?php echo $comment['id'] ?>">
                <?php if ($comment['profile']): ?>
                    <strong><a href="<?php echo $comment['profile']; ?>" rel="nofollow" target="_blank"><?php echo $comment['name']; ?></a></strong>
                <?php else: ?>
                    <strong><?php echo $comment['name']; ?></strong>
                <?php endif ?>
				<span class="date"><?php echo format_datetime( $comment['created_at'], 'd MMM yyyy'); ?></span>&nbsp;	
                <a href="#comment_<?php echo $comment['id'] ?>">#</a>&nbsp;
                <?php if ($i%3 == 0):?><a href="#comments">↑</a><?php endif ?>
                <?php if ($comment['status'] == CommentsPeer::STATUS_HIDDEN): ?>
                    
                    <a href="javascript:showComment('<?php echo $comment['id'] ?>')" class="right"><?php echo __('show/hide') ?></a>
                    <br/><br/>
                <?php endif ?>
			</p>
			<p class="comments_body no_decor" id="comment_body_<?php echo $comment['id'] ?>" <?php if ($comment['status'] == CommentsPeer::STATUS_HIDDEN): ?>style="display:none;"<?php endif ?>>
				<?php echo CommentsPeer::prepareBody( $comment['body'] ); ?>
			</p>
			<hr class="light"/>
		<?php endforeach ?>
	<?php endif ?>
</div>

<?php /*include_component('comments', 'post', array('from'=>$for, 'id'=>$id, 'body_id'=>$for)) / ?>

*/ ?>