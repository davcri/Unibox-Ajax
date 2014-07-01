<?php

namespace Control;

require_once $projectDirectory.'/Classes/Utility/Session.php';
require_once $projectDirectory.'/Classes/Utility/Singleton.php';

class Login
{
	public function __construct()
	{
		$mainView = \Utility\Singleton::getInstance("\View\Home");
		$user = \Utility\Singleton::getInstance("\Control\Session");
		
		$username = $mainView->getUsername();
		$password = $mainView->getPassword();
				
		if($user->validate($username, $password))
		{
			$user->login($username, $password);
			
			$mainView->assign('loggedIn',true);
			$mainView->assign('username',$username);
			$content = $mainView->fetch("signedIn.tpl");
			
			$ajaxReturn = array ('statusCode'=>1,'content'=>$content);
			
			print json_encode($ajaxReturn); // Login ok
			//$ret = array("1");
			//$ret[] = ;
				
				
			//$userDb = new \Foundation\User();
			//$userLoggedIn = $userDb->getByUsername($_SESSION['username']);
				
			//$user->set('degreeCourse', $userLoggedIn->getDegreeCourse());
			//$navigationController=new Navigation($user);
		}
		else
		{
			$content = $mainView->fetch("loginFailed.tpl");
				
			$ajaxReturn = array ('statusCode' => -1,'content' => $content);
			
			print json_encode($ajaxReturn); //Login fallito
		}		
	}
}