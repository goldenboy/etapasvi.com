<?php

/**
 * Timezone form base class.
 *
 * @method Timezone getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseTimezoneForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'    => new sfWidgetFormInputHidden(),
      'value' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'    => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'value' => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('timezone[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Timezone';
  }

  public function getI18nModelName()
  {
    return 'TimezoneI18n';
  }

  public function getI18nFormClass()
  {
    return 'TimezoneI18nForm';
  }

}
