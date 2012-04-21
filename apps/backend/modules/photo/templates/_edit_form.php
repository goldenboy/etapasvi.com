<?php echo form_tag('photo/save', array(
  'id'        => 'sf_admin_edit_form',
  'name'      => 'sf_admin_edit_form',
  'multipart' => true,
)) ?>

<?php echo object_input_hidden_tag($photo, 'getId') ?>

<?php include_partial('edit_actions', array('photo' => $photo)) ?>

<fieldset id="sf_fieldset_none" class="">

<div class="form-row">
  <?php echo label_for('photo[photoalbum_id]', __($labels['photo{photoalbum_id}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{photoalbum_id}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{photoalbum_id}')): ?>
    <?php echo form_error('photo{photoalbum_id}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_select_tag($photo, 'getPhotoalbumId', array (
  'related_class' => 'Photoalbum',
  'control_name' => 'photo[photoalbum_id]',
  'include_blank' => true,
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[show]', __($labels['photo{show}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{show}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{show}')): ?>
    <?php echo form_error('photo{show}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_checkbox_tag($photo, 'getShow', array (
  'control_name' => 'photo[show]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[order]', __($labels['photo{order}']), 'class="required" ') ?>
  <div class="content<?php if ($sf_request->hasError('photo{order}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{order}')): ?>
    <?php echo form_error('photo{order}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getOrder', array (
  'size' => 7,
  'control_name' => 'photo[order]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
<?php if (empty($url_to_login_page)): ?>
  <?php echo label_for('photo[img]', __($labels['photo{img}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{img}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{img}')): ?>
    <?php echo form_error('photo{img}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_admin_input_file_tag($photo, 'getImg', array (
  'control_name' => 'photo[img]',
  'include_link' => 'photo',
  'include_remove' => true,
)); echo $value ? $value : '&nbsp;' ?>

	<input type="checkbox" value="1" id="photo_watermark" name="photo[watermark]" checked="checked"> watermark 
    <select name="photo[watermark_position]">
        <option value="bottom-right">bottom-right</option>
        <option value="bottom-left">bottom-left</option>
        <option value="top-left">top-left</option>
        <option value="top-right">top-right</option>
    </select>
    </div>
<?php else: ?>
<a href="<?php echo html_entity_decode($url_to_login_page)?>" target="_blank">Authorize in Picasa</a>
<?php endif ?>
</div>

<div class="form-row">
  <?php echo label_for('photo[img]', __($labels['photo{img}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{img}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{img}')): ?>
    <?php echo form_error('photo{img}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = get_partial('img', array('type' => 'edit', 'photo' => $photo)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[full_path]', __($labels['photo{full_path}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{full_path}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{full_path}')): ?>
    <?php echo form_error('photo{full_path}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getFullPath', array (
  'size' => 80,
  'control_name' => 'photo[full_path]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[full_link]', __($labels['photo{full_link}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{full_link}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{full_link}')): ?>
    <?php echo form_error('photo{full_link}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = get_partial('full_link', array('type' => 'edit', 'photo' => $photo)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[preview_path]', __($labels['photo{preview_path}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{preview_path}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{preview_path}')): ?>
    <?php echo form_error('photo{preview_path}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getPreviewPath', array (
  'size' => 80,
  'control_name' => 'photo[preview_path]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[preview_link]', __($labels['photo{preview_link}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{preview_link}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{preview_link}')): ?>
    <?php echo form_error('photo{preview_link}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = get_partial('preview_link', array('type' => 'edit', 'photo' => $photo)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[thumb_path]', __($labels['photo{thumb_path}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{thumb_path}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{thumb_path}')): ?>
    <?php echo form_error('photo{thumb_path}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getThumbPath', array (
  'size' => 80,
  'control_name' => 'photo[thumb_path]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[thumb_link]', __($labels['photo{thumb_link}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{thumb_link}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{thumb_link}')): ?>
    <?php echo form_error('photo{thumb_link}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = get_partial('thumb_link', array('type' => 'edit', 'photo' => $photo)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[created_at]', __($labels['photo{created_at}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{created_at}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{created_at}')): ?>
    <?php echo form_error('photo{created_at}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_date_tag($photo, 'getCreatedAt', array (
  'rich' => true,
  'withtime' => true,
  'calendar_button_img' => '/sf_data_lsdfkr/sf_admin/images/date.png',
  'control_name' => 'photo[created_at]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[link]', __($labels['photo{link}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{link}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{link}')): ?>
    <?php echo form_error('photo{link}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getLink', array (
  'size' => 80,
  'control_name' => 'photo[link]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[width]', __($labels['photo{width}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{width}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{width}')): ?>
    <?php echo form_error('photo{width}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getWidth', array (
  'size' => 7,
  'control_name' => 'photo[width]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[height]', __($labels['photo{height}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{height}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{height}')): ?>
    <?php echo form_error('photo{height}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getHeight', array (
  'size' => 7,
  'control_name' => 'photo[height]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_en" class="">
<h2><?php echo __('EN') ?></h2>


<div class="form-row">
  <?php echo label_for('photo[title_i18n_en]', __($labels['photo{title_i18n_en}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{title_i18n_en}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{title_i18n_en}')): ?>
    <?php echo form_error('photo{title_i18n_en}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getTitleI18nEn', array (
  'disabled' => false,
  'control_name' => 'photo[title_i18n_en]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[body_i18n_en]', __($labels['photo{body_i18n_en}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{body_i18n_en}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{body_i18n_en}')): ?>
    <?php echo form_error('photo{body_i18n_en}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($photo, 'getBodyI18nEn', array (
  'control_name' => 'photo[body_i18n_en]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[author_i18n_en]', __($labels['photo{author_i18n_en}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{author_i18n_en}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{author_i18n_en}')): ?>
    <?php echo form_error('photo{author_i18n_en}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getAuthorI18nEn', array (
  'disabled' => false,
  'control_name' => 'photo[author_i18n_en]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_ru" class="">
<h2><?php echo __('RU') ?></h2>


<div class="form-row">
  <?php echo label_for('photo[title_i18n_ru]', __($labels['photo{title_i18n_ru}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{title_i18n_ru}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{title_i18n_ru}')): ?>
    <?php echo form_error('photo{title_i18n_ru}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getTitleI18nRu', array (
  'disabled' => false,
  'control_name' => 'photo[title_i18n_ru]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[body_i18n_ru]', __($labels['photo{body_i18n_ru}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{body_i18n_ru}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{body_i18n_ru}')): ?>
    <?php echo form_error('photo{body_i18n_ru}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($photo, 'getBodyI18nRu', array (
  'control_name' => 'photo[body_i18n_ru]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[author_i18n_ru]', __($labels['photo{author_i18n_ru}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{author_i18n_ru}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{author_i18n_ru}')): ?>
    <?php echo form_error('photo{author_i18n_ru}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getAuthorI18nRu', array (
  'disabled' => false,
  'control_name' => 'photo[author_i18n_ru]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_cs" class="">
<h2><?php echo __('CS') ?></h2>


<div class="form-row">
  <?php echo label_for('photo[title_i18n_cs]', __($labels['photo{title_i18n_cs}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{title_i18n_cs}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{title_i18n_cs}')): ?>
    <?php echo form_error('photo{title_i18n_cs}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getTitleI18nCs', array (
  'disabled' => false,
  'control_name' => 'photo[title_i18n_cs]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[body_i18n_cs]', __($labels['photo{body_i18n_cs}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{body_i18n_cs}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{body_i18n_cs}')): ?>
    <?php echo form_error('photo{body_i18n_cs}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($photo, 'getBodyI18nCs', array (
  'control_name' => 'photo[body_i18n_cs]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[author_i18n_cs]', __($labels['photo{author_i18n_cs}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{author_i18n_cs}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{author_i18n_cs}')): ?>
    <?php echo form_error('photo{author_i18n_cs}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getAuthorI18nCs', array (
  'disabled' => false,
  'control_name' => 'photo[author_i18n_cs]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_hu" class="">
<h2><?php echo __('HU') ?></h2>


<div class="form-row">
  <?php echo label_for('photo[title_i18n_hu]', __($labels['photo{title_i18n_hu}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{title_i18n_hu}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{title_i18n_hu}')): ?>
    <?php echo form_error('photo{title_i18n_hu}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getTitleI18nHu', array (
  'disabled' => false,
  'control_name' => 'photo[title_i18n_hu]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[body_i18n_hu]', __($labels['photo{body_i18n_hu}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{body_i18n_hu}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{body_i18n_hu}')): ?>
    <?php echo form_error('photo{body_i18n_hu}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($photo, 'getBodyI18nHu', array (
  'control_name' => 'photo[body_i18n_hu]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[author_i18n_hu]', __($labels['photo{author_i18n_hu}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{author_i18n_hu}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{author_i18n_hu}')): ?>
    <?php echo form_error('photo{author_i18n_hu}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getAuthorI18nHu', array (
  'disabled' => false,
  'control_name' => 'photo[author_i18n_hu]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_pl" class="">
<h2><?php echo __('PL') ?></h2>


<div class="form-row">
  <?php echo label_for('photo[title_i18n_pl]', __($labels['photo{title_i18n_pl}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{title_i18n_pl}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{title_i18n_pl}')): ?>
    <?php echo form_error('photo{title_i18n_pl}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getTitleI18nPl', array (
  'disabled' => false,
  'control_name' => 'photo[title_i18n_pl]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[body_i18n_pl]', __($labels['photo{body_i18n_pl}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{body_i18n_pl}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{body_i18n_pl}')): ?>
    <?php echo form_error('photo{body_i18n_pl}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($photo, 'getBodyI18nPl', array (
  'control_name' => 'photo[body_i18n_pl]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[author_i18n_pl]', __($labels['photo{author_i18n_pl}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{author_i18n_pl}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{author_i18n_pl}')): ?>
    <?php echo form_error('photo{author_i18n_pl}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getAuthorI18nPl', array (
  'disabled' => false,
  'control_name' => 'photo[author_i18n_pl]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_fr" class="">
<h2><?php echo __('FR') ?></h2>


<div class="form-row">
  <?php echo label_for('photo[title_i18n_fr]', __($labels['photo{title_i18n_fr}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{title_i18n_fr}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{title_i18n_fr}')): ?>
    <?php echo form_error('photo{title_i18n_fr}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getTitleI18nFr', array (
  'disabled' => false,
  'control_name' => 'photo[title_i18n_fr]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[body_i18n_fr]', __($labels['photo{body_i18n_fr}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{body_i18n_fr}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{body_i18n_fr}')): ?>
    <?php echo form_error('photo{body_i18n_fr}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($photo, 'getBodyI18nFr', array (
  'control_name' => 'photo[body_i18n_fr]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[author_i18n_fr]', __($labels['photo{author_i18n_fr}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{author_i18n_fr}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{author_i18n_fr}')): ?>
    <?php echo form_error('photo{author_i18n_fr}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getAuthorI18nFr', array (
  'disabled' => false,
  'control_name' => 'photo[author_i18n_fr]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_zh_cn" class="">
<h2><?php echo __('zh_CN') ?></h2>


<div class="form-row">
  <?php echo label_for('photo[title_i18n_zh_cn]', __($labels['photo{title_i18n_zh_cn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{title_i18n_zh_cn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{title_i18n_zh_cn}')): ?>
    <?php echo form_error('photo{title_i18n_zh_cn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getTitleI18nZhCN', array (
  'disabled' => false,
  'control_name' => 'photo[title_i18n_zh_cn]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[body_i18n_zh_cn]', __($labels['photo{body_i18n_zh_cn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{body_i18n_zh_cn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{body_i18n_zh_cn}')): ?>
    <?php echo form_error('photo{body_i18n_zh_cn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($photo, 'getBodyI18nZhCN', array (
  'control_name' => 'photo[body_i18n_zh_cn]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[author_i18n_zh_cn]', __($labels['photo{author_i18n_zh_cn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{author_i18n_zh_cn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{author_i18n_zh_cn}')): ?>
    <?php echo form_error('photo{author_i18n_zh_cn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getAuthorI18nZhCN', array (
  'disabled' => false,
  'control_name' => 'photo[author_i18n_zh_cn]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_vi" class="">
<h2><?php echo __('VI') ?></h2>


<div class="form-row">
  <?php echo label_for('photo[title_i18n_vi]', __($labels['photo{title_i18n_vi}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{title_i18n_vi}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{title_i18n_vi}')): ?>
    <?php echo form_error('photo{title_i18n_vi}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getTitleI18nVi', array (
  'disabled' => false,
  'control_name' => 'photo[title_i18n_vi]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[body_i18n_vi]', __($labels['photo{body_i18n_vi}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{body_i18n_vi}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{body_i18n_vi}')): ?>
    <?php echo form_error('photo{body_i18n_vi}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($photo, 'getBodyI18nVi', array (
  'control_name' => 'photo[body_i18n_vi]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[author_i18n_vi]', __($labels['photo{author_i18n_vi}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{author_i18n_vi}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{author_i18n_vi}')): ?>
    <?php echo form_error('photo{author_i18n_vi}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getAuthorI18nVi', array (
  'disabled' => false,
  'control_name' => 'photo[author_i18n_vi]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_de" class="">
<h2><?php echo __('DE') ?></h2>


<div class="form-row">
  <?php echo label_for('photo[title_i18n_de]', __($labels['photo{title_i18n_de}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{title_i18n_de}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{title_i18n_de}')): ?>
    <?php echo form_error('photo{title_i18n_de}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getTitleI18nDe', array (
  'disabled' => false,
  'control_name' => 'photo[title_i18n_de]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[body_i18n_de]', __($labels['photo{body_i18n_de}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{body_i18n_de}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{body_i18n_de}')): ?>
    <?php echo form_error('photo{body_i18n_de}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($photo, 'getBodyI18nDe', array (
  'control_name' => 'photo[body_i18n_de]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[author_i18n_de]', __($labels['photo{author_i18n_de}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{author_i18n_de}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{author_i18n_de}')): ?>
    <?php echo form_error('photo{author_i18n_de}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getAuthorI18nDe', array (
  'disabled' => false,
  'control_name' => 'photo[author_i18n_de]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>

<fieldset id="sf_fieldset_ja" class="">
<h2><?php echo __('JA') ?></h2>


<div class="form-row">
  <?php echo label_for('photo[title_i18n_ja]', __($labels['photo{title_i18n_ja}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{title_i18n_ja}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{title_i18n_ja}')): ?>
    <?php echo form_error('photo{title_i18n_ja}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getTitleI18nJa', array (
  'disabled' => false,
  'control_name' => 'photo[title_i18n_ja]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[body_i18n_ja]', __($labels['photo{body_i18n_ja}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{body_i18n_ja}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{body_i18n_ja}')): ?>
    <?php echo form_error('photo{body_i18n_ja}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($photo, 'getBodyI18nJa', array (
  'control_name' => 'photo[body_i18n_ja]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[author_i18n_ja]', __($labels['photo{author_i18n_ja}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{author_i18n_ja}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{author_i18n_ja}')): ?>
    <?php echo form_error('photo{author_i18n_ja}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getAuthorI18nJa', array (
  'disabled' => false,
  'control_name' => 'photo[author_i18n_ja]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_es" class="">
<h2><?php echo __('ES') ?></h2>


<div class="form-row">
  <?php echo label_for('photo[title_i18n_es]', __($labels['photo{title_i18n_es}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{title_i18n_es}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{title_i18n_es}')): ?>
    <?php echo form_error('photo{title_i18n_es}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getTitleI18nEs', array (
  'disabled' => false,
  'control_name' => 'photo[title_i18n_es]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[body_i18n_es]', __($labels['photo{body_i18n_es}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{body_i18n_es}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{body_i18n_es}')): ?>
    <?php echo form_error('photo{body_i18n_es}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($photo, 'getBodyI18nEs', array (
  'control_name' => 'photo[body_i18n_es]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[author_i18n_es]', __($labels['photo{author_i18n_es}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{author_i18n_es}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{author_i18n_es}')): ?>
    <?php echo form_error('photo{author_i18n_es}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getAuthorI18nEs', array (
  'disabled' => false,
  'control_name' => 'photo[author_i18n_es]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>

<fieldset id="sf_fieldset_it" class="">
<h2><?php echo __('IT') ?></h2>


<div class="form-row">
  <?php echo label_for('photo[title_i18n_it]', __($labels['photo{title_i18n_it}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{title_i18n_it}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{title_i18n_it}')): ?>
    <?php echo form_error('photo{title_i18n_it}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getTitleI18nIt', array (
  'disabled' => false,
  'control_name' => 'photo[title_i18n_it]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[body_i18n_it]', __($labels['photo{body_i18n_it}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{body_i18n_it}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{body_i18n_it}')): ?>
    <?php echo form_error('photo{body_i18n_it}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($photo, 'getBodyI18nIt', array (
  'control_name' => 'photo[body_i18n_it]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[author_i18n_it]', __($labels['photo{author_i18n_it}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{author_i18n_it}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{author_i18n_it}')): ?>
    <?php echo form_error('photo{author_i18n_it}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getAuthorI18nIt', array (
  'disabled' => false,
  'control_name' => 'photo[author_i18n_it]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>

<fieldset id="sf_fieldset_et" class="">
<h2><?php echo __('ET') ?></h2>


<div class="form-row">
  <?php echo label_for('photo[title_i18n_et]', __($labels['photo{title_i18n_et}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{title_i18n_et}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{title_i18n_et}')): ?>
    <?php echo form_error('photo{title_i18n_et}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getTitleI18nEt', array (
  'disabled' => false,
  'control_name' => 'photo[title_i18n_et]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[body_i18n_et]', __($labels['photo{body_i18n_et}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{body_i18n_et}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{body_i18n_et}')): ?>
    <?php echo form_error('photo{body_i18n_et}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($photo, 'getBodyI18nEt', array (
  'control_name' => 'photo[body_i18n_et]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[author_i18n_et]', __($labels['photo{author_i18n_et}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{author_i18n_et}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{author_i18n_et}')): ?>
    <?php echo form_error('photo{author_i18n_et}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getAuthorI18nEt', array (
  'disabled' => false,
  'control_name' => 'photo[author_i18n_et]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_ne" class="">
<h2><?php echo __('NE') ?></h2>


<div class="form-row">
  <?php echo label_for('photo[title_i18n_ne]', __($labels['photo{title_i18n_ne}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{title_i18n_ne}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{title_i18n_ne}')): ?>
    <?php echo form_error('photo{title_i18n_ne}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getTitleI18nNe', array (
  'disabled' => false,
  'control_name' => 'photo[title_i18n_ne]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[body_i18n_ne]', __($labels['photo{body_i18n_ne}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{body_i18n_ne}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{body_i18n_ne}')): ?>
    <?php echo form_error('photo{body_i18n_ne}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($photo, 'getBodyI18nNe', array (
  'control_name' => 'photo[body_i18n_ne]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[author_i18n_ne]', __($labels['photo{author_i18n_ne}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{author_i18n_ne}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{author_i18n_ne}')): ?>
    <?php echo form_error('photo{author_i18n_ne}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getAuthorI18nNe', array (
  'disabled' => false,
  'control_name' => 'photo[author_i18n_ne]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_bn" class="">
<h2><?php echo __('BN') ?></h2>


<div class="form-row">
  <?php echo label_for('photo[title_i18n_bn]', __($labels['photo{title_i18n_bn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{title_i18n_bn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{title_i18n_bn}')): ?>
    <?php echo form_error('photo{title_i18n_bn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getTitleI18nBn', array (
  'disabled' => false,
  'control_name' => 'photo[title_i18n_bn]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[body_i18n_bn]', __($labels['photo{body_i18n_bn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{body_i18n_bn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{body_i18n_bn}')): ?>
    <?php echo form_error('photo{body_i18n_bn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($photo, 'getBodyI18nBn', array (
  'control_name' => 'photo[body_i18n_bn]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[author_i18n_bn]', __($labels['photo{author_i18n_bn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{author_i18n_bn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{author_i18n_bn}')): ?>
    <?php echo form_error('photo{author_i18n_bn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getAuthorI18nBn', array (
  'disabled' => false,
  'control_name' => 'photo[author_i18n_bn]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_he" class="">
<h2><?php echo __('HE') ?></h2>


<div class="form-row">
  <?php echo label_for('photo[title_i18n_he]', __($labels['photo{title_i18n_he}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{title_i18n_he}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{title_i18n_he}')): ?>
    <?php echo form_error('photo{title_i18n_he}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getTitleI18nHe', array (
  'disabled' => false,
  'control_name' => 'photo[title_i18n_he]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[body_i18n_he]', __($labels['photo{body_i18n_he}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{body_i18n_he}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{body_i18n_he}')): ?>
    <?php echo form_error('photo{body_i18n_he}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($photo, 'getBodyI18nHe', array (
  'control_name' => 'photo[body_i18n_he]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[author_i18n_he]', __($labels['photo{author_i18n_he}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{author_i18n_he}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{author_i18n_he}')): ?>
    <?php echo form_error('photo{author_i18n_he}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getAuthorI18nHe', array (
  'disabled' => false,
  'control_name' => 'photo[author_i18n_he]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_zh_tw" class="">
<h2><?php echo __('ZH_TW') ?></h2>


<div class="form-row">
  <?php echo label_for('photo[title_i18n_zh_tw]', __($labels['photo{title_i18n_zh_tw}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{title_i18n_zh_tw}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{title_i18n_zh_tw}')): ?>
    <?php echo form_error('photo{title_i18n_zh_tw}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getTitleI18nZhTw', array (
  'disabled' => false,
  'control_name' => 'photo[title_i18n_zh_tw]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[body_i18n_zh_tw]', __($labels['photo{body_i18n_zh_tw}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{body_i18n_zh_tw}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{body_i18n_zh_tw}')): ?>
    <?php echo form_error('photo{body_i18n_zh_tw}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($photo, 'getBodyI18nZhTw', array (
  'control_name' => 'photo[body_i18n_zh_tw]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photo[author_i18n_zh_tw]', __($labels['photo{author_i18n_zh_tw}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photo{author_i18n_zh_tw}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photo{author_i18n_zh_tw}')): ?>
    <?php echo form_error('photo{author_i18n_zh_tw}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photo, 'getAuthorI18nZhTw', array (
  'disabled' => false,
  'control_name' => 'photo[author_i18n_zh_tw]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>


<?php include_partial('edit_actions', array('photo' => $photo)) ?>

</form>

<ul class="sf_admin_actions">
      <li class="float-left"><?php if ($photo->getId()): ?>
<?php echo button_to(__('delete'), 'photo/delete?id='.$photo->getId(), array (
  'post' => true,
  'confirm' => __('Are you sure?'),
  'class' => 'sf_admin_action_delete',
)) ?><?php endif; ?>
</li>
  </ul>
