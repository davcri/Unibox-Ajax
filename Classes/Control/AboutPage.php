<?php
/**
 * AboutPage Controller File
 * 
 *It is the file that contain the aboutPage controller
 */
namespace Control;

require_once './Classes/View/Main.php';
require_once './Classes/Control/Upload.php';
require_once './Classes/Control/Navigation.php';
require_once './Classes/Utility/Session.php';
require_once './Classes/Foundation/User.php';

/**
 *It is the  about's page control class
 * 
 *This class controls the visualization of the about Page of this web application.
 * 
 */
class AboutPage
{
	/**
	 * Empty constructor
	 * 
	 */
	public function __construct()
	{
		
	}
	
	/**
	 * Main function controlAboutPage
	 * 
	 * This function controls the visualization of the about Page.
	 * 
	 * @return string Rendered template output
	 */
	public function controlAboutPage()
	{
		$mainView = \Utility\Singleton::getInstance("\View\Main");
		return $mainView->fetch('aboutPage.tpl');
	}
}
