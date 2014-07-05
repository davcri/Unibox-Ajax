<?php
/**
 * 
 * Contains a View class that displays the home page.
 *
 */
namespace View;

require_once $projectDirectory.'/Classes/View/SmartyConfiguration.php';

class Home extends \View\SmartyConfiguration
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get($key)
	{
		if (isset($_REQUEST[$key]))
			return $_REQUEST[$key];
		else
			return false;		
	}
	
	public function getFile($key)
	{
		return $_FILES[$key];
	}
	
	//@todo delete this
	public function getController()
	{
		if (isset($_REQUEST['controllerAction']))
			return $_REQUEST['controllerAction'];
		else
			return false;		
	}
	//@todo delete this
	public function getUsername()
	{
		if (isset($_POST['username'])) 
		{
			return $_POST['username'];
		} 
		else
			return false;	
	}
	//@todo delete this
	public function getPassword()
	{
		if (isset($_POST['password']))
		{
			return $_POST['password'];
		} 
		else
			return false;
	}
}
?>