<?php slot('body_id') ?>body_social_tools<?php end_slot() ?>

<h1><?php echo __('Social Tools') ?></h1>

<div class="cyrcle center">
    <div> </div>
    
    <?php/*
    <a href="http://www.etapasvi.com/forum/index.php?lang=<?php echo $sf_user->getCulture(); ?>" target="_blank"><img src="/i/social/forum_64.png" title="<?php echo __('Forum') ?>" alt="<?php echo __('Forum') ?>"/></a>*/?>
    
    
      <a href="<?php echo url_for('@livestream', true); ?>" target="_blank" title="<?php echo __('LiveStream') ?>" class="social_livestream"><span><?php echo __('LiveStream') ?></span></a>
    <?php /* ?>
        <a href="http://etapasvi.blogspot.com/" target="_blank"><img src="/i/social/blogger_64.png" title="<?php echo __('Blogger') ?>" alt="<?php echo __('Blogger') ?>"/></a>
    <? */ ?> 
    
    <a href="http://kiwi6.com/users/show/etapasvi" target="_blank" title="<?php echo __('Kiwi6') ?>" class="social_kiwi6"><span><?php echo __('Kiwi6') ?></span></a>
    <a href="http://twitter.com/etapasvi" target="_blank" title="<?php echo __('Twitter') ?>" class="social_twitter"><span><?php echo __('Twitter') ?></span></a>
    <br/>
    <a href="http://etapasvi.livejournal.com/" target="_blank" title="<?php echo __('Live Journal') ?>" class="social_livejournal"><span><?php echo __('Live Journal') ?></span></a>
    
    <?php if ($sf_user->getCulture() == 'ru'): ?>        
         <a href="http://vaikuntha.ru/blog/dharmas/" target="_blank" title="<?php echo __('Вайкунтха') ?>" class="social_vaikuntha"><span><?php echo __('Вайкунтха') ?></span></a>       
         <a href="http://vkontakte.ru/etapasvi" target="_blank" title="<?php echo __('ВКонтакте') ?>" class="social_vkontakte"><span><?php echo __('ВКонтакте') ?></span></a> 
    <?php else: ?>        
        <a href="http://www.facebook.com/group.php?gid=113379818705184" target="_blank" title="<?php echo __('Facebook') ?>" class="social_facebook"><span><?php echo __('Facebook') ?></span></a>    
    <?php endif ?>       

    <?php if ($sf_user->getCulture() == 'hu'): ?>
        <a href="http://groups.google.com/group/buddhafiu/" target="_blank" title="<?php echo __('Google') ?>" class="social_google"><span><?php echo __('Google') ?></span></a>
    <?php elseif ($sf_user->getCulture() == 'ja'): ?>
        <a href="http://groups.google.com/group/dharmasangha-jp" target="_blank" title="<?php echo __('Google') ?>" class="social_google"><span><?php echo __('Google') ?></span></a>
    <?php elseif ($sf_user->getCulture() != 'ru'): ?>
        <a href="http://groups.google.com/group/buddhaboy" target="_blank" title="<?php echo __('Google') ?>" class="social_google"><span><?php echo __('Google') ?></span></a>
    <? endif ?>
    <a href="http://m.maploco.com/details/3542bmdt" target="_blank" title="<?php echo __('Visitor Map') ?>" class="social_visitor_map"><span><?php echo __('Visitor Map') ?></span></a>
    <br/>
    <a href="http://www.youtube.com/user/etapasvi" target="_blank" title="<?php echo __('YouTube') ?>" class="social_youtube"><span><?php echo __('YouTube') ?></span></a> 
    <a href="https://picasaweb.google.com/105320929368395530858" target="_blank" title="<?php echo __('Picasa') ?>" class="social_picasa"><span><?php echo __('Picasa') ?></span></a>     
    <a href="http://feeds.feedburner.com/<?php echo $sf_user->getCulture(); ?>/etapasvi" target="_blank" title="<?php echo __('RSS') ?>" class="social_rss"><span><?php echo __('RSS') ?></span></a>
</div>