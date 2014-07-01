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
	//@todo change the name of this variable
	private $_default='contentDefault';
	private $_defaultDx='default_sidebar';
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get($key)
	{
		return $_REQUEST[$key];		
	}
	
	public function getController()
	{
		if (isset($_REQUEST['controllerAction']))
			return $_REQUEST['controllerAction'];
		else
			return false;		
	}
	
	public function processContentTemplate() 
	{
		$content=$this->fetch('home_'.$this->_default.'.tpl');
		return $content;
	}
	
	public function processContentDxTemplate()
	{
		$content=$this->fetch($this->_defaultDx.'.tpl');
		return $content;
	}
	
	public function getUsername()
	{
		if (isset($_POST['username'])) 
		{
			return $_POST['username'];
		} 
		else
			return false;	
	}
	
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