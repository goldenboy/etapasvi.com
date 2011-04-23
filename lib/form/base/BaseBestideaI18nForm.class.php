<?php

/**
 * BestideaI18n form base class.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseBestideaI18nForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'idea_id' => new sfWidgetFormPropelChoice(array('model' => 'Idea', 'add_empty' => true)),
      'id'      => new sfWidgetFormInputHidden(),
      'culture' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'idea_id' => new sfValidatorPropelChoice(array('model' => 'Idea', 'column' => 'id', 'required' => false)),
      'id'      => new sfValidatorPropelChoice(array('model' => 'Bestidea', 'column' => 'id', 'required' => false)),
      'culture' => new sfValidatorPropelChoice(array('model' => 'BestideaI18n', 'column' => 'culture', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('bestidea_i18n[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BestideaI18n';
  }


}
