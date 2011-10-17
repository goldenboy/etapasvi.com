<?php echo form_tag('news/save', array(
  'id'        => 'sf_admin_edit_form',
  'name'      => 'sf_admin_edit_form',
  'multipart' => true,
)) ?>

<?php echo object_input_hidden_tag($news, 'getId') ?>

<fieldset id="sf_fieldset_none" class="">

<div class="form-row">
  <?php echo label_for('news[show]', __($labels['news{show}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{show}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{show}')): ?>
    <?php echo form_error('news{show}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_checkbox_tag($news, 'getShow', array (
  'control_name' => 'news[show]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[order]', __($labels['news{order}']), 'class="required" ') ?>
  <div class="content<?php if ($sf_request->hasError('news{order}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{order}')): ?>
    <?php echo form_error('news{order}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getOrder', array (
  'size' => 7,
  'control_name' => 'news[order]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[date]', __($labels['news{date}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{date}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{date}')): ?>
    <?php echo form_error('news{date}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_date_tag($news, 'getDate', array (
  'rich' => true,
  'calendar_button_img' => '/sf_data_lsdfkr/sf_admin/images/date.png',
  'control_name' => 'news[date]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
<?php if (empty($url_to_login_page)): ?>
    <?php echo label_for('news[img]', __($labels['news{img}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{img}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{img}')): ?>
    <?php echo form_error('news{img}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_admin_input_file_tag($news, 'getImg', array (
  'control_name' => 'news[img]',
  'include_link' => 'news',
  'include_remove' => true,
)); echo $value ? $value : '&nbsp;' ?>

    <input type="checkbox" value="1" id="photo_watermark" name="news[watermark]"> watermark

    </div>
<?php else: ?>
    <a href="<?php echo html_entity_decode($url_to_login_page)?>" target="_blank">Authorize in Picasa</a>
<?php endif ?>
</div>

<div class="form-row">
  <?php echo label_for('news[img]', __($labels['news{img}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{img}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{img}')): ?>
    <?php echo form_error('news{img}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = get_partial('img', array('type' => 'edit', 'news' => $news)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[full_path]', __($labels['news{full_path}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{full_path}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{full_path}')): ?>
    <?php echo form_error('news{full_path}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getFullPath', array (
  'size' => 80,
  'control_name' => 'news[full_path]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[full_link]', __($labels['news{full_link}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{full_link}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{full_link}')): ?>
    <?php echo form_error('news{full_link}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = get_partial('full_link', array('type' => 'edit', 'news' => $news)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[thumb_path]', __($labels['news{thumb_path}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{thumb_path}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{thumb_path}')): ?>
    <?php echo form_error('news{thumb_path}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getThumbPath', array (
  'size' => 80,
  'control_name' => 'news[thumb_path]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[thumb_link]', __($labels['news{thumb_link}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{thumb_link}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{thumb_link}')): ?>
    <?php echo form_error('news{thumb_link}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = get_partial('thumb_link', array('type' => 'edit', 'news' => $news)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[type]', __($labels['news{type}']), 'class="required" ') ?>
  <div class="content<?php if ($sf_request->hasError('news{type}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{type}')): ?>
    <?php echo form_error('news{type}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_select_tag($news, 'getType', array (
  'related_class' => 'Newstypes',
  'control_name' => 'news[type]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[original]', __($labels['news{original}']), 'class="required" ') ?>
  <div class="content<?php if ($sf_request->hasError('news{original}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{original}')): ?>
    <?php echo form_error('news{original}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($news, 'getOriginal', array (
  'size' => '118x6',
  'control_name' => 'news[original]',
  'disabled' => false,
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_en" class="">
<h2><?php echo __('EN') ?></h2>


<div class="form-row">
  <?php echo label_for('news[title_i18n_en]', __($labels['news{title_i18n_en}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{title_i18n_en}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{title_i18n_en}')): ?>
    <?php echo form_error('news{title_i18n_en}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getTitleI18nEn', array (
  'disabled' => false,
  'control_name' => 'news[title_i18n_en]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[extradate_i18n_en]', __($labels['news{extradate_i18n_en}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{extradate_i18n_en}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{extradate_i18n_en}')): ?>
    <?php echo form_error('news{extradate_i18n_en}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getExtradateI18nEn', array (
  'disabled' => false,
  'control_name' => 'news[extradate_i18n_en]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[shortbody_i18n_en]', __($labels['news{shortbody_i18n_en}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{shortbody_i18n_en}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{shortbody_i18n_en}')): ?>
    <?php echo form_error('news{shortbody_i18n_en}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($news, 'getShortbodyI18nEn', array (
  'control_name' => 'news[shortbody_i18n_en]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[body_i18n_en]', __($labels['news{body_i18n_en}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{body_i18n_en}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{body_i18n_en}')): ?>
    <?php echo form_error('news{body_i18n_en}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($news, 'getBodyI18nEn', array (
  'control_name' => 'news[body_i18n_en]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[author_i18n_en]', __($labels['news{author_i18n_en}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{author_i18n_en}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{author_i18n_en}')): ?>
    <?php echo form_error('news{author_i18n_en}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getAuthorI18nEn', array (
  'disabled' => false,
  'control_name' => 'news[author_i18n_en]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[translated_by_i18n_en]', __($labels['news{translated_by_i18n_en}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{translated_by_i18n_en}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{translated_by_i18n_en}')): ?>
    <?php echo form_error('news{translated_by_i18n_en}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getTranslatedByI18nEn', array (
  'disabled' => false,
  'control_name' => 'news[translated_by_i18n_en]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[link_i18n_en]', __($labels['news{link_i18n_en}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{link_i18n_en}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{link_i18n_en}')): ?>
    <?php echo form_error('news{link_i18n_en}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getLinkI18nEn', array (
  'disabled' => false,
  'control_name' => 'news[link_i18n_en]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_ru" class="">
<h2><?php echo __('RU') ?></h2>


<div class="form-row">
  <?php echo label_for('news[title_i18n_ru]', __($labels['news{title_i18n_ru}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{title_i18n_ru}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{title_i18n_ru}')): ?>
    <?php echo form_error('news{title_i18n_ru}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getTitleI18nRu', array (
  'disabled' => false,
  'control_name' => 'news[title_i18n_ru]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[extradate_i18n_ru]', __($labels['news{extradate_i18n_ru}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{extradate_i18n_ru}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{extradate_i18n_ru}')): ?>
    <?php echo form_error('news{extradate_i18n_ru}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getExtradateI18nRu', array (
  'disabled' => false,
  'control_name' => 'news[extradate_i18n_ru]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[shortbody_i18n_ru]', __($labels['news{shortbody_i18n_ru}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{shortbody_i18n_ru}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{shortbody_i18n_ru}')): ?>
    <?php echo form_error('news{shortbody_i18n_ru}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($news, 'getShortbodyI18nRu', array (
  'control_name' => 'news[shortbody_i18n_ru]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[body_i18n_ru]', __($labels['news{body_i18n_ru}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{body_i18n_ru}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{body_i18n_ru}')): ?>
    <?php echo form_error('news{body_i18n_ru}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($news, 'getBodyI18nRu', array (
  'control_name' => 'news[body_i18n_ru]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[author_i18n_ru]', __($labels['news{author_i18n_ru}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{author_i18n_ru}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{author_i18n_ru}')): ?>
    <?php echo form_error('news{author_i18n_ru}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getAuthorI18nRu', array (
  'disabled' => false,
  'control_name' => 'news[author_i18n_ru]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[translated_by_i18n_ru]', __($labels['news{translated_by_i18n_ru}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{translated_by_i18n_ru}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{translated_by_i18n_ru}')): ?>
    <?php echo form_error('news{translated_by_i18n_ru}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getTranslatedByI18nRu', array (
  'disabled' => false,
  'control_name' => 'news[translated_by_i18n_ru]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[link_i18n_ru]', __($labels['news{link_i18n_ru}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{link_i18n_ru}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{link_i18n_ru}')): ?>
    <?php echo form_error('news{link_i18n_ru}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getLinkI18nRu', array (
  'disabled' => false,
  'control_name' => 'news[link_i18n_ru]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_cs" class="">
<h2><?php echo __('CS') ?></h2>


<div class="form-row">
  <?php echo label_for('news[title_i18n_cs]', __($labels['news{title_i18n_cs}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{title_i18n_cs}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{title_i18n_cs}')): ?>
    <?php echo form_error('news{title_i18n_cs}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getTitleI18nCs', array (
  'disabled' => false,
  'control_name' => 'news[title_i18n_cs]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[extradate_i18n_cs]', __($labels['news{extradate_i18n_cs}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{extradate_i18n_cs}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{extradate_i18n_cs}')): ?>
    <?php echo form_error('news{extradate_i18n_cs}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getExtradateI18nCs', array (
  'disabled' => false,
  'control_name' => 'news[extradate_i18n_cs]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[shortbody_i18n_cs]', __($labels['news{shortbody_i18n_cs}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{shortbody_i18n_cs}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{shortbody_i18n_cs}')): ?>
    <?php echo form_error('news{shortbody_i18n_cs}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($news, 'getShortbodyI18nCs', array (
  'control_name' => 'news[shortbody_i18n_cs]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[body_i18n_cs]', __($labels['news{body_i18n_cs}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{body_i18n_cs}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{body_i18n_cs}')): ?>
    <?php echo form_error('news{body_i18n_cs}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($news, 'getBodyI18nCs', array (
  'control_name' => 'news[body_i18n_cs]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[author_i18n_cs]', __($labels['news{author_i18n_cs}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{author_i18n_cs}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{author_i18n_cs}')): ?>
    <?php echo form_error('news{author_i18n_cs}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getAuthorI18nCs', array (
  'disabled' => false,
  'control_name' => 'news[author_i18n_cs]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[translated_by_i18n_cs]', __($labels['news{translated_by_i18n_cs}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{translated_by_i18n_cs}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{translated_by_i18n_cs}')): ?>
    <?php echo form_error('news{translated_by_i18n_cs}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getTranslatedByI18nCs', array (
  'disabled' => false,
  'control_name' => 'news[translated_by_i18n_cs]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[link_i18n_cs]', __($labels['news{link_i18n_cs}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{link_i18n_cs}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{link_i18n_cs}')): ?>
    <?php echo form_error('news{link_i18n_cs}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getLinkI18nCs', array (
  'disabled' => false,
  'control_name' => 'news[link_i18n_cs]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_hu" class="">
<h2><?php echo __('HU') ?></h2>


<div class="form-row">
  <?php echo label_for('news[title_i18n_hu]', __($labels['news{title_i18n_hu}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{title_i18n_hu}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{title_i18n_hu}')): ?>
    <?php echo form_error('news{title_i18n_hu}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getTitleI18nHu', array (
  'disabled' => false,
  'control_name' => 'news[title_i18n_hu]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[extradate_i18n_hu]', __($labels['news{extradate_i18n_hu}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{extradate_i18n_hu}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{extradate_i18n_hu}')): ?>
    <?php echo form_error('news{extradate_i18n_hu}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getExtradateI18nHu', array (
  'disabled' => false,
  'control_name' => 'news[extradate_i18n_hu]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[shortbody_i18n_hu]', __($labels['news{shortbody_i18n_hu}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{shortbody_i18n_hu}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{shortbody_i18n_hu}')): ?>
    <?php echo form_error('news{shortbody_i18n_hu}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($news, 'getShortbodyI18nHu', array (
  'control_name' => 'news[shortbody_i18n_hu]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[body_i18n_hu]', __($labels['news{body_i18n_hu}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{body_i18n_hu}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{body_i18n_hu}')): ?>
    <?php echo form_error('news{body_i18n_hu}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($news, 'getBodyI18nHu', array (
  'control_name' => 'news[body_i18n_hu]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[author_i18n_hu]', __($labels['news{author_i18n_hu}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{author_i18n_hu}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{author_i18n_hu}')): ?>
    <?php echo form_error('news{author_i18n_hu}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getAuthorI18nHu', array (
  'disabled' => false,
  'control_name' => 'news[author_i18n_hu]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[translated_by_i18n_hu]', __($labels['news{translated_by_i18n_hu}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{translated_by_i18n_hu}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{translated_by_i18n_hu}')): ?>
    <?php echo form_error('news{translated_by_i18n_hu}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getTranslatedByI18nHu', array (
  'disabled' => false,
  'control_name' => 'news[translated_by_i18n_hu]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[link_i18n_hu]', __($labels['news{link_i18n_hu}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{link_i18n_hu}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{link_i18n_hu}')): ?>
    <?php echo form_error('news{link_i18n_hu}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getLinkI18nHu', array (
  'disabled' => false,
  'control_name' => 'news[link_i18n_hu]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_pl" class="">
<h2><?php echo __('PL') ?></h2>


<div class="form-row">
  <?php echo label_for('news[title_i18n_pl]', __($labels['news{title_i18n_pl}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{title_i18n_pl}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{title_i18n_pl}')): ?>
    <?php echo form_error('news{title_i18n_pl}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getTitleI18nPl', array (
  'disabled' => false,
  'control_name' => 'news[title_i18n_pl]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[extradate_i18n_pl]', __($labels['news{extradate_i18n_pl}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{extradate_i18n_pl}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{extradate_i18n_pl}')): ?>
    <?php echo form_error('news{extradate_i18n_pl}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getExtradateI18nPl', array (
  'disabled' => false,
  'control_name' => 'news[extradate_i18n_pl]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[shortbody_i18n_pl]', __($labels['news{shortbody_i18n_pl}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{shortbody_i18n_pl}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{shortbody_i18n_pl}')): ?>
    <?php echo form_error('news{shortbody_i18n_pl}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($news, 'getShortbodyI18nPl', array (
  'control_name' => 'news[shortbody_i18n_pl]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[body_i18n_pl]', __($labels['news{body_i18n_pl}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{body_i18n_pl}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{body_i18n_pl}')): ?>
    <?php echo form_error('news{body_i18n_pl}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($news, 'getBodyI18nPl', array (
  'control_name' => 'news[body_i18n_pl]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[author_i18n_pl]', __($labels['news{author_i18n_pl}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{author_i18n_pl}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{author_i18n_pl}')): ?>
    <?php echo form_error('news{author_i18n_pl}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getAuthorI18nPl', array (
  'disabled' => false,
  'control_name' => 'news[author_i18n_pl]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[translated_by_i18n_pl]', __($labels['news{translated_by_i18n_pl}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{translated_by_i18n_pl}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{translated_by_i18n_pl}')): ?>
    <?php echo form_error('news{translated_by_i18n_pl}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getTranslatedByI18nPl', array (
  'disabled' => false,
  'control_name' => 'news[translated_by_i18n_pl]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[link_i18n_pl]', __($labels['news{link_i18n_pl}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{link_i18n_pl}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{link_i18n_pl}')): ?>
    <?php echo form_error('news{link_i18n_pl}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getLinkI18nPl', array (
  'disabled' => false,
  'control_name' => 'news[link_i18n_pl]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_fr" class="">
<h2><?php echo __('FR') ?></h2>


<div class="form-row">
  <?php echo label_for('news[title_i18n_fr]', __($labels['news{title_i18n_fr}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{title_i18n_fr}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{title_i18n_fr}')): ?>
    <?php echo form_error('news{title_i18n_fr}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getTitleI18nFr', array (
  'disabled' => false,
  'control_name' => 'news[title_i18n_fr]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[extradate_i18n_fr]', __($labels['news{extradate_i18n_fr}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{extradate_i18n_fr}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{extradate_i18n_fr}')): ?>
    <?php echo form_error('news{extradate_i18n_fr}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getExtradateI18nFr', array (
  'disabled' => false,
  'control_name' => 'news[extradate_i18n_fr]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[shortbody_i18n_fr]', __($labels['news{shortbody_i18n_fr}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{shortbody_i18n_fr}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{shortbody_i18n_fr}')): ?>
    <?php echo form_error('news{shortbody_i18n_fr}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($news, 'getShortbodyI18nFr', array (
  'control_name' => 'news[shortbody_i18n_fr]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[body_i18n_fr]', __($labels['news{body_i18n_fr}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{body_i18n_fr}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{body_i18n_fr}')): ?>
    <?php echo form_error('news{body_i18n_fr}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($news, 'getBodyI18nFr', array (
  'control_name' => 'news[body_i18n_fr]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[author_i18n_fr]', __($labels['news{author_i18n_fr}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{author_i18n_fr}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{author_i18n_fr}')): ?>
    <?php echo form_error('news{author_i18n_fr}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getAuthorI18nFr', array (
  'disabled' => false,
  'control_name' => 'news[author_i18n_fr]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[translated_by_i18n_fr]', __($labels['news{translated_by_i18n_fr}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{translated_by_i18n_fr}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{translated_by_i18n_fr}')): ?>
    <?php echo form_error('news{translated_by_i18n_fr}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getTranslatedByI18nFr', array (
  'disabled' => false,
  'control_name' => 'news[translated_by_i18n_fr]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[link_i18n_fr]', __($labels['news{link_i18n_fr}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{link_i18n_fr}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{link_i18n_fr}')): ?>
    <?php echo form_error('news{link_i18n_fr}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getLinkI18nFr', array (
  'disabled' => false,
  'control_name' => 'news[link_i18n_fr]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_zh_cn" class="">
<h2><?php echo __('zh_CN') ?></h2>


<div class="form-row">
  <?php echo label_for('news[title_i18n_zh_cn]', __($labels['news{title_i18n_zh_cn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{title_i18n_zh_cn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{title_i18n_zh_cn}')): ?>
    <?php echo form_error('news{title_i18n_zh_cn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getTitleI18nZhCN', array (
  'disabled' => false,
  'control_name' => 'news[title_i18n_zh_cn]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[extradate_i18n_zh_cn]', __($labels['news{extradate_i18n_zh_cn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{extradate_i18n_zh_cn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{extradate_i18n_zh_cn}')): ?>
    <?php echo form_error('news{extradate_i18n_zh_cn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getExtradateI18nZhCN', array (
  'disabled' => false,
  'control_name' => 'news[extradate_i18n_zh_cn]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[shortbody_i18n_zh_cn]', __($labels['news{shortbody_i18n_zh_cn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{shortbody_i18n_zh_cn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{shortbody_i18n_zh_cn}')): ?>
    <?php echo form_error('news{shortbody_i18n_zh_cn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($news, 'getShortbodyI18nZhCN', array (
  'control_name' => 'news[shortbody_i18n_zh_cn]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[body_i18n_zh_cn]', __($labels['news{body_i18n_zh_cn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{body_i18n_zh_cn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{body_i18n_zh_cn}')): ?>
    <?php echo form_error('news{body_i18n_zh_cn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($news, 'getBodyI18nZhCN', array (
  'control_name' => 'news[body_i18n_zh_cn]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[author_i18n_zh_cn]', __($labels['news{author_i18n_zh_cn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{author_i18n_zh_cn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{author_i18n_zh_cn}')): ?>
    <?php echo form_error('news{author_i18n_zh_cn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getAuthorI18nZhCN', array (
  'disabled' => false,
  'control_name' => 'news[author_i18n_zh_cn]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[translated_by_i18n_zh_cn]', __($labels['news{translated_by_i18n_zh_cn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{translated_by_i18n_zh_cn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{translated_by_i18n_zh_cn}')): ?>
    <?php echo form_error('news{translated_by_i18n_zh_cn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getTranslatedByI18nZhCN', array (
  'disabled' => false,
  'control_name' => 'news[translated_by_i18n_zh_cn]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[link_i18n_zh_cn]', __($labels['news{link_i18n_zh_cn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{link_i18n_zh_cn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{link_i18n_zh_cn}')): ?>
    <?php echo form_error('news{link_i18n_zh_cn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getLinkI18nZhCN', array (
  'disabled' => false,
  'control_name' => 'news[link_i18n_zh_cn]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_vi" class="">
<h2><?php echo __('vi') ?></h2>


<div class="form-row">
  <?php echo label_for('news[title_i18n_vi]', __($labels['news{title_i18n_vi}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{title_i18n_vi}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{title_i18n_vi}')): ?>
    <?php echo form_error('news{title_i18n_vi}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getTitleI18nVi', array (
  'disabled' => false,
  'control_name' => 'news[title_i18n_vi]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[extradate_i18n_vi]', __($labels['news{extradate_i18n_vi}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{extradate_i18n_vi}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{extradate_i18n_vi}')): ?>
    <?php echo form_error('news{extradate_i18n_vi}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getExtradateI18nVi', array (
  'disabled' => false,
  'control_name' => 'news[extradate_i18n_vi]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[shortbody_i18n_vi]', __($labels['news{shortbody_i18n_vi}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{shortbody_i18n_vi}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{shortbody_i18n_vi}')): ?>
    <?php echo form_error('news{shortbody_i18n_vi}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($news, 'getShortbodyI18nVi', array (
  'control_name' => 'news[shortbody_i18n_vi]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[body_i18n_vi]', __($labels['news{body_i18n_vi}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{body_i18n_vi}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{body_i18n_vi}')): ?>
    <?php echo form_error('news{body_i18n_vi}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($news, 'getBodyI18nVi', array (
  'control_name' => 'news[body_i18n_vi]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[author_i18n_vi]', __($labels['news{author_i18n_vi}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{author_i18n_vi}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{author_i18n_vi}')): ?>
    <?php echo form_error('news{author_i18n_vi}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getAuthorI18nVi', array (
  'disabled' => false,
  'control_name' => 'news[author_i18n_vi]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[translated_by_i18n_vi]', __($labels['news{translated_by_i18n_vi}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{translated_by_i18n_vi}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{translated_by_i18n_vi}')): ?>
    <?php echo form_error('news{translated_by_i18n_vi}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getTranslatedByI18nVi', array (
  'disabled' => false,
  'control_name' => 'news[translated_by_i18n_vi]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[link_i18n_vi]', __($labels['news{link_i18n_vi}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{link_i18n_vi}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{link_i18n_vi}')): ?>
    <?php echo form_error('news{link_i18n_vi}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getLinkI18nVi', array (
  'disabled' => false,
  'control_name' => 'news[link_i18n_vi]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_de" class="">
<h2><?php echo __('de') ?></h2>


<div class="form-row">
  <?php echo label_for('news[title_i18n_de]', __($labels['news{title_i18n_de}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{title_i18n_de}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{title_i18n_de}')): ?>
    <?php echo form_error('news{title_i18n_de}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getTitleI18nDe', array (
  'disabled' => false,
  'control_name' => 'news[title_i18n_de]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[extradate_i18n_de]', __($labels['news{extradate_i18n_de}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{extradate_i18n_de}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{extradate_i18n_de}')): ?>
    <?php echo form_error('news{extradate_i18n_de}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getExtradateI18nDe', array (
  'disabled' => false,
  'control_name' => 'news[extradate_i18n_de]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[shortbody_i18n_de]', __($labels['news{shortbody_i18n_de}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{shortbody_i18n_de}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{shortbody_i18n_de}')): ?>
    <?php echo form_error('news{shortbody_i18n_de}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($news, 'getShortbodyI18nDe', array (
  'control_name' => 'news[shortbody_i18n_de]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[body_i18n_de]', __($labels['news{body_i18n_de}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{body_i18n_de}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{body_i18n_de}')): ?>
    <?php echo form_error('news{body_i18n_de}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($news, 'getBodyI18nDe', array (
  'control_name' => 'news[body_i18n_de]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[author_i18n_de]', __($labels['news{author_i18n_de}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{author_i18n_de}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{author_i18n_de}')): ?>
    <?php echo form_error('news{author_i18n_de}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getAuthorI18nDe', array (
  'disabled' => false,
  'control_name' => 'news[author_i18n_de]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[translated_by_i18n_de]', __($labels['news{translated_by_i18n_de}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{translated_by_i18n_de}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{translated_by_i18n_de}')): ?>
    <?php echo form_error('news{translated_by_i18n_de}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getTranslatedByI18nDe', array (
  'disabled' => false,
  'control_name' => 'news[translated_by_i18n_de]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[link_i18n_de]', __($labels['news{link_i18n_de}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{link_i18n_de}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{link_i18n_de}')): ?>
    <?php echo form_error('news{link_i18n_de}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getLinkI18nDe', array (
  'disabled' => false,
  'control_name' => 'news[link_i18n_de]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_it" class="">
<h2><?php echo __('it') ?></h2>


<div class="form-row">
  <?php echo label_for('news[title_i18n_it]', __($labels['news{title_i18n_it}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{title_i18n_it}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{title_i18n_it}')): ?>
    <?php echo form_error('news{title_i18n_it}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getTitleI18nIt', array (
  'disabled' => false,
  'control_name' => 'news[title_i18n_it]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[extradate_i18n_it]', __($labels['news{extradate_i18n_it}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{extradate_i18n_it}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{extradate_i18n_it}')): ?>
    <?php echo form_error('news{extradate_i18n_it}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getExtradateI18nIt', array (
  'disabled' => false,
  'control_name' => 'news[extradate_i18n_it]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[shortbody_i18n_it]', __($labels['news{shortbody_i18n_it}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{shortbody_i18n_it}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{shortbody_i18n_it}')): ?>
    <?php echo form_error('news{shortbody_i18n_it}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($news, 'getShortbodyI18nIt', array (
  'control_name' => 'news[shortbody_i18n_it]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[body_i18n_it]', __($labels['news{body_i18n_it}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{body_i18n_it}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{body_i18n_it}')): ?>
    <?php echo form_error('news{body_i18n_it}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($news, 'getBodyI18nIt', array (
  'control_name' => 'news[body_i18n_it]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[author_i18n_it]', __($labels['news{author_i18n_it}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{author_i18n_it}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{author_i18n_it}')): ?>
    <?php echo form_error('news{author_i18n_it}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getAuthorI18nIt', array (
  'disabled' => false,
  'control_name' => 'news[author_i18n_it]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[translated_by_i18n_it]', __($labels['news{translated_by_i18n_it}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{translated_by_i18n_it}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{translated_by_i18n_it}')): ?>
    <?php echo form_error('news{translated_by_i18n_it}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getTranslatedByI18nIt', array (
  'disabled' => false,
  'control_name' => 'news[translated_by_i18n_it]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[link_i18n_it]', __($labels['news{link_i18n_it}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{link_i18n_it}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{link_i18n_it}')): ?>
    <?php echo form_error('news{link_i18n_it}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getLinkI18nIt', array (
  'disabled' => false,
  'control_name' => 'news[link_i18n_it]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_jp" class="">
<h2><?php echo __('jp') ?></h2>


<div class="form-row">
  <?php echo label_for('news[title_i18n_ja]', __($labels['news{title_i18n_ja}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{title_i18n_ja}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{title_i18n_ja}')): ?>
    <?php echo form_error('news{title_i18n_ja}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getTitleI18nJa', array (
  'disabled' => false,
  'control_name' => 'news[title_i18n_ja]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[extradate_i18n_ja]', __($labels['news{extradate_i18n_ja}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{extradate_i18n_ja}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{extradate_i18n_ja}')): ?>
    <?php echo form_error('news{extradate_i18n_ja}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getExtradateI18nJa', array (
  'disabled' => false,
  'control_name' => 'news[extradate_i18n_ja]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[shortbody_i18n_ja]', __($labels['news{shortbody_i18n_ja}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{shortbody_i18n_ja}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{shortbody_i18n_ja}')): ?>
    <?php echo form_error('news{shortbody_i18n_ja}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($news, 'getShortbodyI18nJa', array (
  'control_name' => 'news[shortbody_i18n_ja]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[body_i18n_ja]', __($labels['news{body_i18n_ja}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{body_i18n_ja}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{body_i18n_ja}')): ?>
    <?php echo form_error('news{body_i18n_ja}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($news, 'getBodyI18nJa', array (
  'control_name' => 'news[body_i18n_ja]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[author_i18n_ja]', __($labels['news{author_i18n_ja}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{author_i18n_ja}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{author_i18n_ja}')): ?>
    <?php echo form_error('news{author_i18n_ja}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getAuthorI18nJa', array (
  'disabled' => false,
  'control_name' => 'news[author_i18n_ja]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[translated_by_i18n_ja]', __($labels['news{translated_by_i18n_ja}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{translated_by_i18n_ja}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{translated_by_i18n_ja}')): ?>
    <?php echo form_error('news{translated_by_i18n_ja}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getTranslatedByI18nJa', array (
  'disabled' => false,
  'control_name' => 'news[translated_by_i18n_ja]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[link_i18n_ja]', __($labels['news{link_i18n_ja}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{link_i18n_ja}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{link_i18n_ja}')): ?>
    <?php echo form_error('news{link_i18n_ja}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getLinkI18nJa', array (
  'disabled' => false,
  'control_name' => 'news[link_i18n_ja]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>

<fieldset id="sf_fieldset_es" class="">
<h2><?php echo __('ES') ?></h2>


<div class="form-row">
  <?php echo label_for('news[title_i18n_es]', __($labels['news{title_i18n_es}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{title_i18n_es}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{title_i18n_es}')): ?>
    <?php echo form_error('news{title_i18n_es}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getTitleI18nEs', array (
  'disabled' => false,
  'control_name' => 'news[title_i18n_es]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[extradate_i18n_es]', __($labels['news{extradate_i18n_es}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{extradate_i18n_es}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{extradate_i18n_es}')): ?>
    <?php echo form_error('news{extradate_i18n_es}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getExtradateI18nEs', array (
  'disabled' => false,
  'control_name' => 'news[extradate_i18n_es]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[shortbody_i18n_es]', __($labels['news{shortbody_i18n_es}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{shortbody_i18n_es}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{shortbody_i18n_es}')): ?>
    <?php echo form_error('news{shortbody_i18n_es}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($news, 'getShortbodyI18nEs', array (
  'control_name' => 'news[shortbody_i18n_es]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[body_i18n_es]', __($labels['news{body_i18n_es}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{body_i18n_es}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{body_i18n_es}')): ?>
    <?php echo form_error('news{body_i18n_es}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($news, 'getBodyI18nEs', array (
  'control_name' => 'news[body_i18n_es]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[author_i18n_es]', __($labels['news{author_i18n_es}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{author_i18n_es}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{author_i18n_es}')): ?>
    <?php echo form_error('news{author_i18n_es}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getAuthorI18nEs', array (
  'disabled' => false,
  'control_name' => 'news[author_i18n_es]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[translated_by_i18n_es]', __($labels['news{translated_by_i18n_es}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{translated_by_i18n_es}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{translated_by_i18n_es}')): ?>
    <?php echo form_error('news{translated_by_i18n_es}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getTranslatedByI18nEs', array (
  'disabled' => false,
  'control_name' => 'news[translated_by_i18n_es]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[link_i18n_es]', __($labels['news{link_i18n_es}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{link_i18n_es}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{link_i18n_es}')): ?>
    <?php echo form_error('news{link_i18n_es}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getLinkI18nEs', array (
  'disabled' => false,
  'control_name' => 'news[link_i18n_es]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<fieldset id="sf_fieldset_et" class="">
<h2><?php echo __('ET') ?></h2>


<div class="form-row">
  <?php echo label_for('news[title_i18n_et]', __($labels['news{title_i18n_et}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{title_i18n_et}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{title_i18n_et}')): ?>
    <?php echo form_error('news{title_i18n_et}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getTitleI18nEt', array (
  'disabled' => false,
  'control_name' => 'news[title_i18n_et]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[extradate_i18n_et]', __($labels['news{extradate_i18n_et}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{extradate_i18n_et}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{extradate_i18n_et}')): ?>
    <?php echo form_error('news{extradate_i18n_et}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getExtradateI18nEt', array (
  'disabled' => false,
  'control_name' => 'news[extradate_i18n_et]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[shortbody_i18n_et]', __($labels['news{shortbody_i18n_et}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{shortbody_i18n_et}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{shortbody_i18n_et}')): ?>
    <?php echo form_error('news{shortbody_i18n_et}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($news, 'getShortbodyI18nEt', array (
  'control_name' => 'news[shortbody_i18n_et]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[body_i18n_et]', __($labels['news{body_i18n_et}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{body_i18n_et}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{body_i18n_et}')): ?>
    <?php echo form_error('news{body_i18n_et}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($news, 'getBodyI18nEt', array (
  'control_name' => 'news[body_i18n_et]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[author_i18n_et]', __($labels['news{author_i18n_et}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{author_i18n_et}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{author_i18n_et}')): ?>
    <?php echo form_error('news{author_i18n_et}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getAuthorI18nEt', array (
  'disabled' => false,
  'control_name' => 'news[author_i18n_et]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[translated_by_i18n_et]', __($labels['news{translated_by_i18n_et}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{translated_by_i18n_et}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{translated_by_i18n_et}')): ?>
    <?php echo form_error('news{translated_by_i18n_et}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getTranslatedByI18nEt', array (
  'disabled' => false,
  'control_name' => 'news[translated_by_i18n_et]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[link_i18n_et]', __($labels['news{link_i18n_et}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{link_i18n_et}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{link_i18n_et}')): ?>
    <?php echo form_error('news{link_i18n_et}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getLinkI18nEt', array (
  'disabled' => false,
  'control_name' => 'news[link_i18n_et]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_ne" class="">
<h2><?php echo __('NE') ?></h2>


<div class="form-row">
  <?php echo label_for('news[title_i18n_ne]', __($labels['news{title_i18n_ne}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{title_i18n_ne}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{title_i18n_ne}')): ?>
    <?php echo form_error('news{title_i18n_ne}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getTitleI18nNe', array (
  'disabled' => false,
  'control_name' => 'news[title_i18n_ne]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[extradate_i18n_ne]', __($labels['news{extradate_i18n_ne}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{extradate_i18n_ne}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{extradate_i18n_ne}')): ?>
    <?php echo form_error('news{extradate_i18n_ne}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getExtradateI18nNe', array (
  'disabled' => false,
  'control_name' => 'news[extradate_i18n_ne]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[shortbody_i18n_ne]', __($labels['news{shortbody_i18n_ne}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{shortbody_i18n_ne}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{shortbody_i18n_ne}')): ?>
    <?php echo form_error('news{shortbody_i18n_ne}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($news, 'getShortbodyI18nNe', array (
  'control_name' => 'news[shortbody_i18n_ne]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[body_i18n_ne]', __($labels['news{body_i18n_ne}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{body_i18n_ne}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{body_i18n_ne}')): ?>
    <?php echo form_error('news{body_i18n_ne}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($news, 'getBodyI18nNe', array (
  'control_name' => 'news[body_i18n_ne]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[author_i18n_ne]', __($labels['news{author_i18n_ne}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{author_i18n_ne}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{author_i18n_ne}')): ?>
    <?php echo form_error('news{author_i18n_ne}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getAuthorI18nNe', array (
  'disabled' => false,
  'control_name' => 'news[author_i18n_ne]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[translated_by_i18n_ne]', __($labels['news{translated_by_i18n_ne}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{translated_by_i18n_ne}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{translated_by_i18n_ne}')): ?>
    <?php echo form_error('news{translated_by_i18n_ne}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getTranslatedByI18nNe', array (
  'disabled' => false,
  'control_name' => 'news[translated_by_i18n_ne]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('news[link_i18n_ne]', __($labels['news{link_i18n_ne}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('news{link_i18n_ne}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('news{link_i18n_ne}')): ?>
    <?php echo form_error('news{link_i18n_ne}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($news, 'getLinkI18nNe', array (
  'disabled' => false,
  'control_name' => 'news[link_i18n_ne]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>

<?php include_partial('edit_actions', array('news' => $news)) ?>

</form>

<ul class="sf_admin_actions">
      <li class="float-left"><?php if ($news->getId()): ?>
<?php echo button_to(__('delete'), 'news/delete?id='.$news->getId(), array (
  'post' => true,
  'confirm' => __('Are you sure?'),
  'class' => 'sf_admin_action_delete',
)) ?><?php endif; ?>
</li>
  </ul>
