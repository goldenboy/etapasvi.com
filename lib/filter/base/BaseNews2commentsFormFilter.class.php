<?php

/**
 * News2comments filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseNews2commentsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'news_id'     => new sfWidgetFormPropelChoice(array('model' => 'News', 'add_empty' => true)),
      'comments_id' => new sfWidgetFormPropelChoice(array('model' => 'Comments', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'news_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'News', 'column' => 'id')),
      'comments_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Comments', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('news2comments_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'News2comments';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'news_id'     => 'ForeignKey',
      'comments_id' => 'ForeignKey',
    );
  }
}
