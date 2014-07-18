<?php
/**
 * is the file that contain the home controller
 * 
 *
 */
namespace Control;


class Home
{
	public function __construct()
	{	
			
	}
	
	public function controlHome()
	{
		$mainView = \Utility\Singleton::getInstance("\View\Home");
		
		$resourceDb = new \Foundation\Resource();
		$greatestUsers = $resourceDb->getMostActiveUsers();
		
		$mainView->assign('greatestUsers', $greatestUsers);
		return $mainView->fetch('home.tpl');
	}
}

?>
