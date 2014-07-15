<?php
/**
 *this file contains the Registration class,
 *
 */

namespace Control;

global $projectDirectory;
require_once $projectDirectory.'/Classes/View/Registration.php';
require_once $projectDirectory.'/Classes/View/Navigation.php';
//require_once $projectDirectory.'/Classes/Entity/Resource.php';
require_once $projectDirectory.'/Classes/Foundation/Subject.php';
require_once $projectDirectory.'/Classes/Foundation/DegreeCourse.php';

/**
 * it is the Registration control class, it manages the registration of a new user
 *
 */
class Registration
{
	public function handleRegistration()
	{
		if($this->validateRegistrationFormData() == FALSE)
		{
			$this->getRegistrationForm();
		}
		else
		{
			$this->addNewUser();
		}
	}
	
	public function getRegistrationForm()
	{		
		$registrationPage = \Utility\Singleton::getInstance("\View\Home");
		$degreeCourseDb = new \Foundation\DegreeCourse();
		$degreeCourses = $degreeCourseDb->getDegreeCourses();
		$registrationPage->assign('degreeCourses',$degreeCourses);
		
		$registrationPage->display('registration.tpl');
	}
	
	/**
	 *  It takes the form's fields from the user form and create an Entity\User with these details and
	 *  after stores it into the database.
	 *
	 *  
	 */
	public function addNewUser()
	{
		$elaboratedForm = \Utility\Singleton::getInstance("\View\Home");
		
		$name = $elaboratedForm->get('nameUser');
		$surname = $elaboratedForm->get('surname');
		$username = $elaboratedForm->get('username');
		$password = $elaboratedForm->get('password');
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
				
		$elaboratedForm->display('registrationResult.tpl');
	}
	
	private function validateRegistrationFormData()
	{
		$valid = false;
		
		if(!empty($_REQUEST['nameUser']) && 
		   !empty($_REQUEST['surname']) && 
		   !empty($_REQUEST['email']) && 
		   !empty($_REQUEST['username']) && 
		   !empty($_REQUEST['password'])&& 
		   !empty($_REQUEST['degreeCourse']))
		{
			$valid = true;
		}
		
		return $valid;		
	}	
}
