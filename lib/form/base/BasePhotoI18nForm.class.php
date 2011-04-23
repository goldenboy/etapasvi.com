<?php

/**
 * PhotoI18n form base class.
 *
 * @method PhotoI18n getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 */
abstract class BasePhotoI18nForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'updated_at_extra' => new sfWidgetFormDateTime(),
      'title'            => new sfWidgetFormTextarea(),
      'body'             => new sfWidgetFormTextarea(),
      'author'           => new sfWidgetFormInputText(),
      'id'               => new sfWidgetFormInputHidden(),
      'culture'          => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'updated_at_extra' => new sfValidatorDateTime(array('required' => false)),
      'title'            => new sfValidatorString(array('required' => false)),
      'body'             => new sfValidatorString(array('required' => false)),
      'author'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'id'               => new sfValidatorPropelChoice(array('model' => 'Photo', 'column' => 'id', 'required' => false)),
      'culture'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getCulture()), 'empty_value' => $this->getObject()->getCulture(), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('photo_i18n[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PhotoI18n';
  }


}
