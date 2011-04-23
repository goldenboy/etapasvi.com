<?php $plus_digits = 5; ?>
<?php
if (strstr($module_action, '?')) {
    $splitter = '&';
} else {
    $splitter = '?';
}
/*if (!empty($order_parameter) && $sf_request->getParameter($order_parameter)) {
	$orderby = '&' . $order_parameter . '=' . $sf_request->getParameter($order_parameter);
}*/
?>
<?php if ($pager->haveToPaginate()): ?>
<div class="navigation small">

	<?php $show_prev = $pager->getFirstPage() != $pager->getPage() && ($pager->getPage() - $plus_digits >= 2); ?>
	<?php $show_next = $pager->getLastPage() != $pager->getPage() && ($pager->getPage() + $plus_digits <= $pager->getLastPage() - 1); ?>

	<?php if ($show_prev): ?>
		<a href="<?php echo /*($orderby != '') ? url_for($module_action.$splitter.$orderby) : */url_for($module_action) ?>" class="arrow_prev">1</a>
		<a href="<?php 
			echo $pager->getPage() - $plus_digits; ?>" class="arrow_prev">..</a>
	<?php endif ?>
	
	<?php foreach ($pager->getLinks($plus_digits * 2 + 1) as $page): ?>	
		<?php if ( ($show_prev && $page < $pager->getPage() - $plus_digits + 1) || ($show_next && $page > $pager->getPage() + $plus_digits - 1) ) continue; ?>
		<?php if ($page == $pager->getPage()): ?>
			<span class="nav_selected"><?php echo $page; ?></span>
		<?php else: ?>
			<?php echo ( ($page==1) ? link_to($page, $module_action/*.str_replace('&', '?', $orderby)*/) : link_to($page, $module_action.$splitter.'page='.$page/*.$orderby*/) ); ?>
		<?php endif ?>
	<?php endforeach ?>

	<?php if ($show_next): ?>
		<a href="<?php echo url_for($module_action.$splitter.'page='.($pager->getPage() + $plus_digits)/*.$orderby*/) ?>" class="arrow_next">..</a>
		<a href="<?php echo url_for($module_action.$splitter.'page='.$pager->getLastPage()/*.$orderby*/) ?>" class="arrow_next"><?php echo $pager->getLastPage(); ?></a>
	<?php endif ?>
</div>
<?php endif ?>