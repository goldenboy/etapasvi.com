<?php

/**
 * User form.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class UserForm extends BaseUserForm
{
  public function configure()
  {  
    $this->setWidgets(array(
      'name'        		=> new sfWidgetFormInput(),
      'email'       		=> new sfWidgetFormInput(),
      'password'    		=> new sfWidgetFormInputPassword(array('always_render_empty' => false)),
      //'timezone_id' 		=> new sfWidgetFormPropelChoice(array('model' => 'Timezone', 'add_empty' => false)),      
      'is_active'   		=> new sfWidgetFormInputCheckbox(),    
      'profile'   			=> new sfWidgetFormInput(),    
      'subscribe_news' 		=> new sfWidgetFormInputCheckbox(),    
      'subscribe_photo'		=> new sfWidgetFormInputCheckbox(),
      'subscribe_video'		=> new sfWidgetFormInputCheckbox(),
      'lang'				=> new sfWidgetFormChoice( array('choices' => UserPeer::getCultureNames()) )
    ));
 
    // Change the widget label
    $this->widgetSchema->setLabel('name', 'Login ');
    $this->widgetSchema->setLabel('email', 'Email');
    $this->widgetSchema->setLabel('password', 'Password');
    $this->widgetSchema->setLabel('profile', 'Profile URL');
    //$this->widgetSchema->setLabel('timezone_id', 'Time Zone');
    
    
	$this->validatorSchema['name'] = new sfValidatorString(
      array(
      	'min_length' => 2, 
      	'max_length' => 20,
      	'required' 	 => true,
      	'trim' 	 	 => true
      ),
      array(
      	'min_length' 	=> 'Login must be at least %min_length% characters',
      	'max_length' 	=> 'Login must not exceed %max_length% characters',
      	'required' 		=> 'Required'
      )
    );     
    $this->validatorSchema['email'] = new sfValidatorEmail(
      array(
      	'min_length' => 2, 
      	'max_length' => 45,
      	'required' 	 => true,
      	'trim' 	 	 => true
      ),
      array(
      	'min_length' 	=> 'Email must be at least %min_length% characters',
      	'max_length' 	=> 'Email must not exceed %max_length% characters',
      	'required' 		=> 'Required',
      	'invalid' 		=> 'Please enter a valid email address'
      )
    );
    $this->validatorSchema['profile'] = new sfValidatorUrl(
      array(
      	'required' 	 => false,
      	'trim' 	 	 => true
      ),
      array(
      	'invalid' 		=> 'Please enter a valid URL'
      )
    );
    $this->validatorSchema['password'] = new sfValidatorString(
      array( 
      	'max_length' => 255,
      	'required' 	 => true
      ),
      array(
      	'max_length' 	=> 'Password must not exceed %max_length% characters',
      	'required' 		=> 'Required'
      )
    );
    /*$this->validatorSchema['timezone_id'] = new sfValidatorString(
      array( 
      	'required' 	 => true
      ),
      array(
      	'required' 		=> 'Required'
      )
    );*/       
    
    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(
      	array('model' => 'User', 'column' => array('name')),
      	array('invalid' => 'Login is already in use, please choose another')
      )
    );
    /*
    $this->validatorSchema->mergePostValidator(
      new sfValidatorPropelUnique(
      	array('model' => 'User', 'column' => array('email')),
      	array('invalid' => 'E-mail is already in use, please choose another')
      )
    );*/
    
    // Нужно, чтобы правильно формировались имена полей формы
    $this->widgetSchema->setNameFormat('user[%s]');
       
  }
}
