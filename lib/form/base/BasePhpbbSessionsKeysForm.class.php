<?php

/**
 * PhpbbSessionsKeys form base class.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BasePhpbbSessionsKeysForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'key_id'     => new sfWidgetFormInputHidden(),
      'user_id'    => new sfWidgetFormInputHidden(),
      'last_ip'    => new sfWidgetFormInput(),
      'last_login' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'key_id'     => new sfValidatorPropelChoice(array('model' => 'PhpbbSessionsKeys', 'column' => 'key_id', 'required' => false)),
      'user_id'    => new sfValidatorPropelChoice(array('model' => 'PhpbbSessionsKeys', 'column' => 'user_id', 'required' => false)),
      'last_ip'    => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'last_login' => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('phpbb_sessions_keys[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PhpbbSessionsKeys';
  }


}
