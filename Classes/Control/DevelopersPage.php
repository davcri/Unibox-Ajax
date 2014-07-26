<?php
/**
 * DevelopersPage Controller File
 * 
 * It is the file that contain the DevelopersPage controller
 */
namespace Control;

require_once './Classes/View/Main.php';
require_once './Classes/Control/Upload.php';
require_once './Classes/Control/Navigation.php';
require_once './Classes/Utility/Session.php';
require_once './Classes/Foundation/User.php';

/**
 *It is the DevelopersPage control class
 * 
 *This class controls the visualization of the developersPage of this web application.
 * 
 */
class DevelopersPage
{
	/**
	 * Empty constructor
	 */
	public function __construct()
	{
		
	}
	
	/**
	 * Main Function controlDevelopersPage
	 * 
	 * This function controls the visualization of the developersPage.
	 * 
	 * @return string Rendered template output
	 */
	public function controlDevelopersPage(){
		$mainView = \Utility\Singleton::getInstance("\View\Main");
		return $mainView->fetch('developersPage.tpl');
	}
}

