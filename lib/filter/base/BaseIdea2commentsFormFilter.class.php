<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Idea2comments filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseIdea2commentsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'idea_id'     => new sfWidgetFormPropelChoice(array('model' => 'Idea', 'add_empty' => true)),
      'comments_id' => new sfWidgetFormPropelChoice(array('model' => 'Comments', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idea_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Idea', 'column' => 'id')),
      'comments_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Comments', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('idea2comments_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Idea2comments';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'idea_id'     => 'ForeignKey',
      'comments_id' => 'ForeignKey',
    );
  }
}
