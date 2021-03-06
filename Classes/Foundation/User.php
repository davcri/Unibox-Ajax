<?php
/**
 *
 * Foundation User File
 *
 * Contains the foundation user class that handles the connection and queries to a mysql database.
 *
 */
namespace Foundation;

require_once './Classes/Foundation/Database.php';
require_once './Classes/Entity/User.php';

/**
 * Provides the methods to handle persistence of \Entity\User
 * 
 *
 */
class User extends Database
{
	/**
	 * Constructor
	 * 
	 * Calls the parent constructor to initialize the connection to the database.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Stores a user on the database.
	 *
	 * @param \Entity\User $user
	 * 
	 * @return bool
	 */
	public function store($user)
	{
		$username = '"'.$user->getUsername().'"';
		$name = '"'.$user->getName().'"';
		$surname = '"'.$user->getSurname().'"';
		$password = '"'.$user->getPassword().'"';
		$email = '"'.$user->getEmail().'"';
		$reliability = '"'.$user->getReliability().'"';
		
		if($user->getDegreeCourse()!=NULL)
			$degreeCourse = '"'.$user->getDegreeCourse().'"';
		else
			$degreeCourse = "NULL";
		
		$insert = "INSERT INTO `user`(`username`, `name`, `surname`, `password`, `email`, `degreeCourse`, `reliability`)";
		$values = "VALUES ($username,$name,$surname,$password,$email,$degreeCourse,$reliability)";
		$queryString = $insert." ".$values;

		return $this->query($queryString);
	}
	
	/**
	 * Gets a user by his username. NOTE : this method assume that 'username' is a primary key for User.
	 *
	 * @todo Add warning if there is more than one result !
	 * @param string $username
	 * 
	 * @return \Entity\User|bool A \Entity\User on success, false if no user was found.
	 */
	public function getByUsername($username)
	{
		$queryString = "SELECT * FROM `user` WHERE username=\"$username\"" ;
		$res = $this->associativeArrayQuery($queryString);
	
		if(count($res)!=0)
			$user = new \Entity\User($res[0]['name'], $res[0]['surname'], $res[0]['username'], $res[0]['password'], $res[0]['email'], $res[0]['degreeCourse'], $res[0]['reliability']);
		else
			$user = false;
			
		return $user;
	}
	/**
	 * Stores a vote of a given user($userVoted) by another user($userVoter)
	 * 
	 * @param String $userVoted
	 * @param String $userVoter
	 * @param Int $vote
	 * 
	 * @return string
	 */
	public function usersVotation($userVoted, $userVoter, $vote)
	{
		
		$insert = "INSERT INTO `users_scores`(`username_voted`,`username_voter`,`vote`)";
		$values = "VALUES ('$userVoted','$userVoter',$vote);";
		$queryString = $insert." ".$values;
	
		if ($vote>=1 && $vote<=5)
		{
			if($this->query($queryString))
			{
				return 'complimenti hai votato questo utente';				
			}
			else
				return 'ci sono stati dei problemi nella votazione';
		}
		else
		{
			return 'il voto non é valido';
		}		
 	}
 	
 	/**
 	 * function getNumberOfReliabilityVotes
 	 * 
 	 * Gets the number of votes  of the reliability of a user.
 	 *
 	 * @param string $username
 	 * 
 	 * @return int  
 	 */
 	public function getNumberOfReliabilityVotes($username)
 	{
 		$select = "SELECT COUNT(`username_voted`) as `Number of votes`";
 		$from = "FROM `users_scores`";
 		$where = "WHERE `username_voted`='$username';";
 	
 		$query = $select." ".$from." ".$where;
 		$res = $this->associativeArrayQuery($query);
 	
 		return $res[0]['Number of votes'];
 	}
 	
 	/**
 	 * function updateReliabilityScore
 	 *
 	 * Updates reliability score of a useron the database. This method doesn't calculate the average. It should be called only after
 	 * Entity\Resource::updateQualityScore() and Entity\Resource::updateDifficultyScore().
 	 *
 	 * @param string $username
 	 * @param int $reliabilityScore
 	 * 
 	 * @return bool
 	 */
 	public function updateReliabilityScore($username, $reliabilityScore)
 	{
 		$updateReliability = "UPDATE `user` SET `reliability` = '$reliabilityScore' WHERE `user`.`username` = '$username';";
 	
 	
 		if ($this->query($updateReliability))
 			return true;
 		else
 			return false;
 	}
 	
 	/**
 	 * function hasBeenRated
 	 * 
 	 * function that controls if a user($voter) has already voted a user($voted)
 	 * 
 	 * @param string $voted
 	 * @param string $voter
 	 * @return bool $rated
 	 */
 	public function hasBeenRated($voted,$voter)
 	{
 		$select = "SELECT *";
 		$from = "FROM `users_scores`";
 		$where = "WHERE `username_voted`='$voted' AND `username_voter`='$voter'";
 	
 		$query = $select." ".$from." ".$where;
 	
 		$result = $this->associativeArrayQuery($query);
 	
 		if(count($result)==0)
 			$rated = false;
 		else
 			$rated = true;
 	
 		return $rated;
 	}

}

?>