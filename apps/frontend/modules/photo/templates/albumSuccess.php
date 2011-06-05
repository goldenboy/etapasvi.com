<?php slot('body_id') ?>body_photo<?php end_slot() ?>
<h1><?php echo __('Photo Album') ?></h1>

<p class="bread_crumbs">	
	<a href="<?php echo url_for('@main'); ?>"><?php echo __('Home') ?></a> » <a href="<?php echo url_for('@photo_albums'); ?>"><?php echo __('Photo Albums') ?></a> » <?php echo $photoalbum->getTitle($sf_user->getCulture(), true);?>
</p>

<?php 
$navigation_html = get_partial('global/navigation', array('pager'=>$pager, 'module_action'=>'photo/album?id=' . $sf_request->getParameter('id') ) ); 
echo $navigation_html;

$photo_list = $pager->getResults();
?>

<?php if (count($photo_list )): ?>
	<?php include_partial('photo/list', array('photo_list'=>$photo_list)); ?>
<?php else: ?>
	<p class="center error_list p2">
		<?php echo __('No Photos') ?>
	</p>
<?php endif ?>

<?php echo $navigation_html; ?>

<?php include_component('item2item', 'show', array('item_type'=>ItemtypesPeer::ITEM_TYPE_PHOTOALBUM, 'item_id'=>$photoalbum->getId())) ?> 

<br />
<?php include_component('comments', 'show'); ?>	