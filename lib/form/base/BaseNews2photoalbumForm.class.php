<?php

/**
 * News2photoalbum form base class.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseNews2photoalbumForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'news_id'       => new sfWidgetFormPropelChoice(array('model' => 'News', 'add_empty' => false)),
      'photoalbum_id' => new sfWidgetFormPropelChoice(array('model' => 'Photoalbum', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorPropelChoice(array('model' => 'News2photoalbum', 'column' => 'id', 'required' => false)),
      'news_id'       => new sfValidatorPropelChoice(array('model' => 'News', 'column' => 'id')),
      'photoalbum_id' => new sfValidatorPropelChoice(array('model' => 'Photoalbum', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('news2photoalbum[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'News2photoalbum';
  }


}
