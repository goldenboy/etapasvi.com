<?php

/**
 * VideoI18n form base class.
 *
 * @method VideoI18n getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseVideoI18nForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'updated_at_extra' => new sfWidgetFormDateTime(),
      'img'              => new sfWidgetFormInputText(),
      'code'             => new sfWidgetFormTextarea(),
      'title'            => new sfWidgetFormTextarea(),
      'body'             => new sfWidgetFormTextarea(),
      'id'               => new sfWidgetFormInputHidden(),
      'culture'          => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'updated_at_extra' => new sfValidatorDateTime(array('required' => false)),
      'img'              => new sfValidatorString(array('max_length' => 255)),
      'code'             => new sfValidatorString(),
      'title'            => new sfValidatorString(array('required' => false)),
      'body'             => new sfValidatorString(array('required' => false)),
      'id'               => new sfValidatorPropelChoice(array('model' => 'Video', 'column' => 'id', 'required' => false)),
      'culture'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getCulture()), 'empty_value' => $this->getObject()->getCulture(), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('video_i18n[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'VideoI18n';
  }


}
