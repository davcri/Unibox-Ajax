<?php
/**
 * Contains the definition of the  Subject entity class.
 *
 */

namespace Entity;

//use Control\DegreeCourse;

/**
 * Enter description here ...
 *
 */
class Subject
{
	/**
	*
	* @var int
	*/
	private $code;
	
	/**
	 * Name of the subject.
	 * @var string 
	 */
	private $name;
	
	/**
	 * Constructor.
	 * 
	 * @param string $name
	 * @param \Entity\DegreeCourse $degreeCourse
	 */
	public function __construct($name, $code)
	{		
		$this->name = $name;
		$this->code = $code;
	}
		
	/**
	 * 
	 * @return int
	 */
	public function getCode()
	{
		return $this->code;
	}
	
	/**
	*
	* @return string
	*/
	public function getName()
	{
		return $this->name;
	}
	
	/**
	 * 
	 * @return string
	 */
	public function __toString()
	{
		return $this->name;
	}
	
	/**
	 * 
	 * @param string $name
	 */
	public function setName($name)
	{
		$this->name = $name;		
	}	
	
	public function setCode($code)
	{
		$this->code = $code;
	}
	
}

?>