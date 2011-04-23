<?php

/**
 * Phpb7d3xUsers form base class.
 *
 * @method Phpb7d3xUsers getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 */
abstract class BasePhpb7d3xUsersForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'          => new sfWidgetFormInputHidden(),
      'user_type'        => new sfWidgetFormInputText(),
      'group_id'         => new sfWidgetFormInputText(),
      'user_permissions' => new sfWidgetFormTextarea(),
      'user_perm_from'   => new sfWidgetFormInputText(),
      'user_ip'          => new sfWidgetFormInputText(),
      'user_regdate'     => new sfWidgetFormInputText(),
      'username'         => new sfWidgetFormInputText(),
      'username_clean'   => new sfWidgetFormInputText(),
      'user_password'    => new sfWidgetFormInputText(),
      'user_email'       => new sfWidgetFormInputText(),
      'user_email_hash'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'user_id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getUserId()), 'empty_value' => $this->getObject()->getUserId(), 'required' => false)),
      'user_type'        => new sfValidatorInteger(array('min' => -128, 'max' => 127, 'required' => false)),
      'group_id'         => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'user_permissions' => new sfValidatorString(array('required' => false)),
      'user_perm_from'   => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'user_ip'          => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'user_regdate'     => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'username'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'username_clean'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'user_password'    => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'user_email'       => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'user_email_hash'  => new sfValidatorInteger(array('min' => -9.2233720368548E+18, 'max' => 9223372036854775807, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('phpb7d3x_users[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Phpb7d3xUsers';
  }


}
