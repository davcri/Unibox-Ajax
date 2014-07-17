<?php

/**
 * This should be the starting point of the web application.
 * 
 */

global $projectDirectory; // Definition of a global variable used to avoid absolute paths in future include paths.
$projectDirectory = dirname($_SERVER['SCRIPT_FILENAME']); // $projectDirectory contains the path to this file. 

require_once $projectDirectory.'/Classes/Control/Home.php';

$mainController = new \Control\Home();
?>