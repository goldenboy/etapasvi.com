<?php 
if (empty($plus_digits)) {
    $plus_digits = 5; 
}
?>
<?php
if (strstr($module_action, '?')) {
    $splitter = '&';
} else {
    $splitter = '?';
}

if (empty($page)) {
    $have_to_paginate   = $pager->haveToPaginate();
    $first_page         = $pager->getFirstPage();
    $last_page          = $pager->getLastPage();
    $page               = $pager->getPage();
    //$page_numbers_list  = $pager->getLinks($plus_digits * 2 + 1);
    $page_numbers_list  = $pager->getLinks($plus_digits * 2 + 1);
} 

include_partial(
    'global/navigation_universal', 
    array(
        'module_action'      => $module_action,
        'plus_digits'        => $plus_digits,
        'have_to_paginate'   => $have_to_paginate,
        'first_page'         => $first_page,
        'last_page'          => $last_page,
        'page'               => $page,
        'page_numbers_list'  => $page_numbers_list
    )
); 
?>