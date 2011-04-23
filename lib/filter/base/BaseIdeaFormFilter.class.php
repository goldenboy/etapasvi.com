<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Idea filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseIdeaFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'        => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'created_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'votes'          => new sfWidgetFormFilterInput(),
      'show'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'ideavote_list'  => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'ideaabuse_list' => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'user_id'        => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'created_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'votes'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'show'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'ideavote_list'  => new sfValidatorPropelChoice(array('model' => 'User', 'required' => false)),
      'ideaabuse_list' => new sfValidatorPropelChoice(array('model' => 'User', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('idea_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addIdeavoteListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(IdeavotePeer::IDEA_ID, IdeaPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(IdeavotePeer::USER_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(IdeavotePeer::USER_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function addIdeaabuseListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(IdeaabusePeer::IDEA_ID, IdeaPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(IdeaabusePeer::USER_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(IdeaabusePeer::USER_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'Idea';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'user_id'        => 'ForeignKey',
      'created_at'     => 'Date',
      'votes'          => 'Number',
      'show'           => 'Boolean',
      'ideavote_list'  => 'ManyKey',
      'ideaabuse_list' => 'ManyKey',
    );
  }
}
