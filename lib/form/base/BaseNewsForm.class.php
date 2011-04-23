<?php

/**
 * News form base class.
 *
 * @method News getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseNewsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'date'       => new sfWidgetFormDate(),
      'updated_at' => new sfWidgetFormDateTime(),
      'show'       => new sfWidgetFormInputCheckbox(),
      'order'      => new sfWidgetFormInputText(),
      'img'        => new sfWidgetFormInputText(),
      'full_path'  => new sfWidgetFormInputText(),
      'thumb_path' => new sfWidgetFormInputText(),
      'original'   => new sfWidgetFormTextarea(),
      'type'       => new sfWidgetFormPropelChoice(array('model' => 'Newstypes', 'add_empty' => false)),
      'prev_img'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'date'       => new sfValidatorDate(array('required' => false)),
      'updated_at' => new sfValidatorDateTime(array('required' => false)),
      'show'       => new sfValidatorBoolean(array('required' => false)),
      'order'      => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'img'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'full_path'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'thumb_path' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'original'   => new sfValidatorString(),
      'type'       => new sfValidatorPropelChoice(array('model' => 'Newstypes', 'column' => 'id')),
      'prev_img'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('news[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'News';
  }

  public function getI18nModelName()
  {
    return 'NewsI18n';
  }

  public function getI18nFormClass()
  {
    return 'NewsI18nForm';
  }

}
