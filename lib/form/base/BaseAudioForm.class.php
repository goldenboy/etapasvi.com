<?php

/**
 * Audio form base class.
 *
 * @method Audio getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseAudioForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
      'show'       => new sfWidgetFormInputCheckbox(),
      'file'       => new sfWidgetFormInputText(),
      'remote'     => new sfWidgetFormInputText(),
      'size'       => new sfWidgetFormInputText(),
      'duration'   => new sfWidgetFormInputText(),
      'order'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
      'updated_at' => new sfValidatorDateTime(array('required' => false)),
      'show'       => new sfValidatorBoolean(array('required' => false)),
      'file'       => new sfValidatorString(array('max_length' => 255)),
      'remote'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'size'       => new sfValidatorNumber(array('required' => false)),
      'duration'   => new sfValidatorNumber(array('required' => false)),
      'order'      => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
    ));

    $this->widgetSchema->setNameFormat('audio[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Audio';
  }

  public function getI18nModelName()
  {
    return 'AudioI18n';
  }

  public function getI18nFormClass()
  {
    return 'AudioI18nForm';
  }

}
