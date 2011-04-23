<?php

/**
 * Subscribe form base class.
 *
 * @method Subscribe getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseSubscribeForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'    => new sfWidgetFormInputHidden(),
      'item_id'    => new sfWidgetFormInputHidden(),
      'item_type'  => new sfWidgetFormInputHidden(),
      'item_lang'  => new sfWidgetFormInputHidden(),
      'created_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'user_id'    => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'item_id'    => new sfValidatorChoice(array('choices' => array($this->getObject()->getItemId()), 'empty_value' => $this->getObject()->getItemId(), 'required' => false)),
      'item_type'  => new sfValidatorChoice(array('choices' => array($this->getObject()->getItemType()), 'empty_value' => $this->getObject()->getItemType(), 'required' => false)),
      'item_lang'  => new sfValidatorChoice(array('choices' => array($this->getObject()->getItemLang()), 'empty_value' => $this->getObject()->getItemLang(), 'required' => false)),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('subscribe[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Subscribe';
  }


}
