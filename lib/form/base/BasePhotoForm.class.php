<?php

/**
 * Photo form base class.
 *
 * @method Photo getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 */
abstract class BasePhotoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'photoalbum_id' => new sfWidgetFormPropelChoice(array('model' => 'Photoalbum', 'add_empty' => true)),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
      'show'          => new sfWidgetFormInputCheckbox(),
      'order'         => new sfWidgetFormInputText(),
      'img'           => new sfWidgetFormInputText(),
      'full_path'     => new sfWidgetFormInputText(),
      'preview_path'  => new sfWidgetFormInputText(),
      'thumb_path'    => new sfWidgetFormInputText(),
      'link'          => new sfWidgetFormInputText(),
      'prev_img'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'photoalbum_id' => new sfValidatorPropelChoice(array('model' => 'Photoalbum', 'column' => 'id', 'required' => false)),
      'created_at'    => new sfValidatorDateTime(array('required' => false)),
      'updated_at'    => new sfValidatorDateTime(array('required' => false)),
      'show'          => new sfValidatorBoolean(array('required' => false)),
      'order'         => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'img'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'full_path'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'preview_path'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'thumb_path'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'link'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'prev_img'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('photo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Photo';
  }

  public function getI18nModelName()
  {
    return 'PhotoI18n';
  }

  public function getI18nFormClass()
  {
    return 'PhotoI18nForm';
  }

}
