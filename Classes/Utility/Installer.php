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
				{
					if ($this->createConfigFile() == false) //error while creating the configuration file
					{
						print "error while creating the configuration file";						
					}					
					else
					{
						$installPage->display("installationCompleted.tpl");
					}
				}					
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
		$installPage = \Utility\Singleton::getInstance("\View\Home");
		
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
		$confiFileCreated = false;
		
		$configFileTemplate = $this->configurationDirectory."/"."databaseConfig.example.php";
		
		$templateContent =  file_get_contents($configFileTemplate);
		$templateContent = "<?php\n".$templateContent;
		
		
		$installPage = \Utility\Singleton::getInstance("\View\Home");
		
		$user = $installPage->get("user");
		$password = $installPage->get("password");
		$host = $installPage->get("host");
		$database = $installPage->get("databaseName");
		
		
		$processedTemplate = str_replace("your_user", $user, $templateContent);
		$processedTemplate = str_replace("your_password", $password, $processedTemplate);
		$processedTemplate = str_replace("your_host", $host, $processedTemplate);
		$processedTemplate = str_replace("your_database_name", $database, $processedTemplate);
		
		$configFile = fopen($this->configurationDirectory."/"."databaseConfig.php", "w");
		
		if($configFile!=false)
		{
			fwrite($configFile, $processedTemplate);
			fclose($configFile);
			
			$confiFileCreated = true;
		}
		
		
		return $confiFileCreated;
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