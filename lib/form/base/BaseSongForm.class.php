<?php

/**
 * Song form base class.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseSongForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id' => new sfValidatorPropelChoice(array('model' => 'Song', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('song[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Song';
  }

  public function getI18nModelName()
  {
    return 'SongI18n';
  }

  public function getI18nFormClass()
  {
    return 'SongI18nForm';
  }

}
