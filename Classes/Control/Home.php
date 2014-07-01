<?php
/**
 * is the file that contain the home controller
 * 
 *
 */
namespace Control;

require_once $projectDirectory.'/Classes/View/Home.php';
require_once $projectDirectory.'/Classes/Control/Upload.php';
require_once $projectDirectory.'/Classes/Control/Navigation.php';
require_once $projectDirectory.'/Classes/Control/Login.php';
require_once $projectDirectory.'/Classes/Utility/Session.php';
require_once $projectDirectory.'/Classes/Foundation/User.php';
require_once $projectDirectory.'/Classes/Utility/Singleton.php';

/**
 *is the main project controller, every request passes through it
 *and it manages these request and call the respective controller 
 * 
 */
class Home
{
	/**
	 * switches the control of the request to the control class expertise
	 * the first time that is called it show the homepage
	 */
	public function __construct()
	{		
		$userSession = \Utility\Singleton::getInstance("\Control\Session");
		$mainView = \Utility\Singleton::getInstance("\View\Home");
		
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
				$mainView->display('home.tpl');
				break;
				
			case 'navigation':
				$navigation = new \Control\Navigation();		
				break;

			case 'upload':
				$upload = new \Control\Upload();
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
				$reg->handleRegistration();
				break;
				
			default:
				$mainView->display('main.tpl');
				break;
		}				
		
		
		/*$controllerAction= $viewHome->getController();
		
		if($controllerAction) // if an action is defined 
		{
			switch($controllerAction)
			{
				case 'registration':
					$reg=new Registration();
					$content=$reg->handleRegistration();
					$contentDx=$viewHome->processContentDxTemplate();
					break;
					
				case 'upload':
					if ($user->isLoggedIn())
					{	
						$uploadController = new Upload($user->get("username"));
						
						$content=$uploadController->handleUpload();
						$contentDx=$viewHome->processContentDxTemplate();
					}
					else
					{
						//@todo here we should show a login page or something like that.
						$content="You are not logged in. Only registered users can upload files.";
						$contentDx=$viewHome->processContentDxTemplate();
					}						
					break;
					
				case 'navigation':
					$navigationController=new Navigation($user);
					$contentArray=$navigationController->controlNavigation();
					$content=$contentArray[0];
					$contentDx=$contentArray[1];
					break;
				
				case 'rateResource':
					$rateController = new Navigation($user);
					$rateController->rateResource();
					
					break;
					
				case 'login':
					if($user->validate($viewHome->getUsername(), $viewHome->getPassword()))
					{
						$user->login($viewHome->getUsername(), $viewHome->getPassword());
						$viewHome->assign('loggedin',true);
						
						$userLogged=new \Foundation\User();
						$userLoggedIn=$userLogged->getByUsername($_SESSION['username']);
						//@todo fix this ! 
						$user->set('degreeCourse', $userLoggedIn->getDegreeCourse());
						$navigationController=new Navigation($user);
						$contentArray=$navigationController->controlLoginNavigation();
						$content=$contentArray[0];
						$contentDx=$contentArray[1];				
					}
					else
					{
						$content="Incorrect username or password.";
						$contentDx=$viewHome->processContentDxTemplate();
					}											
					break;
									
				case 'logout':
					$user->logout();
					$viewHome->assign('loggedin',false);
					
					//@todo here I load the default content. This should be discussed.
					$content=$viewHome->processContentTemplate();
					$contentDx=$viewHome->processContentDxTemplate();
					break;
			}		
		}
		else // show home page
		{		
			$content=$viewHome->processContentTemplate();
			$contentDx=$viewHome->processContentDxTemplate();					
		}	
			
		$viewHome->assign('contentSx',$content);
		$viewHome->assign('contentDx',$contentDx);*/
		
		
	}	
}

?>
