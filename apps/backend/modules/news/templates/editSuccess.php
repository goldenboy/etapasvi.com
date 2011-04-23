<?php use_helper('Object', 'Validation', 'ObjectAdmin', 'I18N', 'Date') ?>

<?php use_stylesheet('/sf_data_lsdfkr/sf_admin/css/main') ?>

<div id="sf_admin_container">

<h1><?php echo __('edit news', 
array()) ?></h1>

<div id="sf_admin_header">
<?php include_partial('news/edit_header', array('news' => $news)) ?>
</div>

<div id="sf_admin_content">
<?php include_partial('news/edit_messages', array('news' => $news, 'labels' => $labels)) ?>
<?php include_partial('news/edit_form', array('news' => $news, 'labels' => $labels, 'url_to_login_page' => $url_to_login_page)) ?>
</div>

<div id="sf_admin_footer">
<?php include_partial('news/edit_footer', array('news' => $news)) ?>
</div>

</div>
