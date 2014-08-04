<?php

/**
 * Starting php file
 * 
 * This is the starting point of the web application.
 * 
 */

require_once './Classes/Utility/Installer.php';

$installer = new \Utility\Installer();

if($installer->testInstallation())
{
	require_once './Classes/Control/Main.php';

	$mainController = new \Control\Main();
}
else
{
	$installer->handleInstallation();
}

?>