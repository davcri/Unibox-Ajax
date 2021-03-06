<?php
/**
 * Entity subject File
 * 
 * Contains the definition of the  Subject entity class.
 *
 */

namespace Entity;


/**
 * Entity class Subject
 *  .
 * This class model a subject
 */
class Subject
{
	/**
	*this is the unique identifier of a subject
	*
	* @var int
	*/
	private $code;
	
	/**
	 * This is the Name of the subject.
	 * @var string 
	 */
	private $name;
	
	/**
	 * Constructor.
	 * 
	 * @param string $name
	 * @param string $code
	 */
	public function __construct($name, $code)
	{		
		$this->name = $name;
		$this->code = $code;
	}
		
	/**
	 * function getCode
	 * 
	 * return the code of a subject
	 * 
	 * @return int
	 */
	public function getCode()
	{
		return $this->code;
	}
	
	/**
	*function getName
	*
	*return the name of a subject
	*
	* @return string
	*/
	public function getName()
	{
		return $this->name;
	}
	
	/**
	 * function __toString
	 * 
	 * return the name of a subject
	 * 
	 * @return string
	 */
	public function __toString()
	{
		return $this->name;
	}
	
	/**
	 * function setName
	 * 
	 * this function set the name of a subject
	 * 
	 * @param string $name
	 */
	public function setName($name)
	{
		$this->name = $name;		
	}	
	
	/**
	 * function setCode
	 *
	 * this function set the code of a subject
	 *
	 * @param int $code
	 */
	public function setCode($code)
	{
		$this->code = $code;
	}
	
}

?>