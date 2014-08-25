<?php
/**
 * Utility Installer File
 * 
 * Contains the Installer class which is responsible of setting up the configuration files used by this project
 * 
 */

namespace Utility;

require_once './Classes/View/Main.php';
require_once './Classes/Utility/Singleton.php';

/**
 * Utility class Installer 
 * 
 * Handles the first configuration of the application.
 * Its main task is to check if the application is installed and if it isn't, run a guided installation (via browser).
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
	 * Contains informations about this application.
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
	 * Name of the database script.
	 * 
	 * @var string
	 */
	private $databaseScriptName = "Unibox_install.sql";
	
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
	 * It handles the installation behaviour looking at the GET (POST) request.
	 */
	public function handleInstallation()
	{
		$installPage = \Utility\Singleton::getInstance("\View\Main");
		
		$installPage_Result = "";
		
		switch($installPage->get("installAction"))
		{
			case "createConfigFile":
				if ($this->formCompleted()) // if all fields are inserted
				{
					if($this->testConfig()) // if the connection parameters are correct
					{
						if ($this->createConfigFile() == false) // if error occurred on creating the configuration file
						{
							$installPage_Result = "Error while creating the configuration file";
						}
						else // everything ok
						{
							if($this->installDatabase())
								$installPage_Result = $installPage->getForm("Errore durante l'installazione del database.");
							else
								$installPage_Result = $installPage->fetch("installationCompleted.tpl");
						}						
					}
					else // bad configuration 
					{
						$installPage_Result = $this->getForm("La configurazione immessa non &egrave valida. Ricontrolla tutti i campi.");
					}					
				}					
				else // some input form field is empty
				{
					$installPage_Result = $this->getForm("Tutti i campi sono obbligatori");
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
	 * Gets installation form.
	 * 
	 * If $errorMessage contains a string, the installPage.tpl will display an error. If $errorMessage 
	 * is false or an empty string, the form is displayed without errors.
	 * 
	 * @param string $errorMessage 
	 * @return string Rendered template.
	 */
	public function getForm($errorMessage)
	{	
		$installPage = \Utility\Singleton::getInstance("\View\Main");
		
		
		$installPage->assign('errorMessage', $errorMessage); //enable error message
		
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
		
		$installPage = \Utility\Singleton::getInstance("\View\Main");
		
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
		
		
		$installPage = \Utility\Singleton::getInstance("\View\Main");
		
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
	
	/**
	 * Tests the database configuration.
	 * 
	 * Gets the form's values and tries to ping the database to test the configuration.
	 * 
	 * @return bool true on success, false on failure
	 */
	public function testConfig()
	{		
		$installPage = \Utility\Singleton::getInstance("\View\Main");
		
		$user = $installPage->get("user");
		$password = $installPage->get("password");
		$host = $installPage->get("host");
		$database = $installPage->get("databaseName");
		
		$db = new \mysqli($host, $user, $password, $database);
		
		return $db->ping();		
	}
	
	/**
	 * Runs the sql installation script.
	 * 
	 * The installation script selected is the one contained in project root with the name $this->databaseScriptName.
	 * (default is $databaseScriptName = "Unibox_install.sql")
	 * 
	 * @todo review this method
	 * @return bool true on success, false on failure
	 */
	public function installDatabase()
	{
		require_once dirname(dirname(__FILE__)).'/Foundation/Database.php';
		
		$database = new \Foundation\Database();

		$databaseCreationScript = file_get_contents(dirname(dirname(dirname(__FILE__)))."/".$this->databaseScriptName);
		
		$error = true;
		if ($databaseCreationScript)
		{
			$database->multi_query($databaseCreationScript);
			$error = false;
		}
        
		$database->close();	
        
		return $error;
	}
}