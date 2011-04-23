<?php

/**
 * Idea form base class.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseIdeaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'user_id'        => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'created_at'     => new sfWidgetFormDateTime(),
      'votes'          => new sfWidgetFormInput(),
      'show'           => new sfWidgetFormInputCheckbox(),
      'ideavote_list'  => new sfWidgetFormPropelChoiceMany(array('model' => 'User')),
      'ideaabuse_list' => new sfWidgetFormPropelChoiceMany(array('model' => 'User')),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorPropelChoice(array('model' => 'Idea', 'column' => 'id', 'required' => false)),
      'user_id'        => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'created_at'     => new sfValidatorDateTime(array('required' => false)),
      'votes'          => new sfValidatorInteger(array('required' => false)),
      'show'           => new sfValidatorBoolean(array('required' => false)),
      'ideavote_list'  => new sfValidatorPropelChoiceMany(array('model' => 'User', 'required' => false)),
      'ideaabuse_list' => new sfValidatorPropelChoiceMany(array('model' => 'User', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('idea[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Idea';
  }

  public function getI18nModelName()
  {
    return 'IdeaI18n';
  }

  public function getI18nFormClass()
  {
    return 'IdeaI18nForm';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['ideavote_list']))
    {
      $values = array();
      foreach ($this->object->getIdeavotes() as $obj)
      {
        $values[] = $obj->getUserId();
      }

      $this->setDefault('ideavote_list', $values);
    }

    if (isset($this->widgetSchema['ideaabuse_list']))
    {
      $values = array();
      foreach ($this->object->getIdeaabuses() as $obj)
      {
        $values[] = $obj->getUserId();
      }

      $this->setDefault('ideaabuse_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveIdeavoteList($con);
    $this->saveIdeaabuseList($con);
  }

  public function saveIdeavoteList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['ideavote_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(IdeavotePeer::IDEA_ID, $this->object->getPrimaryKey());
    IdeavotePeer::doDelete($c, $con);

    $values = $this->getValue('ideavote_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new Ideavote();
        $obj->setIdeaId($this->object->getPrimaryKey());
        $obj->setUserId($value);
        $obj->save();
      }
    }
  }

  public function saveIdeaabuseList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['ideaabuse_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(IdeaabusePeer::IDEA_ID, $this->object->getPrimaryKey());
    IdeaabusePeer::doDelete($c, $con);

    $values = $this->getValue('ideaabuse_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new Ideaabuse();
        $obj->setIdeaId($this->object->getPrimaryKey());
        $obj->setUserId($value);
        $obj->save();
      }
    }
  }

}
