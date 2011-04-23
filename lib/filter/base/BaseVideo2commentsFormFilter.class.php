<?php

/**
 * Video2comments filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseVideo2commentsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'video_id'    => new sfWidgetFormPropelChoice(array('model' => 'Video', 'add_empty' => true)),
      'comments_id' => new sfWidgetFormPropelChoice(array('model' => 'Comments', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'video_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Video', 'column' => 'id')),
      'comments_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Comments', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('video2comments_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Video2comments';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'video_id'    => 'ForeignKey',
      'comments_id' => 'ForeignKey',
    );
  }
}
