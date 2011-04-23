<?php

/**
 * Phpb7d3xSessionsKeys filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 */
abstract class BasePhpb7d3xSessionsKeysFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'last_ip'    => new sfWidgetFormFilterInput(),
      'last_login' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'last_ip'    => new sfValidatorPass(array('required' => false)),
      'last_login' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('phpb7d3x_sessions_keys_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Phpb7d3xSessionsKeys';
  }

  public function getFields()
  {
    return array(
      'key_id'     => 'Text',
      'user_id'    => 'Number',
      'last_ip'    => 'Text',
      'last_login' => 'Number',
    );
  }
}
