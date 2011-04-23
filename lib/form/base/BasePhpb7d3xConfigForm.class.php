<?php

/**
 * Phpb7d3xConfig form base class.
 *
 * @method Phpb7d3xConfig getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 */
abstract class BasePhpb7d3xConfigForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'config_name'  => new sfWidgetFormInputHidden(),
      'config_value' => new sfWidgetFormInputText(),
      'is_dynamic'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'config_name'  => new sfValidatorChoice(array('choices' => array($this->getObject()->getConfigName()), 'empty_value' => $this->getObject()->getConfigName(), 'required' => false)),
      'config_value' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_dynamic'   => new sfValidatorInteger(array('min' => -128, 'max' => 127, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('phpb7d3x_config[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Phpb7d3xConfig';
  }


}
