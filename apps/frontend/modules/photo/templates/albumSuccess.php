<?php slot('body_id') ?>body_photo<?php end_slot() ?>

<?php 
/*
$navigation_html = get_partial('global/navigation', array('pager'=>$pager, 'module_action'=>'photo/album?id=' . $sf_request->getParameter('id') ) ); 
echo $navigation_html;*/

$photo_list = $pager->getResults();

$author = $photoalbum->getAuthor($sf_user->getCulture(), $photo_list);
?>

<h1><?php echo __('Photo Album') ?></h1>

<p class="bread_crumbs">	
	<a href="<?php echo url_for('@main'); ?>"><?php echo __('Home') ?></a> » <a href="<?php echo url_for('photoalbum_index'); ?>"><?php echo __('Photo Albums') ?></a>     
</p>
<div class="box photoalbum_container">
<h2 class="title"><?php echo $photoalbum->getTitle($sf_user->getCulture(), true);?></h2>
<p class="light center_text">
    <?php echo format_datetime( $photoalbum->getCreatedAt(), 'd MMMM yyyy'); ?> | 
    <?php echo __('Photo') ?>: <?php echo $photoalbum->countPhotos(); ?>
    <?php if ($author): ?>
        | <strong><?php echo __('Author') ?>:</strong> <?php echo $author ?>
    <?php endif ?>
</p>
<?php $body = $photoalbum->getBody($sf_user->getCulture(), true); ?>
<?php if($body): ?>
    <p><?php echo $body;?></p>
<?php endif ?>
</div>

<?php if (count($photo_list )): ?>
	<?php include_partial('photo/list', array('photo_list'=>$photo_list)); ?>
<?php else: ?>
	<p class="center error_list p2">
		<?php echo __('No Photos') ?>
	</p>
<?php endif ?>

<?php /*echo $navigation_html;*/ ?>

<?php include_component('item2item', 'show', array('item_type'=>ItemtypesPeer::ITEM_TYPE_PHOTOALBUM, 'item_id'=>$photoalbum->getId())) ?> 

<br />
<?php include_component('comments', 'show'); ?>	