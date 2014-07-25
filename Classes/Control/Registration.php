<?php
/**
 *It is the Control Registration file
 * 
 *this file contains the  Registration control class,
 *
 */

namespace Control;

require_once './Classes/View/Main.php';
require_once './Classes/Foundation/Subject.php';
require_once './Classes/Foundation/DegreeCourse.php';

/**
 * It is the Registration control class
 * 
 * It control the registration of a new user
 *
 */
class Registration
{
	private $maxCharsAllowed;
	
	/**
	 * 
	 * inizialize all the class variable
	 */
	public function __construct()
	{
		$this->maxCharsAllowed = array("name" => 30,
								"surname" => 30,
								"username" => 30,
								"password" => 30,
								"email" => 30,
								"degreeCourse" => 30);		
	}
	
	/**
	 * Function handleRegistration
	 * 
	 *It Handles the behaviour of the Registration controller.
	 * 
	 * @return string Rendered template output
	 */
	public function handleRegistration()
	{
		$mainView = \Utility\Singleton::getInstance("\View\Main");
		
		switch($mainView->get('registrationAction'))
		{
			case 'getRegistrationPage':
				$ajaxData = $this->getRegistrationForm();
				break;
			
			case 'addNewUser':
				$ajaxData = $this->addNewUser();
				break;
				
			case 'checkUsername':		
				$username = $mainView->get('usernameInserted');
				$data = array("usernameExists" => $this->checkUsername($username));		
				$ajaxData = json_encode($data); 
				break;
		}
		
		return $ajaxData;
	}
	
	/**
	 * Function getRegistrationForm
	 * 
	 *It Gets the registration form
	 * 
	 * @return string Rendered template output
	 */
	public function getRegistrationForm()
	{		
		$registrationPage = \Utility\Singleton::getInstance("\View\Main");
		$degreeCourseDb = new \Foundation\DegreeCourse();
		$degreeCourses = $degreeCourseDb->getDegreeCourses();
		$registrationPage->assign('degreeCourses',$degreeCourses);
		
		return $registrationPage->fetch('registration.tpl');
	}
	
	/**
	 * fucntion addNewUser
	 * 
	 *  It takes the form's fields from the user form and create an Entity\User with these details and
	 *  after tries to store it into the database.
	 *
	 *  @return string Rendered template output
	 */
	public function addNewUser()
	{
		$elaboratedForm = \Utility\Singleton::getInstance("\View\Main");
		
		$name = $elaboratedForm->get('nameUser');
		$surname = $elaboratedForm->get('surname');
		$username = $elaboratedForm->get('username');
		
		// NOT SUPPORTED IN PHP 5.3.x
		//$password = password_hash($elaboratedForm->get('password'), PASSWORD_DEFAULT);
		$password = md5($elaboratedForm->get('password'));
		$email = $elaboratedForm->get('email');
		$degreeCourse = $elaboratedForm->get('degreeCourse');
		
		$user= new \Entity\User($name, $surname, $username, $password , $email, $degreeCourse,0);
		//var_dump($user);
		
		$userDb= new \Foundation\User();
		
		if($userDb->getByUsername($username)==false) // if the username is not already taken
		{
			if($userDb->store($user))
			{
				$elaboratedForm->assign('user',$user);
				$elaboratedForm->assign('error',false); 
			}
			else
			{
				$elaboratedForm->assign('error','Error while storing the user on the database');
			}
		}
		else
		{
			$elaboratedForm->assign('error','Username already exist');
		}
				
		return $elaboratedForm->fetch('registrationResult.tpl');
	}
	
	/**
	 * function validateRegistrationFormData
	 * 
	 * It Checks the validity of the registration values.
	 * 
	 * @return bool 
	 */
	private function validateRegistrationFormData()
	{
		$valid = false;
		$registrationForm = \Utility\Singleton::getInstance('\View\Main');
		
		$name = $registrationForm->get('nameUser');
		$surname = $registrationForm->get('surname');
		$email = $registrationForm->get('email');
		$username = $registrationForm->get('username');
		$password = $registrationForm->get('password'); 
		$degreeCourse = $registrationForm->get('degreeCourse');
		
		if(!empty($name) && strlen($name) <= $this->maxCharsAllowed['name'] &&
		   !empty($surname) && strlen($surname) <= $this->maxCharsAllowed['surname'] && 
		   !empty($email) && strlen($email) <= $this->maxCharsAllowed['email'] &&
		   !empty($username) && strlen($username) <= $this->maxCharsAllowed['username'] &&
		   !empty($password)&& strlen($password) <= $this->maxCharsAllowed['password'] && 
		   !empty($degreeCourse) && strlen($degreeCourse) <= $this->maxCharsAllowed['degreeCourse'])
		{
			$valid = true;
		}
		
		return $valid;		
	}	
	
	/**
	 * function checkUsername
	 * 
	 * Checks the validity of the registration values.
	 *
	 * @return bool
	 * @param String @username
	 */
	private function checkUsername($username)
	{
		$userDb= new \Foundation\User();
		
		$usernameAlreadyTaken = false;
		
		if($userDb->getByUsername($username)==false) // if the username is not already taken
			$usernameAlreadyTaken = false;
		else
			$usernameAlreadyTaken = true;
		
		return $usernameAlreadyTaken;
	}
}
