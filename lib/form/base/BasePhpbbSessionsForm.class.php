<?php

/**
 * PhpbbSessions form base class.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BasePhpbbSessionsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'session_id'            => new sfWidgetFormInputHidden(),
      'session_user_id'       => new sfWidgetFormInput(),
      'session_forum_id'      => new sfWidgetFormInput(),
      'session_last_visit'    => new sfWidgetFormInput(),
      'session_start'         => new sfWidgetFormInput(),
      'session_time'          => new sfWidgetFormInput(),
      'session_ip'            => new sfWidgetFormInput(),
      'session_browser'       => new sfWidgetFormInput(),
      'session_forwarded_for' => new sfWidgetFormInput(),
      'session_page'          => new sfWidgetFormInput(),
      'session_viewonline'    => new sfWidgetFormInput(),
      'session_autologin'     => new sfWidgetFormInput(),
      'session_admin'         => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'session_id'            => new sfValidatorPropelChoice(array('model' => 'PhpbbSessions', 'column' => 'session_id', 'required' => false)),
      'session_user_id'       => new sfValidatorInteger(array('required' => false)),
      'session_forum_id'      => new sfValidatorInteger(array('required' => false)),
      'session_last_visit'    => new sfValidatorInteger(array('required' => false)),
      'session_start'         => new sfValidatorInteger(array('required' => false)),
      'session_time'          => new sfValidatorInteger(array('required' => false)),
      'session_ip'            => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'session_browser'       => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'session_forwarded_for' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'session_page'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'session_viewonline'    => new sfValidatorInteger(array('required' => false)),
      'session_autologin'     => new sfValidatorInteger(array('required' => false)),
      'session_admin'         => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('phpbb_sessions[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PhpbbSessions';
  }


}
