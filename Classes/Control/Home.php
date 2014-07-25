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
	public function __construct()
	{	
	}

	/**
	 * Main function controlHome
	 * 
	 * It is the main function that actually controls the homepage
	 */
	public function controlHome()
	{
		$mainView = \Utility\Singleton::getInstance("\View\Main");
		
		$resourceDb = new \Foundation\Resource();
		$greatestUsers = $resourceDb->getMostActiveUsers();
		
		$greatestResources=$resourceDb->getMostDownloaded();

		$mainView->assign('greatestResources',$greatestResources);
		$mainView->assign('greatestUsers', $greatestUsers);
		return $mainView->fetch('home.tpl');
	}
}

?>
