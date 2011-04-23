<?php

/**
 * Item2item filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseItem2itemFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'item1_id'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'item1_type' => new sfWidgetFormPropelChoice(array('model' => 'Itemtypes', 'add_empty' => true)),
      'item2_id'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'item2_type' => new sfWidgetFormPropelChoice(array('model' => 'Itemtypes', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'item1_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'item1_type' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Itemtypes', 'column' => 'id')),
      'item2_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'item2_type' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Itemtypes', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('item2item_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Item2item';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'item1_id'   => 'Number',
      'item1_type' => 'ForeignKey',
      'item2_id'   => 'Number',
      'item2_type' => 'ForeignKey',
    );
  }
}
