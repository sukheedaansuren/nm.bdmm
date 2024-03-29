<?php

/**
 * Studio form base class.
 *
 * @method Studio getObject() Returns the current form's model object
 *
 * @package    imdb
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseStudioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'name'           => new sfWidgetFormTextarea(),
      'name_mn'        => new sfWidgetFormTextarea(),
      'route'          => new sfWidgetFormTextarea(),
      'location'       => new sfWidgetFormTextarea(),
      'image'          => new sfWidgetFormTextarea(),
      'birthday'       => new sfWidgetFormDate(),
      'deadday'        => new sfWidgetFormDate(),
      'about'          => new sfWidgetFormTextarea(),
      'about_mn'       => new sfWidgetFormTextarea(),
      'rating'         => new sfWidgetFormTextarea(),
      'official_link1' => new sfWidgetFormTextarea(),
      'official_link2' => new sfWidgetFormTextarea(),
      'sort'           => new sfWidgetFormInputText(),
      'nb_views'       => new sfWidgetFormInputText(),
      'nb_love'        => new sfWidgetFormInputText(),
      'is_active'      => new sfWidgetFormInputText(),
      'is_featured'    => new sfWidgetFormInputText(),
      'source'         => new sfWidgetFormTextarea(),
      'created_aid'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Admin'), 'add_empty' => false)),
      'updated_aid'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Admin_2'), 'add_empty' => false)),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'           => new sfValidatorString(array('max_length' => 1000)),
      'name_mn'        => new sfValidatorString(array('max_length' => 1000)),
      'route'          => new sfValidatorString(array('max_length' => 1000)),
      'location'       => new sfValidatorString(array('max_length' => 1000)),
      'image'          => new sfValidatorString(array('max_length' => 1000)),
      'birthday'       => new sfValidatorDate(),
      'deadday'        => new sfValidatorDate(),
      'about'          => new sfValidatorString(array('max_length' => 1000)),
      'about_mn'       => new sfValidatorString(array('max_length' => 1000)),
      'rating'         => new sfValidatorString(array('max_length' => 1000)),
      'official_link1' => new sfValidatorString(array('max_length' => 1000)),
      'official_link2' => new sfValidatorString(array('max_length' => 1000)),
      'sort'           => new sfValidatorInteger(),
      'nb_views'       => new sfValidatorInteger(),
      'nb_love'        => new sfValidatorInteger(),
      'is_active'      => new sfValidatorInteger(),
      'is_featured'    => new sfValidatorInteger(),
      'source'         => new sfValidatorString(array('max_length' => 1000)),
      'created_aid'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Admin'))),
      'updated_aid'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Admin_2'))),
      'created_at'     => new sfValidatorDateTime(),
      'updated_at'     => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('studio[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Studio';
  }

}
