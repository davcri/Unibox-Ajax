<?php
/**
 * 
 * Foundation base class to communicate with a mysql database.
 * 
 * The configuraton parameters are stored in a global variable that is defined in /Configuration Files/databaseConfig.php'.
 */

namespace Foundation;

// Loading of the configuration file.

require_once './Configuration Files/databaseConfig.php';

/**
 * 
 * Handles the connection to the mysql database, extending the php's mysqli class.
 * 
 * @todo Exceptions handling (try/catch blocks)
 */
class Database extends \mysqli
{
	/**
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
	 * 
	 * Stores an object in a databaseTable. 
	 *  
	 * This function is very useful but has a drawback : To use this function correctly there must be a one to one correspondence between the object properties and the 
	 * table field names. Moreover the object must have a method called getProperties() that returns an associative array containing the 
	 * couples "key=>value".
	 * 
	 * @param object $object An object that has a public getProperties() method.
	 * @param string $databaseTable The table on which the $object will be stored.
	 * @return mixed 
	 * @todo Doesn't work actually
	 */
	/*public function store($object,$databaseTable)
	{
		$values='';
		$fields='';
		$arr = $object->getProperties();
		$i=0;
		
		foreach ($arr as $key=>$value) 
		{						
			if ($i==0) 
			{
				$fields.='`'.$key.'`';
				$values.='\''.$value.'\'';
			} 
			else 
			{
				$fields.=', `'.$key.'`';
				$values.=', \''.$value.'\'';
			}
			$i++;
		}
				
		$query='INSERT INTO '."`".$databaseTable."`".'('.$fields.') VALUES ('.$values.')';
		print $query ;
		
		return $this->query($query);
	}*/
	
	/**
	 * 
	 * Closes the connection to the database.
	 */
	public function closeConnection()
	{
		parent::close();
	}
}

?>
