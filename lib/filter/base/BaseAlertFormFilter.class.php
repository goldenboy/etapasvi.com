<?php

/**
 * Alert filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseAlertFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'created_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'item_by_user' => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'created_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'item_by_user' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('alert_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Alert';
  }

  public function getFields()
  {
    return array(
      'created_at'   => 'Date',
      'user_id'      => 'ForeignKey',
      'item_type'    => 'Number',
      'item_id'      => 'Number',
      'item_lang'    => 'Text',
      'item_by_user' => 'ForeignKey',
      'is_comment'   => 'Boolean',
      'status'       => 'Number',
    );
  }
}
