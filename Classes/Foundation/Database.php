<?php
/**
 * Foundation Database File
 * 
 * Foundation base class to communicate with a mysql database.
 * 
 * The configuraton parameters are stored in a global variable that is defined in /Configuration Files/databaseConfig.php'.
 */

namespace Foundation;

// Loading of the configuration file.

require_once './Configuration Files/databaseConfig.php';

/**
 * Database Foundation class
 * 
 * Handles the connection to the mysql database, extending the php's mysqli class.
 * 
 */
class Database extends \mysqli
{
	/**
	 * contructor
	 * 
	 * Reads the configuration parameters from the $mysqlConfig (defined in databaseConfig.php) global variable and tries to establish a connection to the database.
	 *
	 */				
	public function __construct() 
	{
		global $mysqlConfig; // this variable is defined in databaseConfig.php

		parent::__construct($mysqlConfig["host"],$mysqlConfig["user"],$mysqlConfig["password"],$mysqlConfig["database"]);    

		if (mysqli_connect_error()) 
		{
			die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
		}						
	}
	
	/**
	 * function associativeArrayQuery
	 * 
	 * Performs a query on the database, returns an associative array containing the results of the query.
	 * 
	 * @param string $q Contains the query to be sended to the database.
	 * @return mixed On success : an associative array that contains all the rows of the query's result. On failure : false.
	 */
	public function associativeArrayQuery($q)
	{
		$result = $this->query($q); 
		
		if ($result!=false) // on query success 
		{
			if($result->num_rows != 0) // if there's at least one row result.
			{
				while ($row = $result->fetch_assoc())  
				{
					$returnArray[] = $row; 
				}
			}
			else // if the query returned an empty result
				$returnArray = array(); // creates an empty array and returns it.
		}
		else // on query failure
		{
			$returnArray = false; 
		}
		
		return $returnArray;
	}

	
	/**
	 * function closeConnection
	 * 
	 * Closes the connection to the database.
	 * 
	 */
	public function closeConnection()
	{
		parent::close();
	}
}

?>
