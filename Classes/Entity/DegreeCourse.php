<?php
/**
 * 
 *
 */

namespace Entity;

class DegreeCourse
{
	private $name;
	private $department;
	
	public function __construct($name,$department)
	{
		$this->name = $name;
		$this->department = $department;		
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function getDepartment()
	{
		return $this->department;
	}
	
	public function setName($name)
	{
		$this->name = $name;
	}
	
	public function setDepartment($department)
	{
		$this->department = $department;
	}		
}

?>