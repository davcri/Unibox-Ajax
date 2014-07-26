<?php
/**
 * Entity User File
 * 
 * this file contain the definition of entity class User
 * 
 */
namespace Entity;
/**
 * Entity class User
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
	 * 
	 * this is the constructor of a user
	 * 
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
	 * function getName
	 * 
	 * it returns the name of the user
	 * 
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
	 * function getSurname
	 * 
	 * return the surname of the user
	 * 
	 * @return string
	 */
	public function getSurname()
	{
		return $this->surname;
	}
	
	/**
	 *function getUsername
	 * 
	 *return the username of the user
	 * 
	 * 
	 * @return string
	 */
	public function getUsername()
	{
		return $this->username;
	}
	
	/**
	 * function getPassword
	 * 
	 * return the password of the user
	 * 
	 * @return string
	 */
	public function getPassword()
	{
		return $this->password;
	}
	
	/**
	 *function getEmail
	 * 
	 * return the email of the user
	 * 
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
	}
	
	/**
	 * function getReliability
	 * 
	 * return the reliability of the user
	 * 
	 * @return float
	 */
	public function getReliability()
	{
		return $this->reliability;
	}
	
	/**
	 * function getDegreeCourse
	 * 
	 * return the degree course of the user
	 * 
	 * @return string
	 */
	public function getDegreeCourse()
	{
		return $this->degreeCourse;
	}
	
	/**
	 * function setName
	 * 
	 * set the name of the user
	 * 
	 * @param string $name
	 */
	public function setName($name)
	{
		$this->name-$name;
	}
	
	/**
	 * function setSurname
	 * 
	 * set the surname of the user
	 * 
	 * @param string $surname
	 */
	public function setSurame($surname)
	{
		$this->surname-$surname;
	}
	
	/**
	 * function setUsername
	 * 
	 * set the username of the user
	 * 
	 * @param string $username
	 */
	public function setUsername($username)
	{
		$this->username-$username;
	}
	
	/**
	 * function setPassword
	 * 
	 * set the password of the user
	 * 
	 * @param string $password
	 */
	public function setPassword($password)
	{
		$this->password-$password;
	}
	
	/**
	 * function setEmail
	 * 
	 * set the email of the user
	 *
	 * @param string $email
	 */
	public function setEmail($email)
	{
		$this->email=$email;
	}
	
	/**
	 * function setReliability
	 * 
	 * set the departement name of the user
	 * 
	 * @param string $departement
	 */
	public function setReliability($reliability)
	{
		$this->reliability=$reliability;
	}
	
	/**
	 * function setDegreeCourse
	 * 
	 * set the degree course of the user
	 * 
	 * @param string $degreeCourse
	 */
	public function setDegreeCourse($degreeCourse)
	{
		$this->degreeCourse-$degreeCourse;
	}
	
	/**
	 * function hasBeenRated
	 *
	 * this function control if this user is already voted by a given username
	 *
	 * @param string $username
	 * @return bool
	 */
	public function hasBeenRated($username)
	{
		$db = new \Foundation\Resource();
	
		return $db->hasBeenRated($this->username, $username);
	}
	
	/**
	 * function updateReliabilityScore
	 *
	 * this function update the reliability score of this user, using the old averange votes
	 *
	 * @param int $votes number of votes given to this user
	 * @param int $score  old AVG votes
	 */
	public function updateReliabilityScore($votes, $score)
	{
		// avoiding division by zero
		if($votes==0)
			$votes = 1;
	
		$newAvg = ($this->reliability * ($votes-1) + $score)/$votes;
		$this->reliability= $newAvg;
	}
	
}