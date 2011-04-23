<?php

/**
 * News2comments form base class.
 *
 * @method News2comments getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseNews2commentsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'news_id'     => new sfWidgetFormPropelChoice(array('model' => 'News', 'add_empty' => true)),
      'comments_id' => new sfWidgetFormPropelChoice(array('model' => 'Comments', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'news_id'     => new sfValidatorPropelChoice(array('model' => 'News', 'column' => 'id', 'required' => false)),
      'comments_id' => new sfValidatorPropelChoice(array('model' => 'Comments', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('news2comments[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'News2comments';
  }


}
