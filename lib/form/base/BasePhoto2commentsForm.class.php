<?php

/**
 * Photo2comments form base class.
 *
 * @method Photo2comments getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 */
abstract class BasePhoto2commentsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'photo_id'    => new sfWidgetFormPropelChoice(array('model' => 'Photo', 'add_empty' => true)),
      'comments_id' => new sfWidgetFormPropelChoice(array('model' => 'Comments', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'photo_id'    => new sfValidatorPropelChoice(array('model' => 'Photo', 'column' => 'id', 'required' => false)),
      'comments_id' => new sfValidatorPropelChoice(array('model' => 'Comments', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('photo2comments[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Photo2comments';
  }


}
