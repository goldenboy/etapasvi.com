<?php

/**
 * Phpb7d3xSessionsKeys form base class.
 *
 * @method Phpb7d3xSessionsKeys getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 */
abstract class BasePhpb7d3xSessionsKeysForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'key_id'     => new sfWidgetFormInputHidden(),
      'user_id'    => new sfWidgetFormInputHidden(),
      'last_ip'    => new sfWidgetFormInputText(),
      'last_login' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'key_id'     => new sfValidatorChoice(array('choices' => array($this->getObject()->getKeyId()), 'empty_value' => $this->getObject()->getKeyId(), 'required' => false)),
      'user_id'    => new sfValidatorChoice(array('choices' => array($this->getObject()->getUserId()), 'empty_value' => $this->getObject()->getUserId(), 'required' => false)),
      'last_ip'    => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'last_login' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('phpb7d3x_sessions_keys[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Phpb7d3xSessionsKeys';
  }


}
