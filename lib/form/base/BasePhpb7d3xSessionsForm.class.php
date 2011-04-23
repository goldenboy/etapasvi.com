<?php

/**
 * Phpb7d3xSessions form base class.
 *
 * @method Phpb7d3xSessions getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 */
abstract class BasePhpb7d3xSessionsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'session_id'            => new sfWidgetFormInputHidden(),
      'session_user_id'       => new sfWidgetFormInputText(),
      'session_forum_id'      => new sfWidgetFormInputText(),
      'session_last_visit'    => new sfWidgetFormInputText(),
      'session_start'         => new sfWidgetFormInputText(),
      'session_time'          => new sfWidgetFormInputText(),
      'session_ip'            => new sfWidgetFormInputText(),
      'session_browser'       => new sfWidgetFormInputText(),
      'session_forwarded_for' => new sfWidgetFormInputText(),
      'session_page'          => new sfWidgetFormInputText(),
      'session_viewonline'    => new sfWidgetFormInputText(),
      'session_autologin'     => new sfWidgetFormInputText(),
      'session_admin'         => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'session_id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->getSessionId()), 'empty_value' => $this->getObject()->getSessionId(), 'required' => false)),
      'session_user_id'       => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'session_forum_id'      => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'session_last_visit'    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'session_start'         => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'session_time'          => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'session_ip'            => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'session_browser'       => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'session_forwarded_for' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'session_page'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'session_viewonline'    => new sfValidatorInteger(array('min' => -128, 'max' => 127, 'required' => false)),
      'session_autologin'     => new sfValidatorInteger(array('min' => -128, 'max' => 127, 'required' => false)),
      'session_admin'         => new sfValidatorInteger(array('min' => -128, 'max' => 127, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('phpb7d3x_sessions[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Phpb7d3xSessions';
  }


}
