<?php

/**
 * Photo2comments filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 */
abstract class BasePhoto2commentsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'photo_id'    => new sfWidgetFormPropelChoice(array('model' => 'Photo', 'add_empty' => true)),
      'comments_id' => new sfWidgetFormPropelChoice(array('model' => 'Comments', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'photo_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Photo', 'column' => 'id')),
      'comments_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Comments', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('photo2comments_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Photo2comments';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'photo_id'    => 'ForeignKey',
      'comments_id' => 'ForeignKey',
    );
  }
}
