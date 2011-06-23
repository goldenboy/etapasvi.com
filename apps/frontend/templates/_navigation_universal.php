<?php
if (strstr($module_action, '?')) {
    $splitter = '&';
} else {
    $splitter = '?';
}

?>
<?php if ($have_to_paginate): ?>
<div class="navigation small">

	<?php $show_prev = $first_page != $page && ($page - $plus_digits >= 2); ?>
	<?php $show_next = $last_page != $page && ($page + $plus_digits <= $last_page - 1); ?>

	<?php if ($show_prev): ?>
		<a href="<?php echo /*($orderby != '') ? url_for($module_action.$splitter.$orderby) : */url_for($module_action) ?>" class="arrow_prev">1</a>&nbsp;
		<a href="<?php 
			echo $page - $plus_digits; ?>" class="arrow_prev">..</a>&nbsp;
	<?php endif ?>
	
	<?php foreach ($page_numbers_list as $page_number): ?>	
		<?php if ( ($show_prev && $page_number < $page - $plus_digits + 1) || ($show_next && $page_number > $page + $plus_digits - 1) ) continue; ?>
		<?php if ($page_number == $page): ?>
			<span class="nav_selected"><?php echo $page_number; ?></span>&nbsp;
		<?php else: ?>
			<?php echo ( ($page_number==1) ? link_to($page_number, $module_action/*.str_replace('&', '?', $orderby)*/) : link_to($page_number, $module_action.$splitter.'page='.$page_number/*.$orderby*/) ); ?>&nbsp;
		<?php endif ?>
	<?php endforeach ?>

	<?php if ($show_next): ?>
		<a href="<?php echo url_for($module_action.$splitter.'page='.($page + $plus_digits)/*.$orderby*/) ?>" class="arrow_next">..</a>&nbsp;
		<a href="<?php echo url_for($module_action.$splitter.'page='.$last_page/*.$orderby*/) ?>" class="arrow_next"><?php echo $last_page; ?></a>&nbsp;
	<?php endif ?>
</div>
<?php endif ?>