<?php

/**
 * PhotoalbumI18n filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 */
abstract class BasePhotoalbumI18nFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'   => new sfWidgetFormFilterInput(),
      'author'  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'title'   => new sfValidatorPass(array('required' => false)),
      'author'  => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('photoalbum_i18n_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PhotoalbumI18n';
  }

  public function getFields()
  {
    return array(
      'title'   => 'Text',
      'author'  => 'Text',
      'id'      => 'ForeignKey',
      'culture' => 'Text',
    );
  }
}
