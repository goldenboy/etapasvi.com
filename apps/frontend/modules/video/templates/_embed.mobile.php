<?php if (!empty($code)): ?>
    <?php if (strlen($code) <20): ?>
    <?php /* YouTube */ ?>
    <iframe height="349" frameborder="0" width="560" allowfullscreen="" src="http://www.youtube.com/embed/<?php echo $code; ?>?cc_load_policy=1&amp;hl=<?php echo UserPeer::getCultureIso($sf_user->getCulture()); ?>&amp;version=3"></iframe></br>
    <a href="http://www.youtube.com/watch?v=<?php echo $code; ?>"><?php echo __('Watch on YouTube'); ?></a>
    <?php else: ?>
        <?php echo html_entity_decode($code); ?>
    <?php endif ?>	
<?php endif ?>	
    