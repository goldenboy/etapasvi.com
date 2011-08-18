<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<rss version="2.0">
<channel>
    <title>eTapasvi.com</title>
  	<link>http://<?php echo $link ?></link>
    <description><?php echo __('Dharma Sangha (aka Palden Dorje, Ram Bahadur Bomjan, Buddha Boy from Nepal): News, Photo, Video, Biography, Speeches.') ?></description>        
    <language><?php echo $language ?></language>
    <lastBuildDate><?php echo $last_build_date ?></lastBuildDate>
    <atom10:link xmlns:atom10="http://www.w3.org/2005/Atom" rel="self" type="application/rss+xml" href="http://www.etapasvi.com/<?php echo $language ?>/news/rss" />
    <?php if (!empty($items)): ?>
    <?php foreach($items as $item): ?>
<?php if (!empty($item['title'])): ?>
    <item>
        <title><?php echo $item['title'] ?></title>
        <link><?php echo $item['link'] ?></link>
        <guid><?php echo $item['guid'] ?></guid>
        <?php if (!empty($item['description'])): ?>
            <description><![CDATA[<?php echo html_entity_decode($item['description']) ?>]]></description>
        <?php endif ?>
        <pubDate><?php echo $item['pub_date'] ?></pubDate>
    </item>
<?php endif ?>
    <?php endforeach ?>
    <?php endif ?>
</channel>
</rss>