<?php
/**
 * 
 * 
 *
 */

namespace Utility;

require_once './Classes/View/Home.php';
require_once './Classes/Utility/Singleton.php';

/**
 * 
 * 
 *
 */
class Installer
{
	/**
	 * 
	 * @var array
	 */
	private $serverDetails;
	
	/**
	 * 
	 * @var array
	 */
	private $projectDetails = array("phpVersion" => "5.5.9");
	
	private $configurationDirectory = "./Configuration Files";
	
	private $configurationFile = "databaseConfig.php";
	
	public function __construct()
	{
		$this->serverDetails = array("phpVersion" => phpversion());
	}
	
	public function handleInstallation()
	{
		$installPage = \Utility\Singleton::getInstance("\View\Home");
		
		switch($installPage->get("installAction"))
		{
			case "createConfigFile":
				if ($this->formCompleted())
					$this->createConfigFile();
				else
				{
					$this->getForm(true);
				}
				
				break;
			
			default:
				$this->getForm(false);
				break;			
		}		
	}
	
	public function testInstallation()
	{
		$configurationCompleted = false;
		$configFile = $this->configurationDirectory."/".$this->configurationFile;
		
		if(file_exists($configFile))
		{
			$configurationCompleted = true;
		}
		
		return $configurationCompleted;	
	}
	
	public function getForm($displayErrorMessage)
	{	
		$installPage = \Utility\Singleton::getInstance("\View\SmartyConfiguration");
		
		if($displayErrorMessage)
			$installPage->assign('allFieldsRequired_Error', true); //enable error message
		else
			$installPage->assign('allFieldsRequired_Error', false); //disable error message
		
		$installPage->assign("projectDetails", $this->projectDetails);
		$installPage->assign("serverDetails", $this->serverDetails);
		
		$installPage->display("installPage.tpl");	
	}
	
	public function formCompleted()
	{
		$formCompleted = false;
		
		$installPage = \Utility\Singleton::getInstance("\View\Home");
		
		$user = $installPage->get("user");
		$passw = $installPage->get("password");
		$host = $installPage->get("host");
		$databaseName = $installPage->get("databaseName");
		
		if(!empty($user) && !empty($passw) && !empty($host) && !empty($databaseName))
			$formCompleted = true;
		
		return $formCompleted;
	}
	
	public function createConfigFile()
	{
		print "work in progress";
		//todo
	}
	
	public function __toString()
	{	
		print "Server info : <br>";
		foreach($this->serverDetails as $key => $value)
		{
			print "$key => $value <br>";
		}
		
		print "<br>";
		print "Unibox Aq project info : <br>";
		foreach($this->projectDetails as $key => $value)
		{
			print "$key => $value <br>";
		}
	}
}