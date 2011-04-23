<?php slot('body_id') ?>body_feed<?php end_slot() ?>
<h1><?php echo __('Feed') ?></h1>

<a href="http://feeds.feedburner.com/<?php echo $sf_user->getCulture(); ?>/etapasvi" rel="alternate" type="application/rss+xml" class="rss_link"><img src="http://www.feedburner.com/fb/images/pub/feed-icon16x16.png" alt="" /></a>

<?php 
$navigation_html = get_partial(
    'global/navigation', 
    array(
        'module_action'      => 'news/feed',
        'have_to_paginate'   => true,
        'first_page'         => 1,
        'last_page'          => $last_page,
        'page'               => $page,
        'page_numbers_list'  => $page_numbers_list
    ) 
); 
echo $navigation_html;
?>

<?php foreach($feed_list as $feed_item): ?>
    <?php if (empty($feed_item['type']) || empty($feed_item['list'])): ?>
        <?php continue; ?>
    <?php endif ?>
    <?php include_partial( strtolower($feed_item['type']) . '/list', array(strtolower($feed_item['type']) . '_list' => $feed_item['list'])); ?>
    <br/>
<?php endforeach ?>

<a href="http://feeds.feedburner.com/<?php echo $sf_user->getCulture(); ?>/etapasvi" rel="alternate" type="application/rss+xml" class="rss_link"><img src="http://www.feedburner.com/fb/images/pub/feed-icon16x16.png" alt="" /></a>

<?php echo $navigation_html; ?>