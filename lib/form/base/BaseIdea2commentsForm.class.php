<?php

/**
 * Idea2comments form base class.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseIdea2commentsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'idea_id'     => new sfWidgetFormPropelChoice(array('model' => 'Idea', 'add_empty' => true)),
      'comments_id' => new sfWidgetFormPropelChoice(array('model' => 'Comments', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'Idea2comments', 'column' => 'id', 'required' => false)),
      'idea_id'     => new sfValidatorPropelChoice(array('model' => 'Idea', 'column' => 'id', 'required' => false)),
      'comments_id' => new sfValidatorPropelChoice(array('model' => 'Comments', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('idea2comments[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Idea2comments';
  }


}
