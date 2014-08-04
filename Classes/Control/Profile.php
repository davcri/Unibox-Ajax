<?php
/**
* It is the Control Profile File 
*
* This file contains the Profile control class
*
*/

namespace Control;

require_once './Classes/View/Main.php';
require_once './Classes/Foundation/Resource.php';
require_once './Classes/Entity/Resource.php';
require_once './Classes/Foundation/Subject.php';
require_once './Classes/Utility/Singleton.php';
require_once './Classes/Foundation/User.php';

/**
 * It is the profile control class
 * 
 * This class controls the profile page's behaviour
 */
class Profile
{
	/**
	 * Empty constructor.
	 * 
	 */
	public function __construct()
	{	
		
	}
	/**
	 * This is the main function cotrolProfile
	 * 
	 * It swhitches to others fuction that controls all possible cases in the profile page 
	 * 
	 * @return string Rendered template output
	 */
	public function controlProfile(){
		$profilePage = \Utility\Singleton::getInstance('\View\Main');
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
	/**
	 * This is a function SetProfileInformation.
	 * 
	 * Sets all user's informations 
	 * 
	 * @return string Rendered template output
	 */
	public function setProfileInformation()
    {
        $view = \Utility\Singleton::getInstance("\View\Main");
		$username=$view->get('userProfile');
		$this->getUserInformations($view,$username);
		$this->setResourcesUploaded($view,$username);
		return $view->fetch('profile.tpl');
	}
	
	/**
	 * This is the function getUserInformations
	 * 
	 * This function get the informations of a given user
	 * It also controls if the user is watching his profile page or an other one profile page
	 * 
	 * @param \View\Main $view
	 * @param String $username
	 */
	public function getUserInformations($view,$username)
    {
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
	
	/**
	 * This is a function setResourcesUploaded
	 * 
	 * This function set all resources uploaded by give user
	 * 
	 * @param \View\Main $view
	 * @param String $username
	 */
	public function setResourcesUploaded($view,$username)
    {
		$resourceDb=new \Foundation\Resource();
		$resources=$resourceDb-> getResourcesByUser($username);
		$view->assign('resource',$resources);
	}
    
	/**
	 * Votes a user.
	 *
	 * Votes a user, checking if the voting user hasn't yet voted the other user. 
	 * 
	 * @return string $votation
	 */
	public function rateUser()
    {
		$userSession = \Utility\Singleton::getInstance("\Control\Session");
		$userLog = $userSession->get('username');
		$user = new \Foundation\User();
		$view = \Utility\Singleton::getInstance("\View\Main");
		$username=$view->get('userProfile');
		
		$hasAlreadyRated=$this->hasVoted($username, $userLog);
		$vote=$view->get('vote');
		
        if(!$hasAlreadyRated)
            {			
                $votation=$user->usersVotation($username, $userLog, $vote);
                $reliabilityVotes = $user->getNumberOfReliabilityVotes($username);
             
                $user2=$user->getByUsername($username);
                $user2->updateReliabilityScore($reliabilityVotes,$vote);
             
                $isUpdated=$user->updateReliabilityScore($username,$user2->getReliability());

                return $votation; /**  @todo add a return for the else statement*/
		}
        // else return something
	}
	
	/**
	 * Checks if a user has been voted.
	 * 
	 * Controls if a userLogged has already voted another user 
	 * 
	 * @param String $username
	 * @param String $userLog
	 * 
	 * @return bool
	 */
	public function hasVoted($username, $userLog)
    {
		$user = new \Foundation\User();
        
		return $user->hasBeenRated($username, $userLog);
	}
}
