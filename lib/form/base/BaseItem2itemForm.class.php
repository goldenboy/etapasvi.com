<?php

/**
 * Item2item form base class.
 *
 * @method Item2item getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseItem2itemForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'item1_id'   => new sfWidgetFormInputText(),
      'item1_type' => new sfWidgetFormPropelChoice(array('model' => 'Itemtypes', 'add_empty' => false)),
      'item2_id'   => new sfWidgetFormInputText(),
      'item2_type' => new sfWidgetFormPropelChoice(array('model' => 'Itemtypes', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'item1_id'   => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'item1_type' => new sfValidatorPropelChoice(array('model' => 'Itemtypes', 'column' => 'id')),
      'item2_id'   => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'item2_type' => new sfValidatorPropelChoice(array('model' => 'Itemtypes', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('item2item[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Item2item';
  }


}
