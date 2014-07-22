<?php

namespace Foundation;


require_once './Classes/Foundation/Database.php';
require_once './Classes/Entity/DegreeCourse.php';

class DegreeCourse extends Database
{
	/**
	 * Constructor. Calls the parent constructor to initialize the connection to the database.
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * Stores a degree course on the database. 
	 *  
	 * @param \Entity\DegreeCourse $degreeCourse
	 */
	public function store($degreeCourse)
	{
		$name = '"'.$degreeCourse->getName().'"';
		$department = '"'.$degreeCourse->getDepartment().'"';
		
		$queryString = "INSERT INTO `degreeCourse`(`name`, `department`) VALUES ($name,$department)";
		
		return $this->query($queryString);
	}
	
	/**
	 * Gets a degree course by his name. NOTE : this method assume that 'name' is a primary key for DegreeCourse.
	 * 
	 * @todo Add warning if there is more than one result ! 
	 * @return \Entity\DegreeCourse|bool \Entity\DegreeCourse on success, false if no degreeCourse was found.
	 */
	public function getByName($name)
	{		
		$queryString = "SELECT `name`, `department` FROM `degreeCourse` WHERE name=\"$name\"" ;
		$array = $this->associativeArrayQuery($queryString);
		
		if (count($result)!=0) // we need this because the foreach statement doesn't accept empty array as parameter.	
			$degreeCourse = new \Entity\DegreeCourse($array[0]['name'], $array[0]['department']);
		else
			$degreecourse = false;
		
		return $degreeCourse;
	}
	
	/**
	 * Gets an array containing all the degree courses.
	 * 
	 * @return array
	 */
	public function getDegreeCourses()
	{
		$select = "SELECT *";
		$from = "FROM `degreeCourse`";
		$where = "WHERE 1";
		
		$queryString = $select." ".$from." ".$where;
		$result = $this->associativeArrayQuery($queryString);
		
		if (count($result)!=0) // we need this because the foreach statement doesn't accept empty array as parameter.
		{
			foreach($result as $res)
			{
				$degreeCourses[] = new \Entity\DegreeCourse($res["name"], $res["department"]);
			}
		}
		else
			$degreeCourses = array(); // an empty array
		
		return $degreeCourses;		
	}	
	
	/**
	 * Gets all the subjects of a degree course.
	 * 
	 * @param string $degreeCourseName
	 * @return array
	 * @todo test this method
	 */
	public function getSubjects($degreeCourseName)
	{
		$query = "SELECT `subjectCode` FROM `degreeCourses_Subjects` WHERE `degreeCourse`='$degreeCourseName'";
		$res = $this->associativeArrayQuery($query);
		
		return $res;
	}
}

?>