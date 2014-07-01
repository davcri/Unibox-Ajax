<?php
/**
 * Contains the definition of the Registration utility class 
 * 
 *
 */

namespace Control;

require_once $projectDirectory.'/Classes/Foundation/User.php';

/**
 * Utility class used to handle login and logout using PHP sessions. For details : http://www.php.net/manual/en/intro.session.php
 * 
 * @todo : Maybe we should change the name of this class ? 
 */
class Session
{	
	/**
	 * Lifetime of the session (cookie) in seconds.
	 * 0 means at the end of the session. In example : when closing the browser.
	 * 
	 * @var int
	 */
	private $lifetime;
	
	/**
	 * Initializes the session or resumes it.
	 * 
	 * @todo add a parameter to modify lifetime.
	 */
	public function __construct()
	{
		$this->lifetime = 60*60*24; // 1 day
		
		session_start();
		
		/* Overwriting of the cookie created by session_start().*/
		setcookie(session_name(),session_id(),time()+$this->lifetime,"/");
		/* 
		 * This is needed to update (on page refresh) the expiration date of a valid cookie.
		 *
		 * Example : cookie with a lifetime of 30 minutes.
		 * -> at 17:00 cookie created (expire date : someday at 17:30)
		 * -> at 17:05 page refreshed (expire date : someday at 17:35).
		 *    without setcookie() the expiration date would not be changed
		 */
	}
	
	/**
	 * Stores a value in an associative array. This values can be reused in all the duration of the session.
	 *  
	 * @todo this method shouldn't be in Registration class.
	 * @param mixed $key 
	 * @param mixed $value
	 */
	public function set($key, $value)
	{
		$_SESSION[$key]=$value;		
	}
	
	/**
	 * Gets a value saved in the session corresponding to the key passed.
	 * 
	 * @param mixed $key
	 * @return mixed
	 */
	public function get($key)
	{
		return $_SESSION["$key"];
	}
	
	/**
	 * Gets the current logged in user.
	 * 
	 * If there is a session, returns an \Entity\User
	 * 
	 * @return \Entity\User
	 */
	/*public function getUser()
	{
		if($this->isLoggedIn())
		{
			$username = $_SESSION["username"];
			$db = new \Foundation\User();
			$user = $db->getByUsername($username);
		}
		else
		{
			print "error";
			$user = null;
		}
		
		return $user;
	}*/
	
	/**
	 * Checks if the user is logged in.
	 * 
	 * It checks the $_SESSION variable, if it contains the correct user and password (according 
	 * to the User table of the application database), then the user is logged in.
	 * 
	 * @return bool 
	 */
	public function isLoggedIn()
	{
		$loggedIn = false;
		
		if(isset($_SESSION["username"]) && isset($_SESSION["password"])) 
		{
			$username = $_SESSION["username"];
			$pass = $_SESSION["password"];

			if ($this->validate($username, $pass))
				$loggedIn = true;
		}
		
		return $loggedIn;
	}
	
	/**
	 * Removes the data of the session frome the server's file system.
	 * 
	 * @todo The file is truncated (to 0 byte) but it is not deleted from the file system. I think that the garbage collector
	 * should handle this.
	 */
	public function logout()
	{
		unset($_SESSION["username"]);
		unset($_SESSION["password"]);
		unset($_SESSION["degreeCourse"]);
	}
	
	/**
	 * Logs a user in for the lifetime of the session.
	 * 
	 * @param string $username
	 * @param string $password
	 */
	public function login($username,$password)
	{
		$this->set("username",$username);
		$this->set("password",$password);
	}
	
	/**
	 * Validates logins data comparing with the one founded on the application database. 
	 * 
	 * @param string $username
	 * @param string $password
	 */
	public function validate($username,$password)
	{
		$userDb = new \Foundation\User();
		$user = $userDb->getByUsername($username);
			
		if($user!=false && $user->getPassword()==$password) // If exists a user and the password matches
		{
			$validity = true;
		}
		else
			$validity = false;
		
		return $validity;
	}					
}

?>