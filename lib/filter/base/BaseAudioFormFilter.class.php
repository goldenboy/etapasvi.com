<?php

/**
 * Audio filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseAudioFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'show'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'file'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'remote'     => new sfWidgetFormFilterInput(),
      'size'       => new sfWidgetFormFilterInput(),
      'duration'   => new sfWidgetFormFilterInput(),
      'order'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'show'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'file'       => new sfValidatorPass(array('required' => false)),
      'remote'     => new sfValidatorPass(array('required' => false)),
      'size'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'duration'   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'order'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('audio_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Audio';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'created_at' => 'Date',
      'updated_at' => 'Date',
      'show'       => 'Boolean',
      'file'       => 'Text',
      'remote'     => 'Text',
      'size'       => 'Number',
      'duration'   => 'Number',
      'order'      => 'Number',
    );
  }
}
