<?php echo form_tag('user/save', array(
  'id'        => 'sf_admin_edit_form',
  'name'      => 'sf_admin_edit_form',
  'multipart' => true,
)) ?>

<?php echo object_input_hidden_tag($user, 'getId') ?>

<fieldset id="sf_fieldset_none" class="">

<div class="form-row">
  <?php echo label_for('user[created_at]', __($labels['user{created_at}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('user{created_at}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('user{created_at}')): ?>
    <?php echo form_error('user{created_at}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_date_tag($user, 'getCreatedAt', array (
  'rich' => true,
  'withtime' => true,
  'calendar_button_img' => '/sf_data_lsdfkr/sf_admin/images/date.png',
  'control_name' => 'user[created_at]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('user[timezone_id]', __($labels['user{timezone_id}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('user{timezone_id}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('user{timezone_id}')): ?>
    <?php echo form_error('user{timezone_id}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_select_tag($user, 'getTimezoneId', array (
  'related_class' => 'Timezone',
  'control_name' => 'user[timezone_id]',
  'include_blank' => true,
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('user[name]', __($labels['user{name}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('user{name}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('user{name}')): ?>
    <?php echo form_error('user{name}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($user, 'getName', array (
  'size' => 80,
  'control_name' => 'user[name]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('user[email]', __($labels['user{email}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('user{email}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('user{email}')): ?>
    <?php echo form_error('user{email}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($user, 'getEmail', array (
  'size' => 80,
  'control_name' => 'user[email]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('user[password]', __($labels['user{password}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('user{password}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('user{password}')): ?>
    <?php echo form_error('user{password}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($user, 'getPassword', array (
  'size' => 80,
  'control_name' => 'user[password]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
	<label for="user_update_password">Update Password:</lable>
    <div class="content">
		<?php echo checkbox_tag('user[update_password]', 'user_update_password', false) ?>
	</div>
</div>

<div class="form-row">
  <?php echo label_for('user[profile]', __($labels['user{profile}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('user{profile}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('user{profile}')): ?>
    <?php echo form_error('user{profile}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($user, 'getProfile', array (
  'size' => 80,
  'control_name' => 'user[profile]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('user[is_active]', __($labels['user{is_active}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('user{is_active}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('user{is_active}')): ?>
    <?php echo form_error('user{is_active}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_checkbox_tag($user, 'getIsActive', array (
  'control_name' => 'user[is_active]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('user[remember_me_code]', __($labels['user{remember_me_code}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('user{remember_me_code}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('user{remember_me_code}')): ?>
    <?php echo form_error('user{remember_me_code}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($user, 'getRememberMeCode', array (
  'size' => 80,
  'control_name' => 'user[remember_me_code]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('user[ip]', __($labels['user{ip}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('user{ip}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('user{ip}')): ?>
    <?php echo form_error('user{ip}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($user, 'getIp', array (
  'size' => 20,
  'control_name' => 'user[ip]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('user[last_login]', __($labels['user{last_login}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('user{last_login}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('user{last_login}')): ?>
    <?php echo form_error('user{last_login}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_date_tag($user, 'getLastLogin', array (
  'rich' => true,
  'withtime' => true,
  'calendar_button_img' => '/sf_data_lsdfkr/sf_admin/images/date.png',
  'control_name' => 'user[last_login]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('user[lang]', __($labels['user{lang}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('user{lang}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('user{lang}')): ?>
    <?php echo form_error('user{lang}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($user, 'getLang', array (
  'size' => 20,
  'control_name' => 'user[lang]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('user[phpbb_id]', __($labels['user{phpbb_id}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('user{phpbb_id}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('user{phpbb_id}')): ?>
    <?php echo form_error('user{phpbb_id}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($user, 'getPhpbbId', array (
  'size' => 7,
  'control_name' => 'user[phpbb_id]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('user[remind_code]', __($labels['user{remind_code}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('user{remind_code}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('user{remind_code}')): ?>
    <?php echo form_error('user{remind_code}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($user, 'getRemindCode', array (
  'size' => 32,
  'control_name' => 'user[remind_code]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('user[subscribe_news]', __($labels['user{subscribe_news}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('user{subscribe_news}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('user{subscribe_news}')): ?>
    <?php echo form_error('user{subscribe_news}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_checkbox_tag($user, 'getSubscribeNews', array (
  'control_name' => 'user[subscribe_news]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('user[subscribe_photo]', __($labels['user{subscribe_photo}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('user{subscribe_photo}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('user{subscribe_photo}')): ?>
    <?php echo form_error('user{subscribe_photo}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_checkbox_tag($user, 'getSubscribePhoto', array (
  'control_name' => 'user[subscribe_photo]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('user[subscribe_video]', __($labels['user{subscribe_video}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('user{subscribe_video}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('user{subscribe_video}')): ?>
    <?php echo form_error('user{subscribe_video}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_checkbox_tag($user, 'getSubscribeVideo', array (
  'control_name' => 'user[subscribe_video]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('user[notes]', __($labels['user{notes}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('user{notes}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('user{notes}')): ?>
    <?php echo form_error('user{notes}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($user, 'getNotes', array (
  'size' => '30x3',
  'control_name' => 'user[notes]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>

<?php include_partial('edit_actions', array('user' => $user)) ?>

</form>

<ul class="sf_admin_actions">
      <li class="float-left"><?php if ($user->getId()): ?>
<?php echo button_to(__('delete'), 'user/delete?id='.$user->getId(), array (
  'post' => true,
  'confirm' => __('Are you sure?'),
  'class' => 'sf_admin_action_delete',
)) ?><?php endif; ?>
</li>
  </ul>
