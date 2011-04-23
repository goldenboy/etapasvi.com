<?php $plus_digits = 5; ?>
<?php
if ($sf_request->getParameter($order_parameter)) {
	$orderby = '&' . $order_parameter . '=' . $sf_request->getParameter($order_parameter);
}
?>
<?php if ($pager->haveToPaginate()): ?>
<div class="navigation small">

	<?php if ($pager->getFirstPage() != $pager->getPage() && $pager->getPage() - 2 > 1): ?>
		<a href="<?php echo ($orderby != '') ? url_for($module_action.'?'.$orderby) : url_for($module_action) ?>" class="arrow_prev">1</a>
	<?php endif ?>

	<?php if ($pager->getPreviousPage() != $pager->getPage()): ?>
		<a href="<?php 
			echo ( ($pager->getPreviousPage()==1) 
			? url_for($module_action.str_replace('&', '?', $orderby)) 
			: url_for($module_action.'?page='.$pager->getPreviousPage().$orderby) ); ?>" class="arrow_prev">..</a>
	<?php endif ?>
	
	<?php $links = $pager->getLinks(); foreach ($links as $page): ?>	
	<?php if ( $page < $pager->getPage() - $plus_digits || $page > $pager->getPage() + $plus_digits ) continue; ?>
	<?php if ($page == $pager->getPage()): ?>
		<?php echo $page; ?>
	<?php else: ?>
		<?php echo ( ($page==1) ? link_to($page, $module_action.str_replace('&', '?', $orderby)) : link_to($page, $module_action.'?page='.$page.$orderby) ); ?>
	<?php endif ?>
	<?php endforeach ?>

	<?php if ($pager->getNextPage() != $pager->getPage() ): ?>
		<a href="<?php echo url_for($module_action.'?page='.$pager->getNextPage().$orderby) ?>" class="arrow_next">..</a>
	<?php endif ?>

	<?php if ($pager->getLastPage() != $pager->getPage() && $pager->getPage() + 2 < $pager->getLastPage()): ?>
		<a href="<?php echo url_for($module_action.'?page='.$pager->getLastPage().$orderby) ?>" class="arrow_next"><?php echo $pager->getLastPage(); ?></a>
	<?php endif ?>
</div>
<?php endif ?>