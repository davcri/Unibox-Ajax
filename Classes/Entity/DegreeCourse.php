<?php
/**
 * Entity DegreeCourse file
 *
 * Contains the definition of the DegreeCourse entity class.
 */

namespace Entity;
/**
 * Entity class DegreeCourse
 *
 * This class model a Degree Course.
 *
 */
class DegreeCourse
{
	/**
	 * this is the name of a Degree Course
	 * @var String
	 */
	private $name;
	/**
	 * this is the name of a Departement
	 * @var int
	 */
	private $department;
	
	/**
	 * function constructor
	 * 
	 * it creates a new courseDegree
	 * 
	 * @param String $name
	 * @param String $department
	 */
	public function __construct($name,$department)
	{
		$this->name = $name;
		$this->department = $department;		
	}
	
	/**
	 * function getName
	 * 
	 * return the name of a degreecourse
	 * 
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}
	/**
	 * function getDepartement
	 *
	 * return the Departement name of a degreecourse
	 *
	 * @return string
	 */
	
	public function getDepartment()
	{
		return $this->department;
	}
	
	/**
	 * function setName
	 *
	 * set the name of a Degre Course
	 *
	 * @param string 
	 */
	
	public function setName($name)
	{
		$this->name = $name;
	}
	
	/**
	 * function setDepartement
	 *
	 * set the Departement name of a degreecourse
	 *
	 * @param string
	 */
	public function setDepartment($department)
	{
		$this->department = $department;
	}		
}

?>