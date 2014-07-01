<?php

/**
 * this file contain the definition of view class Registration
*
*/
namespace View;

/**
 *
 * class that manages the registration of a new user
 *
 */
class Registration extends SmartyConfiguration
{
	private $userDetailArray;
	
	private $_value='form';
	
	public function __construct()
	{
		parent::__construct();
		$this->assign('error',FALSE);
	}
	
	/**
	 * returns the name of the user
	 * @return mixed String on success, FALSE on error.
	 */
	public function getName()
	{
		if (isset($_REQUEST['nameUser']))
		{
			return $_REQUEST['nameUser'];
		} else
			return false;
	}
	
	/**
	 * returns the surname of the user
	 * @return mixed String on success, FALSE on error.
	 */
	public function getsurname()
	{
		if (isset($_REQUEST['surname']))
		{
			return $_REQUEST['surname'];
		} else
			return false;
	}
	
	/**
	 * returns the email of the user
	 * @return mixed String on success, FALSE on error.
	 */
	public function getEmail()
	{
		if (isset($_REQUEST['email']))
		{
			return $_REQUEST['email'];
		} else
			return false;
	}
	
	/**
	 * returns the name of the user
	 * @return mixed String on success, FALSE on error.
	 */
	public function getUsername()
	{
		if (isset($_REQUEST['username']))
		{
			return $_REQUEST['username'];
		} else
			return false;
	}
	/**
	 * returns the name of the user
	 * @return mixed String on success, FALSE on error.
	 */
	public function getPassword()
	{
		if (isset($_REQUEST['password']))
		{
			return $_REQUEST['password'];
		} else
			return false;
	}
	/**
	 * returns the name of the user
	 * @return mixed String on success, FALSE on error.
	 */
	public function getCourseDegree()
	{
		if (isset($_REQUEST['courseDegree']))
		{
			return $_REQUEST['courseDegree'];
		} else
			return false;
	}
	
	public function createUserDetailArray()
	{
		$this->userDetailArray['name']=$this->getName();
		$this->userDetailArray['surname']=$this->getSurname();
		$this->userDetailArray['username']=$this->getUsername();
		$this->userDetailArray['password']=$this->getPassword();
		$this->userDetailArray['email']=$this->getEmail();
		$this->userDetailArray['courseDegree']=$this->getCourseDegree();
	
	}
	
	public function getUserDetailArray()
	{
		$this->createUserDetailArray();
	
		return $this->userDetailArray;
	}
	
	public function setTplContent($tpl)
	{
		$this->_value=$tpl;
	}
	
	public function processTemplate()
	{
		$templateSrc='registration_'.$this->_value.'.tpl';
		$contenuto=$this->fetch($templateSrc);
	
		return $contenuto;
	}
	
	
}