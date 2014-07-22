<?php
/**
 * Contains the Installer class which is responsible of setting up the configuration files used by this project
 * 
 */

namespace Utility;

require_once './Classes/View/Home.php';
require_once './Classes/Utility/Singleton.php';

/**
 * Handles the first configuration of the application.
 * 
 * His main task is to check if the application is installed and if it isn't, run a guided installation (via browser).
 */
class Installer
{
	/**
	 * Contains informations about the server software.
	 * 
	 * @var array
	 */
	private $serverDetails;
	
	/**
	 * Contains informations about the this application.
	 * 
	 * @var array
	 */
	private $projectDetails;
	/**
	 * Path to the directory that contains the configuration files.
	 * 
	 * @var string
	 */
	private $configurationDirectory = "./Configuration Files";
	
	/**
	 * Name of the configuration file.
	 * 
	 * @var string
	 */
	private $configurationFile = "databaseConfig.php";
	
	/**
	 * Installer constructor.
	 * 
	 * Gets informations about the server's software.
	 */
	public function __construct()
	{	
		$this->serverDetails = array("phpVersion" => phpversion(),
									 "Server software" => $_SERVER["SERVER_SOFTWARE"],
								     "Upload_max_filesize" => ini_get("upload_max_filesize"));
		
		$this->projectDetails = array("phpVersion" => "5.5.9",
									  "Server software" => "Apache/2.4.7 (Unix) OpenSSL/1.0.1f PHP/5.5.9 mod_perl/2.0.8-dev Perl/v5.16.3",
									  "Upload_max_filesize" => "128M");
	}
	
	/**
	 * Controls the installation navigation.
	 * 
	 * It handles the installation behaviour looking at the GET (POST) request.	 * 
	 */
	public function handleInstallation()
	{
		$installPage = \Utility\Singleton::getInstance("\View\Home");
		
		$installPage_Result = "";
		
		switch($installPage->get("installAction"))
		{
			case "createConfigFile":
				if ($this->formCompleted())
				{
					if ($this->createConfigFile() == false) //error while creating the configuration file
					{
						$installPage_Result = "Error while creating the configuration file";						
					}					
					else
					{
						$installPage_Result = $installPage->fetch("installationCompleted.tpl");
					}
				}					
				else
				{
					$installPage_Result = $this->getForm(true);
				}
				
				break;
			
			default:
				$installPage_Result = $this->getForm(false);
				break;			
		}

		print $installPage_Result;
	}
	
	/**
	 * Checks if the application is installed.
	 * 
	 *  @todo improve this method checking if the configurations parameters are correct.
	 *  @return bool
	 */
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
	
	/**
	 * 
	 * 
	 * @param bool $displayErrorMessage
	 * @return string Rendered template.
	 */
	public function getForm($displayErrorMessage)
	{	
		$installPage = \Utility\Singleton::getInstance("\View\Home");
		
		if($displayErrorMessage)
			$installPage->assign('allFieldsRequired_Error', true); //enable error message
		else
			$installPage->assign('allFieldsRequired_Error', false); //disable error message
		
		$installPage->assign("projectDetails", $this->projectDetails);
		$installPage->assign("serverDetails", $this->serverDetails);
		
		return $installPage->fetch("installPage.tpl");	
	}
	
	/**
	 * Checks if the form is completed.
	 * 
	 * If one of the fields is empty, false is returned.
	 * 
	 * @return bool 
	 */
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
	
	/**
	 * Creates the configuration file.
	 * 
	 * Creates the configuration file from the form data.  
	 * 
	 * @return bool true on success, false if the file cannot be written.
	 */
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
	
	/**
	 * String with info about the Installer object.
	 * 
	 * @return string
	 */
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