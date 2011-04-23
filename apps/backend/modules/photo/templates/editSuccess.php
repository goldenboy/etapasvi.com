<?php use_helper('Object', 'Validation', 'ObjectAdmin', 'I18N', 'Date') ?>

<?php use_stylesheet('/sf_data_lsdfkr/sf_admin/css/main') ?>

<div id="sf_admin_container">

<h1><?php echo __('edit photo', 
array()) ?></h1>

<div id="sf_admin_header">
<?php include_partial('photo/edit_header', array('photo' => $photo)) ?>
</div>

<div id="sf_admin_content">
<?php include_partial('photo/edit_messages', array('photo' => $photo, 'labels' => $labels)) ?>
<?php include_partial('photo/edit_form', array('photo' => $photo, 'labels' => $labels, 'url_to_login_page' => $url_to_login_page)) ?>
</div>

<div id="sf_admin_footer">
<?php include_partial('photo/edit_footer', array('photo' => $photo)) ?>
</div>

</div>
