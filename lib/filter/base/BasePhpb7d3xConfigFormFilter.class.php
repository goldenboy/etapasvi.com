<?php

/**
 * Phpb7d3xConfig filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 */
abstract class BasePhpb7d3xConfigFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'config_value' => new sfWidgetFormFilterInput(),
      'is_dynamic'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'config_value' => new sfValidatorPass(array('required' => false)),
      'is_dynamic'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('phpb7d3x_config_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Phpb7d3xConfig';
  }

  public function getFields()
  {
    return array(
      'config_name'  => 'Text',
      'config_value' => 'Text',
      'is_dynamic'   => 'Number',
    );
  }
}
