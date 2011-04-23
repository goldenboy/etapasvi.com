<?php

/**
 * News2video form base class.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseNews2videoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'       => new sfWidgetFormInputHidden(),
      'news_id'  => new sfWidgetFormPropelChoice(array('model' => 'News', 'add_empty' => false)),
      'video_id' => new sfWidgetFormPropelChoice(array('model' => 'Video', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'       => new sfValidatorPropelChoice(array('model' => 'News2video', 'column' => 'id', 'required' => false)),
      'news_id'  => new sfValidatorPropelChoice(array('model' => 'News', 'column' => 'id')),
      'video_id' => new sfValidatorPropelChoice(array('model' => 'Video', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('news2video[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'News2video';
  }


}
