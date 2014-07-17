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
		$data="";
		//var_dump($data);
		switch($profilePage->get('profileAction'))
		{	
			case 'hasAlreadyVoted':
				$data=$this->hasVoted();
				break;
				
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
		$userLog=$userSession->get('username');
		$view = \Utility\Singleton::getInstance("\View\Home");
		$username=$view->get('userProfile');
		$this->setUserInformations($view,$username,$userLog);
		$this->setResourcesUploaded($view,$username,$userLog);
		return $view->fetch('profile.tpl');
	}
	
	public function setUserInformations($view,$username,$userLog){
		$userDb=new \Foundation\User();
		$user=$userDb->getByUsername($username);
		$view->assign('username',$user->getUsername());
		$view->assign('name',$user->getName());
		$view->assign('surname',$user->getsurname());
		$view->assign('email',$user->getEmail());
		$view->assign('degreeCourse',$user->getDegreeCourse());
		$view->assign('votazione',$user->getReliability());
		if( $username == $userLog){
			$infoVote='Ecco il tuo punteggio affidabilitá';
			
		}
		else
		{
			$infoVote=$this->hasVoted($username,$userLog);
		}
		$view->assign('hasVoted',$infoVote );
	}
	
	public function setResourcesUploaded($view,$username){
		$resourceDb=new \Foundation\Resource();
		$resources=$resourceDb-> getResourcesByUser($username);
		$view->assign('resource',$resources);
	}
	
	public function rateUser(){
		$userSession = \Utility\Singleton::getInstance("\Control\Session");
		$userLog=$userSession->get('username');
		$user=new \Foundation\User();
		$view = \Utility\Singleton::getInstance("\View\Home");
		$username=$view->get('userProfile');
		//print_r($username);
		$hasAlreadyRated=$this->hasVoted($username,$userLog);
		$vote=$view->get('vote');
		if(!$hasAlreadyRated){
			//print_r('sto provando a caricare');
			return $user->usersVotation($username, $userLog, $vote);
		}
		
	}
	public function hasVoted($username,$userLog){
		//$view = \Utility\Singleton::getInstance("\View\Home");
		//$userSession = \Utility\Singleton::getInstance("\Control\Session");
		//$voter=$userSession->get('username');
		//$voted=$_REQUEST['user'];
		$user=new \Foundation\User();
		return $user->hasBeenRated($username, $userLog);

	
	}
}