<?php

/**
 * NewsI18n filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseNewsI18nFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'updated_at_extra' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'title'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'shortbody'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'body'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'author'           => new sfWidgetFormFilterInput(),
      'translated_by'    => new sfWidgetFormFilterInput(),
      'link'             => new sfWidgetFormFilterInput(),
      'extradate'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'updated_at_extra' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'title'            => new sfValidatorPass(array('required' => false)),
      'shortbody'        => new sfValidatorPass(array('required' => false)),
      'body'             => new sfValidatorPass(array('required' => false)),
      'author'           => new sfValidatorPass(array('required' => false)),
      'translated_by'    => new sfValidatorPass(array('required' => false)),
      'link'             => new sfValidatorPass(array('required' => false)),
      'extradate'        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('news_i18n_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'NewsI18n';
  }

  public function getFields()
  {
    return array(
      'updated_at_extra' => 'Date',
      'title'            => 'Text',
      'shortbody'        => 'Text',
      'body'             => 'Text',
      'author'           => 'Text',
      'translated_by'    => 'Text',
      'link'             => 'Text',
      'extradate'        => 'Text',
      'id'               => 'ForeignKey',
      'culture'          => 'Text',
    );
  }
}
