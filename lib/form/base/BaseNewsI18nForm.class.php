<?php

/**
 * NewsI18n form base class.
 *
 * @method NewsI18n getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseNewsI18nForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'updated_at_extra' => new sfWidgetFormDateTime(),
      'title'            => new sfWidgetFormTextarea(),
      'shortbody'        => new sfWidgetFormTextarea(),
      'body'             => new sfWidgetFormTextarea(),
      'author'           => new sfWidgetFormInputText(),
      'translated_by'    => new sfWidgetFormInputText(),
      'link'             => new sfWidgetFormInputText(),
      'extradate'        => new sfWidgetFormInputText(),
      'id'               => new sfWidgetFormInputHidden(),
      'culture'          => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'updated_at_extra' => new sfValidatorDateTime(array('required' => false)),
      'title'            => new sfValidatorString(),
      'shortbody'        => new sfValidatorString(),
      'body'             => new sfValidatorString(),
      'author'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'translated_by'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'link'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'extradate'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'id'               => new sfValidatorPropelChoice(array('model' => 'News', 'column' => 'id', 'required' => false)),
      'culture'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getCulture()), 'empty_value' => $this->getObject()->getCulture(), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('news_i18n[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'NewsI18n';
  }


}
