<?php

/**
 * Phpb7d3xUsers filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 */
abstract class BasePhpb7d3xUsersFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_type'        => new sfWidgetFormFilterInput(),
      'group_id'         => new sfWidgetFormFilterInput(),
      'user_permissions' => new sfWidgetFormFilterInput(),
      'user_perm_from'   => new sfWidgetFormFilterInput(),
      'user_ip'          => new sfWidgetFormFilterInput(),
      'user_regdate'     => new sfWidgetFormFilterInput(),
      'username'         => new sfWidgetFormFilterInput(),
      'username_clean'   => new sfWidgetFormFilterInput(),
      'user_password'    => new sfWidgetFormFilterInput(),
      'user_email'       => new sfWidgetFormFilterInput(),
      'user_email_hash'  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'user_type'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'group_id'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'user_permissions' => new sfValidatorPass(array('required' => false)),
      'user_perm_from'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'user_ip'          => new sfValidatorPass(array('required' => false)),
      'user_regdate'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'username'         => new sfValidatorPass(array('required' => false)),
      'username_clean'   => new sfValidatorPass(array('required' => false)),
      'user_password'    => new sfValidatorPass(array('required' => false)),
      'user_email'       => new sfValidatorPass(array('required' => false)),
      'user_email_hash'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('phpb7d3x_users_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Phpb7d3xUsers';
  }

  public function getFields()
  {
    return array(
      'user_id'          => 'Number',
      'user_type'        => 'Number',
      'group_id'         => 'Number',
      'user_permissions' => 'Text',
      'user_perm_from'   => 'Number',
      'user_ip'          => 'Text',
      'user_regdate'     => 'Number',
      'username'         => 'Text',
      'username_clean'   => 'Text',
      'user_password'    => 'Text',
      'user_email'       => 'Text',
      'user_email_hash'  => 'Number',
    );
  }
}
