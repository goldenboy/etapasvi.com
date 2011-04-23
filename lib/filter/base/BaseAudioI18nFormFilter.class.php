<?php

/**
 * AudioI18n filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseAudioI18nFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'updated_at_extra' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'title'            => new sfWidgetFormFilterInput(),
      'author'           => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'updated_at_extra' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'title'            => new sfValidatorPass(array('required' => false)),
      'author'           => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('audio_i18n_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AudioI18n';
  }

  public function getFields()
  {
    return array(
      'updated_at_extra' => 'Date',
      'title'            => 'Text',
      'author'           => 'Text',
      'id'               => 'ForeignKey',
      'culture'          => 'Text',
    );
  }
}
