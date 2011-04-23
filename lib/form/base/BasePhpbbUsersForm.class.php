<?php

/**
 * PhpbbUsers form base class.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BasePhpbbUsersForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'          => new sfWidgetFormInputHidden(),
      'user_type'        => new sfWidgetFormInput(),
      'group_id'         => new sfWidgetFormInput(),
      'user_permissions' => new sfWidgetFormTextarea(),
      'user_perm_from'   => new sfWidgetFormInput(),
      'user_ip'          => new sfWidgetFormInput(),
      'user_regdate'     => new sfWidgetFormInput(),
      'username'         => new sfWidgetFormInput(),
      'username_clean'   => new sfWidgetFormInput(),
      'user_password'    => new sfWidgetFormInput(),
      'user_email'       => new sfWidgetFormInput(),
      'user_email_hash'  => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'user_id'          => new sfValidatorPropelChoice(array('model' => 'PhpbbUsers', 'column' => 'user_id', 'required' => false)),
      'user_type'        => new sfValidatorInteger(array('required' => false)),
      'group_id'         => new sfValidatorInteger(array('required' => false)),
      'user_permissions' => new sfValidatorString(array('required' => false)),
      'user_perm_from'   => new sfValidatorInteger(array('required' => false)),
      'user_ip'          => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'user_regdate'     => new sfValidatorInteger(array('required' => false)),
      'username'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'username_clean'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'user_password'    => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'user_email'       => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'user_email_hash'  => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('phpbb_users[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PhpbbUsers';
  }


}
