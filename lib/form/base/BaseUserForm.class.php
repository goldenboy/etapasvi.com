<?php

/**
 * User form base class.
 *
 * @method User getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseUserForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'created_at'       => new sfWidgetFormDateTime(),
      'timezone_id'      => new sfWidgetFormPropelChoice(array('model' => 'Timezone', 'add_empty' => true)),
      'name'             => new sfWidgetFormInputText(),
      'email'            => new sfWidgetFormInputText(),
      'password'         => new sfWidgetFormInputText(),
      'profile'          => new sfWidgetFormInputText(),
      'is_active'        => new sfWidgetFormInputCheckbox(),
      'remember_me_code' => new sfWidgetFormInputText(),
      'ip'               => new sfWidgetFormInputText(),
      'last_login'       => new sfWidgetFormDateTime(),
      'lang'             => new sfWidgetFormInputText(),
      'phpbb_id'         => new sfWidgetFormInputText(),
      'remind_code'      => new sfWidgetFormInputText(),
      'subscribe_news'   => new sfWidgetFormInputCheckbox(),
      'subscribe_photo'  => new sfWidgetFormInputCheckbox(),
      'subscribe_video'  => new sfWidgetFormInputCheckbox(),
      'notes'            => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'created_at'       => new sfValidatorDateTime(array('required' => false)),
      'timezone_id'      => new sfValidatorPropelChoice(array('model' => 'Timezone', 'column' => 'id', 'required' => false)),
      'name'             => new sfValidatorString(array('max_length' => 255)),
      'email'            => new sfValidatorString(array('max_length' => 255)),
      'password'         => new sfValidatorString(array('max_length' => 255)),
      'profile'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_active'        => new sfValidatorBoolean(array('required' => false)),
      'remember_me_code' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ip'               => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'last_login'       => new sfValidatorDateTime(array('required' => false)),
      'lang'             => new sfValidatorString(array('max_length' => 7, 'required' => false)),
      'phpbb_id'         => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'remind_code'      => new sfValidatorString(array('max_length' => 32, 'required' => false)),
      'subscribe_news'   => new sfValidatorBoolean(array('required' => false)),
      'subscribe_photo'  => new sfValidatorBoolean(array('required' => false)),
      'subscribe_video'  => new sfValidatorBoolean(array('required' => false)),
      'notes'            => new sfValidatorString(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorPropelUnique(array('model' => 'User', 'column' => array('name'))),
        new sfValidatorPropelUnique(array('model' => 'User', 'column' => array('email'))),
      ))
    );

    $this->widgetSchema->setNameFormat('user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'User';
  }


}
