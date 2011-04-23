<?php

/**
 * AudioI18n form base class.
 *
 * @method AudioI18n getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseAudioI18nForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'updated_at_extra' => new sfWidgetFormDateTime(),
      'title'            => new sfWidgetFormTextarea(),
      'author'           => new sfWidgetFormTextarea(),
      'id'               => new sfWidgetFormInputHidden(),
      'culture'          => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'updated_at_extra' => new sfValidatorDateTime(array('required' => false)),
      'title'            => new sfValidatorString(array('required' => false)),
      'author'           => new sfValidatorString(array('required' => false)),
      'id'               => new sfValidatorPropelChoice(array('model' => 'Audio', 'column' => 'id', 'required' => false)),
      'culture'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getCulture()), 'empty_value' => $this->getObject()->getCulture(), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('audio_i18n[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AudioI18n';
  }


}
