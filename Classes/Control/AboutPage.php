<?php
/**
 * is the file that contain the aboutPage controller
 * 
 *
 */
namespace Control;

require_once $projectDirectory.'/Classes/View/Main.php';
require_once $projectDirectory.'/Classes/Control/Upload.php';
require_once $projectDirectory.'/Classes/Control/Navigation.php';
require_once $projectDirectory.'/Classes/Utility/Session.php';
require_once $projectDirectory.'/Classes/Foundation/User.php';

/**
 *is the about's page controller, every request passes through it
 *and it manages these request and call the respective controller 
 * 
 */
class AboutPage
{
	public function __construct(){
		
	}
	
	public function controlAboutPage(){
		$mainView = \Utility\Singleton::getInstance("\View\Main");
		return $mainView->fetch('aboutPage.tpl');
	}
}
