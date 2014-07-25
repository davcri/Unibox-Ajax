<?php
/**
 * Login Controller File
 *
 * It is the file that contain the Login controller
 */
namespace Control;
require_once './Classes/View/Main.php';
require_once './Classes/Utility/Session.php';
require_once './Classes/Utility/Singleton.php';

/**
 *It is then Login control class,
 *
 *It controls the login's behaviour
 */
class Login
{

	public function __construct()
	{
	
	}
	/**
	 *It is the Login control class, 
	 * 
	 *It controls the login's behaviour
	 *
	 *@return json
	 */
	public function controlLogin(){
		$mainView = \Utility\Singleton::getInstance("\View\Main");
		$user = \Utility\Singleton::getInstance("\Control\Session");
		
		$username = $mainView->get("username");
		$password = $mainView->get("password");
		$rememberMe = $mainView->get("rememberMe"); // rememberMe is a string (I don't understand why
		// javascript send it as a string)
		if ($rememberMe==="true")
			$rememberMe=true;
		elseif($rememberMe==="false")
		$rememberMe=false;
		
		$user->setRememberMe($rememberMe);
		
		if($user->validate($username, $password))
		{
			$user->login($username, $password);
				
			$mainView->assign('loggedIn',true);
			$mainView->assign('username',$username);
			$content = $mainView->fetch("signedIn.tpl");
			$profile_button=$mainView->fetch("profile_button.tpl");
				
			$ajaxReturn = array ('statusCode'=>1, 'content'=>$content, 'profile'=>$profile_button);
				
			$result=json_encode($ajaxReturn); // Login ok
		}
		else
		{
			$content = $mainView->fetch("loginFailed.tpl");
		
			$ajaxReturn = array ('statusCode' => -1,'content' => $content);
				
			$result=json_encode($ajaxReturn); //Login fallito
		}
		return $result;
	}
}