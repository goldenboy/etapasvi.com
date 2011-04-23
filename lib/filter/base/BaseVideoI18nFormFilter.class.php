<?php

/**
 * VideoI18n filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseVideoI18nFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'updated_at_extra' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'img'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'code'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'title'            => new sfWidgetFormFilterInput(),
      'body'             => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'updated_at_extra' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'img'              => new sfValidatorPass(array('required' => false)),
      'code'             => new sfValidatorPass(array('required' => false)),
      'title'            => new sfValidatorPass(array('required' => false)),
      'body'             => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('video_i18n_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'VideoI18n';
  }

  public function getFields()
  {
    return array(
      'updated_at_extra' => 'Date',
      'img'              => 'Text',
      'code'             => 'Text',
      'title'            => 'Text',
      'body'             => 'Text',
      'id'               => 'ForeignKey',
      'culture'          => 'Text',
    );
  }
}
