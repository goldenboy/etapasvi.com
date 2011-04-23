<?php

/**
 * PhotoalbumI18n form base class.
 *
 * @method PhotoalbumI18n getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 */
abstract class BasePhotoalbumI18nForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'   => new sfWidgetFormTextarea(),
      'author'  => new sfWidgetFormInputText(),
      'id'      => new sfWidgetFormInputHidden(),
      'culture' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'title'   => new sfValidatorString(array('required' => false)),
      'author'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'id'      => new sfValidatorPropelChoice(array('model' => 'Photoalbum', 'column' => 'id', 'required' => false)),
      'culture' => new sfValidatorChoice(array('choices' => array($this->getObject()->getCulture()), 'empty_value' => $this->getObject()->getCulture(), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('photoalbum_i18n[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PhotoalbumI18n';
  }


}
