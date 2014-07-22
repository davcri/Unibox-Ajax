<?php
/**
 * is the file that contain the home controller
 * 
 *
 */
namespace Control;

require_once './Classes/View/Main.php';
require_once './Classes/Control/Home.php';
require_once './Classes/Control/Navigation.php';
require_once './Classes/Control/Resource.php';
require_once './Classes/Control/Upload.php';
require_once './Classes/Control/Login.php';
require_once './Classes/Control/Profile.php';
require_once './Classes/Control/DevelopersPage.php';
require_once './Classes/Control/AboutPage.php';
require_once './Classes/Utility/Session.php';
require_once './Classes/Foundation/User.php';
require_once './Classes/Utility/Singleton.php';

/**
 *is the main project controller, every request passes through it
 *and it manages these request and call the respective controller 
 * 
 */
class Main
{
	/**
	 * switches the control of the request to the control class expertise
	 * the first time that is called it show the homepage
	 */
	public function __construct()
	{		
		$userSession = \Utility\Singleton::getInstance("\Control\Session");
		$mainView = \Utility\Singleton::getInstance("\View\Main");
		
		if ($userSession->isLoggedIn())
		{
			$mainView->assign('loggedIn',true);
			$mainView->assign('username',$userSession->get('username'));
		}	
		else
			$mainView->assign('loggedIn',false);
		
		$controllerAction= $mainView->getController();		
		
		switch($controllerAction)
		{
			case 'home':
				$home = new \Control\Home();
				$ajaxData = $home->controlHome();
				print $ajaxData;
				break;
			case 'navigation':
				$navigation = new \Control\Navigation();	
				$ajaxData=$navigation->controlNavigation();
				print $ajaxData;	
				break;
			
			case 'resource':
				$resourceController = new \Control\Resource();
				$ajaxData=$resourceController->controlResource();
				print $ajaxData;
				break;
				
			case 'upload':
				$upload = new \Control\Upload();
				$ajaxData = $upload->handleUpload();
				print $ajaxData;
				break;
				
			case 'profile':
		  		$profile = new \Control\Profile();
		  		$ajaxData=$profile->controlProfile();
		  		print $ajaxData;
	
			  	break;
				
			case 'login':
				$login = new \Control\Login();	
				break;
			
			case 'logout':
				$userSession->logout();
				$mainView->assign('loggedIn',false);
				$mainView->display('loginForm.tpl');				
				break;	

			case 'registration':
				$reg = new Registration();
				$ajaxData = $reg->handleRegistration();
				print $ajaxData;
				break;
				
			case 'getDevelopersPage':
				$ourPage=new DevelopersPage();
				$ajaxData=$ourPage->controlDevelopersPage();
				print $ajaxData;
				break;
				
			case 'getAboutPage':
				$about=new AboutPage();
				$ajaxData=$about->controlAboutPage();
				print $ajaxData;
				break;
			default:
				$resourceDb = new \Foundation\Resource();
				$greatestUsers = $resourceDb->getMostActiveUsers();
				$mainView->assign("greatestUsers",$greatestUsers);
				$mainView->display("main.tpl");
				break;
		}
	}	
}

?>
