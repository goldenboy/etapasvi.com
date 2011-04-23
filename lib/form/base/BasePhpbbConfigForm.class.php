<?php

/**
 * PhpbbConfig form base class.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BasePhpbbConfigForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'config_name'  => new sfWidgetFormInputHidden(),
      'config_value' => new sfWidgetFormInput(),
      'is_dynamic'   => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'config_name'  => new sfValidatorPropelChoice(array('model' => 'PhpbbConfig', 'column' => 'config_name', 'required' => false)),
      'config_value' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_dynamic'   => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('phpbb_config[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PhpbbConfig';
  }


}
