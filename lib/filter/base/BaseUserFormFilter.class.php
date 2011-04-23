<?php

/**
 * User filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseUserFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'timezone_id'      => new sfWidgetFormPropelChoice(array('model' => 'Timezone', 'add_empty' => true)),
      'name'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'email'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'password'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'profile'          => new sfWidgetFormFilterInput(),
      'is_active'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'remember_me_code' => new sfWidgetFormFilterInput(),
      'ip'               => new sfWidgetFormFilterInput(),
      'last_login'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'lang'             => new sfWidgetFormFilterInput(),
      'phpbb_id'         => new sfWidgetFormFilterInput(),
      'remind_code'      => new sfWidgetFormFilterInput(),
      'subscribe_news'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'subscribe_photo'  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'subscribe_video'  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'notes'            => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'timezone_id'      => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Timezone', 'column' => 'id')),
      'name'             => new sfValidatorPass(array('required' => false)),
      'email'            => new sfValidatorPass(array('required' => false)),
      'password'         => new sfValidatorPass(array('required' => false)),
      'profile'          => new sfValidatorPass(array('required' => false)),
      'is_active'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'remember_me_code' => new sfValidatorPass(array('required' => false)),
      'ip'               => new sfValidatorPass(array('required' => false)),
      'last_login'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'lang'             => new sfValidatorPass(array('required' => false)),
      'phpbb_id'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'remind_code'      => new sfValidatorPass(array('required' => false)),
      'subscribe_news'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'subscribe_photo'  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'subscribe_video'  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'notes'            => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('user_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'User';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'created_at'       => 'Date',
      'timezone_id'      => 'ForeignKey',
      'name'             => 'Text',
      'email'            => 'Text',
      'password'         => 'Text',
      'profile'          => 'Text',
      'is_active'        => 'Boolean',
      'remember_me_code' => 'Text',
      'ip'               => 'Text',
      'last_login'       => 'Date',
      'lang'             => 'Text',
      'phpbb_id'         => 'Number',
      'remind_code'      => 'Text',
      'subscribe_news'   => 'Boolean',
      'subscribe_photo'  => 'Boolean',
      'subscribe_video'  => 'Boolean',
      'notes'            => 'Text',
    );
  }
}
