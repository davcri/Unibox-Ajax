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
			$profile_button=$mainView->fetch("profile_button.tpl");
			
			$ajaxReturn = array ('statusCode'=>1, 'content'=>$content, 'profile'=>$profile_button);
			
			print json_encode($ajaxReturn); // Login ok
		}
		else
		{
			$content = $mainView->fetch("loginFailed.tpl");
				
			$ajaxReturn = array ('statusCode' => -1,'content' => $content);
			
			print json_encode($ajaxReturn); //Login fallito
		}		
	}
}