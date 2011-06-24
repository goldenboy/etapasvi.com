<?php slot('body_id') ?>body_social_tools<?php end_slot() ?>

<h1><?php echo __('Social Tools') ?></h1>

<div class="cyrcle center">
    <div> </div>
    
    <?php/*
    <a href="http://www.etapasvi.com/forum/index.php?lang=<?php echo $sf_user->getCulture(); ?>" target="_blank"><img src="/i/social/forum_64.png" title="<?php echo __('Forum') ?>" alt="<?php echo __('Forum') ?>"/></a>*/?>
    
    
      <a href="<?php echo url_for('@livestream', true); ?>" target="_blank" title="<?php echo __('LiveStream') ?>" class="social_livestream"></a>
    <?php /* ?>
        <a href="http://etapasvi.blogspot.com/" target="_blank"><img src="/i/social/blogger_64.png" title="<?php echo __('Blogger') ?>" alt="<?php echo __('Blogger') ?>"/></a>
    <? */ ?> 
    
    <a href="http://kiwi6.com/users/show/etapasvi" target="_blank" title="<?php echo __('Kiwi6') ?>" class="social_kiwi6"> </a>
    <a href="http://twitter.com/etapasvi" target="_blank" title="<?php echo __('Twitter') ?>" class="social_twitter"></a>
    <br/>
    <a href="http://etapasvi.livejournal.com/" target="_blank" title="<?php echo __('Live Journal') ?>" class="social_livejournal"></a>
    
    <?php if ($sf_user->getCulture() == 'ru'): ?>        
         <a href="http://vaikuntha.ru/blog/dharmas/" target="_blank" title="<?php echo __('Вайкунтха') ?>" class="social_vaikuntha"></a>       
         <a href="http://vkontakte.ru/etapasvi" target="_blank" title="<?php echo __('ВКонтакте') ?>" class="social_vkontakte"></a> 
    <?php else: ?>        
        <a href="http://www.facebook.com/group.php?gid=113379818705184" target="_blank" title="<?php echo __('Facebook') ?>" class="social_facebook"></a>    
    <?php endif ?>       

    <?php if ($sf_user->getCulture() == 'hu'): ?>
        <a href="http://groups.google.com/group/buddhafiu/" target="_blank" title="<?php echo __('Google') ?>" class="social_google"></a>
    <?php elseif ($sf_user->getCulture() == 'ja'): ?>
        <a href="http://groups.google.com/group/dharmasangha-jp" target="_blank" title="<?php echo __('Google') ?>" class="social_google"></a>
    <?php elseif ($sf_user->getCulture() != 'ru'): ?>
        <a href="http://groups.google.com/group/buddhaboy" target="_blank" title="<?php echo __('Google') ?>" class="social_google"></a>
    <? endif ?>
    <a href="http://m.maploco.com/details/3542bmdt" target="_blank" title="<?php echo __('Visitor Map') ?>" class="social_visitor_map"></a>
    <br/>
    <a href="http://www.youtube.com/user/etapasvi" target="_blank" title="<?php echo __('YouTube') ?>" class="social_youtube"></a> 
    <a href="https://picasaweb.google.com/105320929368395530858" target="_blank" title="<?php echo __('Picasa') ?>" class="social_picasa"></a>     
    <a href="http://feeds.feedburner.com/<?php echo $sf_user->getCulture(); ?>/etapasvi" target="_blank" title="<?php echo __('RSS') ?>" class="social_rss"></a>
</div>