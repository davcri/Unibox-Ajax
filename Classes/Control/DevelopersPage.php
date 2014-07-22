<?php
/**
 * is the file that contain the DevelopersPage controller
 * 
 *
 */
namespace Control;

require_once './Classes/View/Main.php';
require_once './Classes/Control/Upload.php';
require_once './Classes/Control/Navigation.php';
require_once './Classes/Utility/Session.php';
require_once './Classes/Foundation/User.php';

/**
 *is the developer's page controller, every request passes through it
 *and it manages these request and call the respective controller 
 * 
 */
class DevelopersPage
{
	public function __construct(){
		
	}
	
	public function controlDevelopersPage(){
		$mainView = \Utility\Singleton::getInstance("\View\Main");
		return $mainView->fetch('developersPage.tpl');
	}
}

