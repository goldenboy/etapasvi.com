<?php

/**
 * News filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseNewsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'date'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'show'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'order'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'img'        => new sfWidgetFormFilterInput(),
      'full_path'  => new sfWidgetFormFilterInput(),
      'thumb_path' => new sfWidgetFormFilterInput(),
      'original'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'type'       => new sfWidgetFormPropelChoice(array('model' => 'Newstypes', 'add_empty' => true)),
      'prev_img'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'date'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'show'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'order'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'img'        => new sfValidatorPass(array('required' => false)),
      'full_path'  => new sfValidatorPass(array('required' => false)),
      'thumb_path' => new sfValidatorPass(array('required' => false)),
      'original'   => new sfValidatorPass(array('required' => false)),
      'type'       => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Newstypes', 'column' => 'id')),
      'prev_img'   => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('news_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'News';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'date'       => 'Date',
      'updated_at' => 'Date',
      'show'       => 'Boolean',
      'order'      => 'Number',
      'img'        => 'Text',
      'full_path'  => 'Text',
      'thumb_path' => 'Text',
      'original'   => 'Text',
      'type'       => 'ForeignKey',
      'prev_img'   => 'Text',
    );
  }
}
