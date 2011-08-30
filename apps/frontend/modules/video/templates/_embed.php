<?php if (!empty($code)): ?>
    <?php if (strlen($code) <20): ?>
    <object width="480" height="385"><param name="movie" value="http://www.youtube-nocookie.com/v/<?php echo $code; ?>&amp;fs=1&amp;hl=<?php echo UserPeer::getCultureMsdn(); ?>&amp;cc_load_policy=1&amp;version=3&amp;"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube-nocookie.com/v/<?php echo $code; ?>&amp;fs=1&amp;hl=<?php echo UserPeer::getCultureMsdn(); ?>&amp;cc_load_policy=1&amp;version=3" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="480" height="385"></embed></object>
    <?php else: ?>
        <?php echo html_entity_decode($code); ?>
    <?php endif ?>
<?php endif ?>