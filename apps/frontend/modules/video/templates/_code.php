<?php if (!empty($code)): ?>
    <?php if (strlen($code) <20): ?>
    <iframe height="382" frameborder="0" width="520" allowfullscreen="" src="http://www.youtube.com/embed/<?php echo $code; ?>?cc_load_policy=1&amp;hl=<?php echo UserPeer::getCultureMsdn(); ?>&wmode=opaque&cc_lang_pref=<?php echo UserPeer::getCultureMsdn(); ?>"></iframe>
    <?php else: ?>
        <?php echo html_entity_decode($code); ?>
    <?php endif ?>
<?php endif ?>