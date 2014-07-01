<?php
/**
 * this file contain the definition of entity class User
 * 
 */
namespace Entity;
/**
 * 
 * class that contain the definition of a registred user 
 *
 */
class User 
{
	/**
	* the username of the user
	* @var string
	*/
	private $username;
	
	/**
	 * the name of the user
	 * @var string
	 */
	private $name;
	
	/**
	 * the surname of the user
	 * @var string
	 */
	private $surname;
	
	/**
	 * the password of the user
	 * @var string
	 */
	private $password;
	
	/**
	 * the email of the user
	 * @var string
	 */
	private $email;
	
	/**
	 * 
	 * @var float
	 */
	private $reliability;
		
	/**
	 * the degree course of the user
	 * @var string
	 */
	private $degreeCourse;
	
	/**
	 * this is the constructor of a user
	 * @param string $name
	 * @param string $surname
	 * @param string $username
	 * @param string $password
	 * @param string $email
	 * @param string $degreeCourse
	 */
	public function __construct($name, $surname, $username, $password, $email, $degreeCourse, $reliability)
	{
	 	$this->name = $name;
	 	$this->surname = $surname;
	 	$this->username = $username;
	 	$this->password = $password;
	 	$this->email = $email;
	 	$this->degreeCourse = $degreeCourse;
	 	$this->reliability = $reliability;
	 	
	 		
	}
	

	/**
	 * return the name of the user
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
	 * return the surname of the user
	 * @return string
	 */
	public function getSurname()
	{
		return $this->surname;
	}
	
	/**
	 * return the username of the user
	 * @return string
	 */
	public function getUsername()
	{
		return $this->username;
	}
	
	/**
	 * return the password of the user
	 * @return string
	 */
	public function getPassword()
	{
		return $this->password;
	}
	
	/**
	 * return the email of the user
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
	}
	
	/**
	 * return the reliability of the user
	 * @return float
	 */
	public function getReliability()
	{
		return $this->reliability;
	}
	
	/**
	 * return the degree course of the user
	 * @return string
	 */
	public function getDegreeCourse()
	{
		return $this->degreeCourse;
	}
	
	/**
	 * set the name of the user
	 * @param string $name
	 */
	public function setName($name)
	{
		$this->name-$name;
	}
	
	/**
	 * set the surname of the user
	 * @param string $surname
	 */
	public function setSurame($surname)
	{
		$this->surname-$surname;
	}
	
	/**
	 * set the username of the user
	 * @param string $username
	 */
	public function setUserame($username)
	{
		$this->username-$username;
	}
	
	/**
	 * set the password of the user
	 * @param string $password
	 */
	public function setPassword($password)
	{
		$this->password-$password;
	}
	
	/**
	 * set the email of the user
	 * @param string $email
	 */
	public function setEmail($email)
	{
		$this->email=$email;
	}
	
	/**
	 * set the departement name of the user
	 * @param string $departement
	 */
	public function setReliability($reliability)
	{
		$this->reliability=$reliability;
	}
	
	/**
	 * set the degree course of the user
	 * @param string $degreeCourse
	 */
	public function setDegreeCourse($degreeCourse)
	{
		$this->degreeCourse-$degreeCourse;
	}
	
}