<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * BestideaI18n filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseBestideaI18nFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'idea_id' => new sfWidgetFormPropelChoice(array('model' => 'Idea', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idea_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Idea', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('bestidea_i18n_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BestideaI18n';
  }

  public function getFields()
  {
    return array(
      'idea_id' => 'ForeignKey',
      'id'      => 'ForeignKey',
      'culture' => 'Text',
    );
  }
}
