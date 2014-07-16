<?php
/**
*this file contains the Profile class,
*
*/

namespace Control;

global $projectDirectory;

require_once $projectDirectory.'/Classes/View/Navigation.php';
require_once $projectDirectory.'/Classes/Foundation/Resource.php';
require_once $projectDirectory.'/Classes/Entity/Resource.php';
require_once $projectDirectory.'/Classes/Foundation/Subject.php';
require_once $projectDirectory.'/Classes/Utility/Singleton.php';
require_once $projectDirectory.'/Classes/Foundation/User.php';

/**
 * it is the profile control class,
 *
 *
 */
class Profile
{
	public function __construct()
	{	
	}
	
	public function controlProfile(){
		$profilePage = \Utility\Singleton::getInstance('\View\Home');
		
		switch($profilePage->get('profileAction'))
		{	
			case 'getProfilePage':
				$data=$this->setProfileInformation();
				break;
			case 'rateUser':
				$data=$this->rateUser();
				break;
		}
		return $data;
	}
	
	public function setProfileInformation(){
		$userSession = \Utility\Singleton::getInstance("\Control\Session");
		$username=$userSession->get('username');
		$view = \Utility\Singleton::getInstance("\View\Home");
		$this->setUserInformations($view,$username);
		$this->setResourcesUploaded($view,$username);
		return $view->fetch('profile.tpl');
	}
	
	public function setUserInformations($view,$username){
		$userDb=new \Foundation\User();
		$user=$userDb->getByUsername($username);
		$view->assign('username',$user->getUsername());
		$view->assign('name',$user->getName());
		$view->assign('surname',$user->getsurname());
		$view->assign('email',$user->getEmail());
		$view->assign('degreeCourse',$user->getDegreeCourse());
		$view->assign('votazione',$user->getReliability());
	}
	
	public function setResourcesUploaded($view,$username){
		$resourceDb=new \Foundation\Resource();
		$resources=$resourceDb-> getResourcesByUser($username);
		$view->assign('resource',$resources);
	}
	
	public function rateUser(){
		
	}
}