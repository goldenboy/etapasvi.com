<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * PhpbbSessions filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BasePhpbbSessionsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'session_user_id'       => new sfWidgetFormFilterInput(),
      'session_forum_id'      => new sfWidgetFormFilterInput(),
      'session_last_visit'    => new sfWidgetFormFilterInput(),
      'session_start'         => new sfWidgetFormFilterInput(),
      'session_time'          => new sfWidgetFormFilterInput(),
      'session_ip'            => new sfWidgetFormFilterInput(),
      'session_browser'       => new sfWidgetFormFilterInput(),
      'session_forwarded_for' => new sfWidgetFormFilterInput(),
      'session_page'          => new sfWidgetFormFilterInput(),
      'session_viewonline'    => new sfWidgetFormFilterInput(),
      'session_autologin'     => new sfWidgetFormFilterInput(),
      'session_admin'         => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'session_user_id'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'session_forum_id'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'session_last_visit'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'session_start'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'session_time'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'session_ip'            => new sfValidatorPass(array('required' => false)),
      'session_browser'       => new sfValidatorPass(array('required' => false)),
      'session_forwarded_for' => new sfValidatorPass(array('required' => false)),
      'session_page'          => new sfValidatorPass(array('required' => false)),
      'session_viewonline'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'session_autologin'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'session_admin'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('phpbb_sessions_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PhpbbSessions';
  }

  public function getFields()
  {
    return array(
      'session_id'            => 'Text',
      'session_user_id'       => 'Number',
      'session_forum_id'      => 'Number',
      'session_last_visit'    => 'Number',
      'session_start'         => 'Number',
      'session_time'          => 'Number',
      'session_ip'            => 'Text',
      'session_browser'       => 'Text',
      'session_forwarded_for' => 'Text',
      'session_page'          => 'Text',
      'session_viewonline'    => 'Number',
      'session_autologin'     => 'Number',
      'session_admin'         => 'Number',
    );
  }
}
