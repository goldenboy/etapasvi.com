<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * PhpbbSessionsKeys filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BasePhpbbSessionsKeysFormFilter extends BaseFormFilterPropel
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

    $this->widgetSchema->setNameFormat('phpbb_sessions_keys_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PhpbbSessionsKeys';
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
