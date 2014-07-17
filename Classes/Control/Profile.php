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
		$view = \Utility\Singleton::getInstance("\View\Home");
		$username=$view->get('userProfile');
		$this->setUserInformations($view,$username);
		$this->setResourcesUploaded($view,$username);
		return $view->fetch('profile.tpl');
	}
	
	public function setUserInformations($view,$username){
		$userSession = \Utility\Singleton::getInstance("\Control\Session");
		if($userSession->isLoggedin()){
			$userLog=$userSession->get('username');
			//$logged=true;
		}
		else 
		{
			$userLog="";
			
			//$logged=false;
		}
		$userDb=new \Foundation\User();
		$user=$userDb->getByUsername($username);
		$view->assign('user',$user);
		
		$view->assign('username',$user->getUsername());
		$view->assign('name',$user->getName());
		$view->assign('surname',$user->getsurname());
		$view->assign('email',$user->getEmail());
		$view->assign('degreeCourse',$user->getDegreeCourse());
		$view->assign('votazione',$user->getReliability());
		if( $username != $userLog){
			if ($userLog=="")// controllo se l'utente non é loggato
			{
				print_r('non sono loggato');
				$yourScore='Ecco il suo punteggio affidabilitá';
				$wantToVote=false;
			}
			else{// siamo nel caso in cui un utente loggato vuole votare un altro utente
				$infoVote=$this->hasVoted($username,$userLog);
				$view->assign('hasVoted',$infoVote );
				$yourScore='Ecco il suo punteggio affidabilitá';
				$wantToVote=true;
			}
		
		}
		else {
			$wantToVote=false;
			$yourScore='Ecco il tuo punteggio affidabilitá';
		}
		
		$view->assign('yourScore',$yourScore);
		$view->assign('wantToVote', $wantToVote);
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
			//$user->usersVotation($username, $userLog, $vote);
			//$reliabilityVotes = $user->get
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
