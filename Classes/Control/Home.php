<?php
/**
 * Home Controller File
 * 
 * It is the file that contain the home controller
 */
namespace Control;
require_once './Classes/View/Main.php';

/**
 *It is the home control class, 
 * 
 *It controls the homepage's behaviour, 
 *like the visualization of the most active users, and the most downloaded resources
 *
 */
class Home
{
	/**
	 * Empty constructor.
	 */
	public function __construct()
	{	
	}

	/**
	 * Main function controlHome
	 * 
	 * It is the main function that actually controls the homepage
	 * 
	 * @return string Rendered template output
	 */
	public function controlHome()
	{
		$mainView = \Utility\Singleton::getInstance("\View\Main");
		
		$resourceDb = new \Foundation\Resource();
		$greatestUsers = $resourceDb->getMostActiveUsers(3);
		
		$greatestResources=$resourceDb->getMostDownloaded(3);

		$mainView->assign('greatestResources',$greatestResources);
		$mainView->assign('greatestUsers', $greatestUsers);
		
		return $mainView->fetch('home.tpl');
	}
}

?>
