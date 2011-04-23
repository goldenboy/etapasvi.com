<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * PhpbbConfig filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BasePhpbbConfigFormFilter extends BaseFormFilterPropel
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

    $this->widgetSchema->setNameFormat('phpbb_config_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PhpbbConfig';
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
