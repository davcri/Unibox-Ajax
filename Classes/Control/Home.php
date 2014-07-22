<?php
/**
 * is the file that contain the home controller
 * 
 *
 */
namespace Control;
require_once './Classes/View/Main.php';

class Home
{
	public function __construct()
	{	
			
	}
	
	public function controlHome()
	{
		$mainView = \Utility\Singleton::getInstance("\View\Main");
		
		$resourceDb = new \Foundation\Resource();
		$greatestUsers = $resourceDb->getMostActiveUsers();
		
		$mainView->assign('greatestUsers', $greatestUsers);
		return $mainView->fetch('home.tpl');
	}
}

?>
