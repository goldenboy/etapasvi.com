<?php /*slot('meta') ?>
<link rel="canonical" href="<?php echo url_for('news/show?id='.$newsitem->getId() . '&title=' . TextPeer::urlTranslit($newsitem->getTitle()))?>" /><?php end_slot() */ ?>

<?php slot('body_id') ?>body_<?php echo $newsitem->getTypeName(); ?><?php end_slot() ?>
<h1 id="top"><?php echo __($newsitem->getTypeNameCapital()) ?></h1>

<p class="bread_crumbs">	
	<a href="<?php echo url_for('@main'); ?>"><?php echo __('Home') ?></a> » <a href="<?php echo url_for('@' . $newsitem->getTypeName() . '_index'); ?>"><?php echo __($newsitem->getTypeNameCapital()) ?></a>
</p>

<div class="box newsitem newsfull">
    <?php include_partial('show', array('newsitem'=>$newsitem) ); ?>
</div>