<?php

/**
 * Alert form base class.
 *
 * @method Alert getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseAlertForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'created_at'   => new sfWidgetFormDateTime(),
      'user_id'      => new sfWidgetFormInputHidden(),
      'item_type'    => new sfWidgetFormInputHidden(),
      'item_id'      => new sfWidgetFormInputHidden(),
      'item_lang'    => new sfWidgetFormInputHidden(),
      'item_by_user' => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'is_comment'   => new sfWidgetFormInputHidden(),
      'status'       => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'created_at'   => new sfValidatorDateTime(array('required' => false)),
      'user_id'      => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'item_type'    => new sfValidatorChoice(array('choices' => array($this->getObject()->getItemType()), 'empty_value' => $this->getObject()->getItemType(), 'required' => false)),
      'item_id'      => new sfValidatorChoice(array('choices' => array($this->getObject()->getItemId()), 'empty_value' => $this->getObject()->getItemId(), 'required' => false)),
      'item_lang'    => new sfValidatorChoice(array('choices' => array($this->getObject()->getItemLang()), 'empty_value' => $this->getObject()->getItemLang(), 'required' => false)),
      'item_by_user' => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'is_comment'   => new sfValidatorChoice(array('choices' => array($this->getObject()->getIsComment()), 'empty_value' => $this->getObject()->getIsComment(), 'required' => false)),
      'status'       => new sfValidatorChoice(array('choices' => array($this->getObject()->getStatus()), 'empty_value' => $this->getObject()->getStatus(), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('alert[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Alert';
  }


}
