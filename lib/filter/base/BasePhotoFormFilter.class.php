<?php

/**
 * Photo filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 */
abstract class BasePhotoFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'photoalbum_id' => new sfWidgetFormPropelChoice(array('model' => 'Photoalbum', 'add_empty' => true)),
      'created_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'show'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'order'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'img'           => new sfWidgetFormFilterInput(),
      'full_path'     => new sfWidgetFormFilterInput(),
      'preview_path'  => new sfWidgetFormFilterInput(),
      'thumb_path'    => new sfWidgetFormFilterInput(),
      'link'          => new sfWidgetFormFilterInput(),
      'prev_img'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'photoalbum_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Photoalbum', 'column' => 'id')),
      'created_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'show'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'order'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'img'           => new sfValidatorPass(array('required' => false)),
      'full_path'     => new sfValidatorPass(array('required' => false)),
      'preview_path'  => new sfValidatorPass(array('required' => false)),
      'thumb_path'    => new sfValidatorPass(array('required' => false)),
      'link'          => new sfValidatorPass(array('required' => false)),
      'prev_img'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('photo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Photo';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'photoalbum_id' => 'ForeignKey',
      'created_at'    => 'Date',
      'updated_at'    => 'Date',
      'show'          => 'Boolean',
      'order'         => 'Number',
      'img'           => 'Text',
      'full_path'     => 'Text',
      'preview_path'  => 'Text',
      'thumb_path'    => 'Text',
      'link'          => 'Text',
      'prev_img'      => 'Text',
    );
  }
}
