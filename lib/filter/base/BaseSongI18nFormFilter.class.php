<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * SongI18n filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseSongI18nFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'file'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'file'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('song_i18n_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SongI18n';
  }

  public function getFields()
  {
    return array(
      'file'    => 'Text',
      'id'      => 'ForeignKey',
      'culture' => 'Text',
    );
  }
}
