<?php

/**
 * Banner form base class.
 *
 * @method Banner getObject() Returns the current form's model object
 *
 * @package    imdb
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseBannerForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'path'        => new sfWidgetFormInputText(),
      'ext'         => new sfWidgetFormInputText(),
      'link'        => new sfWidgetFormInputText(),
      'route'       => new sfWidgetFormInputText(),
      'target'      => new sfWidgetFormInputText(),
      'position'    => new sfWidgetFormInputText(),
      'start_date'  => new sfWidgetFormDate(),
      'end_date'    => new sfWidgetFormDate(),
      'sort'        => new sfWidgetFormInputText(),
      'nb_views'    => new sfWidgetFormInputText(),
      'is_active'   => new sfWidgetFormInputText(),
      'is_featured' => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
      'created_aid' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Admin'), 'add_empty' => false)),
      'updated_aid' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Admin_2'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'path'        => new sfValidatorString(array('max_length' => 255)),
      'ext'         => new sfValidatorString(array('max_length' => 255)),
      'link'        => new sfValidatorString(array('max_length' => 255)),
      'route'       => new sfValidatorString(array('max_length' => 255)),
      'target'      => new sfValidatorInteger(),
      'position'    => new sfValidatorString(array('max_length' => 255)),
      'start_date'  => new sfValidatorDate(),
      'end_date'    => new sfValidatorDate(),
      'sort'        => new sfValidatorInteger(),
      'nb_views'    => new sfValidatorInteger(),
      'is_active'   => new sfValidatorInteger(),
      'is_featured' => new sfValidatorInteger(),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(array('required' => false)),
      'created_aid' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Admin'))),
      'updated_aid' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Admin_2'))),
    ));

    $this->widgetSchema->setNameFormat('banner[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Banner';
  }

}
