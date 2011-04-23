<?php

/**
 * Photoalbum form base class.
 *
 * @method Photoalbum getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 */
abstract class BasePhotoalbumForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'created_at' => new sfWidgetFormDateTime(),
      'show'       => new sfWidgetFormInputCheckbox(),
      'order'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
      'show'       => new sfValidatorBoolean(array('required' => false)),
      'order'      => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
    ));

    $this->widgetSchema->setNameFormat('photoalbum[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Photoalbum';
  }

  public function getI18nModelName()
  {
    return 'PhotoalbumI18n';
  }

  public function getI18nFormClass()
  {
    return 'PhotoalbumI18nForm';
  }

}
