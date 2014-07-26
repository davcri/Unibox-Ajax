<?php
/**
 * 
 * Foundation Resource File
 * 
 * it contain the foundation resource class that Stores and loads a resource with a connection to a mysql's database. 
 * 
 */

namespace Foundation;

use Entity\DegreeCourse;

use Entity\User;


require_once './Classes/Foundation/Database.php';
require_once './Classes/Entity/Resource.php';
require_once './Classes/Entity/User.php';

/**
 * Foundation Resource Class
 * 
 * Stores and loads a resource using a connection to a mysql's database. 
 * and performs all the needed query 
 * Extends the Foundation\Database class that handles the configuration to the database.
 *
 */
class Resource extends Database
{
		
	/**
	 * Constructor
	 * 
	 * Initializes the object, setting the path property.
	 */
	public function __construct()
	{
		parent::__construct();	 
	}
		
	/**
	 * function store
	 * 
	 * Stores a \Entity\Resource object on the database.
	 * 
	 * @param \Entity\Resource $resource
	 * @return mixed false on failure: this can be caused by a duplicate primary key on the table or by a sql syntax error.
	 */
	public function store($resource)
	{
		$name = '"'.$resource->getName().'"';
		$category = '"'.$resource->getCategory().'"';
		$subjectCode = '"'.$resource->getSubjectCode().'"';
		$uploaderUsername = '"'.$resource->getUploaderUsername().'"';
		$type = '"'.$resource->getType().'"';
		$difficultyScore = '"'.$resource->getDifficultyScore().'"';
		$qualityScore = '"'.$resource->getQualityScore().'"';
		$path = '"'.$resource->getPath().'"';
		$uploadingDate = '"'.$resource->getUploadingDate()->format("Y-m-d H:i:s").'"';
		$visible = '"'.$resource->isVisible().'"';
		$downloadsNumber = '"'.$resource->getDownloadsNumber().'"';
		$description = '"'.$resource->getDescription().'"';
		
		$insertInto = "INSERT INTO `resource`(`id`, `name`, `category`, `subjectCode`, `uploaderUsername`, `type`, `difficultyScore`, `qualityScore`, `path`, `uploadingDate`, `visible`, `downloadsNumber`, `description`)"; 
		$values = "VALUES (NULL, $name ,$category,$subjectCode,$uploaderUsername,$type,$difficultyScore,$qualityScore,$path,$uploadingDate,$visible,$downloadsNumber,$description);";
		$queryString = $insertInto." ".$values;
				
		return $this->query($queryString);
	}	
	
	/**
	 * function getById
	 * 
	 * Finds a resource by its $id and then returns it. 
	 * 
	 * @param int $id
	 * @return mixed \Entity\Resource on success, false on failure.
	 */
	public function getById($id)
	{
		$queryString = "SELECT * FROM `resource` WHERE id=\"$id\"" ;
		$array = $this->associativeArrayQuery($queryString);
		
		if(isset($array[0])) // if there is a match
		{
			$uploadingDate = new \DateTime($array[0]['uploadingDate']);  			
			$resource = new \Entity\Resource($array[0]['id'],$array[0]['name'], $array[0]['category'], $array[0]['subjectCode'], $array[0]['uploaderUsername'], $array[0]['type'], $array[0]['qualityScore'], $array[0]['difficultyScore'], $uploadingDate, $array[0]['downloadsNumber'], $array[0]['visible'], $array[0]['path'], $array[0]['description']);
		}
		else 
			$resource = false;
		
		return $resource;
	}
	
	/**
	 * function getResourcesBySubjectCode
	 * 
	 * Gets an array of resources relative to a subject.
	 * 
	 * @param int $subjectCode The code of the subject.
	 * 
	 * @return mixed \Entity\Resource on success, false on failure.
	 */
	public function getResourcesBySubjectCode($subjectCode)
	{
		$queryString = "SELECT * FROM `resource` WHERE subjectCode=\"$subjectCode\"" ;
		$array = $this->associativeArrayQuery($queryString);
		
		if(!empty($array)) // if there is a match
		{
			foreach ($array as $res)
			{
				$resources[] = new \Entity\Resource($res['id'],$res['name'], $res['category'], $res['subjectCode'], $res['uploaderUsername'], $res['type'], $res['qualityScore'], $res['difficultyScore'], $res['uploadingDate'], $res['downloadsNumber'], $res['visible'] , $res['path'], $res['description']);
			}			
		}
		else
			$resources = array(); //empty array
				
		return $resources;		
	}
	
	/**
	* function getResourcesByUser
	* 
	* Gets an array of resources uploaded by a certain user.
	*
	* @param string $username 
	* 
	* @return mixed \Entity\Resource on success, false on failure.
	*/
	public function getResourcesByUser($username)
	{
		$queryString = "SELECT * FROM `resource` WHERE uploaderUsername=\"$username\"" ;
		$array = $this->associativeArrayQuery($queryString);
		
		if(!empty($array)) // if there is a match
		{
			foreach ($array as $res)
			{
				$resources[] = new \Entity\Resource($res['id'],$res['name'], $res['category'], $res['subjectCode'], $res['uploaderUsername'], $res['type'], $res['qualityScore'], $res['difficultyScore'], $res['uploadingDate'], $res['downloadsNumber'], $res['visible'], $res['path'], $res['description']);
			}
		}
		else
			$resources = array(); //empty array
	
		return $resources;
	}
	
	/**
	 * function getNumberOfVotes
	 * 
	 * Gets the number of votes of a resource.
	 * 
	 * @param int $id The id of the resource.
	 * 
	 * @return array $res number of votes of a resource
	 */
	public function getNumberOfVotes($id)
	{
		$select = "SELECT COUNT(`resourceId`) as `Number of votes`";
		$from = "FROM `resources_scores`";
		$where = "WHERE `resourceId`=$id";
		
		$query = $select." ".$from." ".$where;
		$res = $this->associativeArrayQuery($query);
				
		return $res[0]['Number of votes'];		
	}
	
	/**
	* Function getNumberOfDifficultyVotes
	* 
	* Gets the number of votes  of the difficulty of a resource.
	*
	* @param int $id The id of the resource.
	* @return array $res number of votes of a resource
	*/
	public function getNumberOfDifficultyVotes($id)
	{
		$select = "SELECT COUNT(`resourceId`) as `Number of votes`";
		$from = "FROM `resources_difficultyScores`";
		$where = "WHERE `resourceId`=$id";
	
		$query = $select." ".$from." ".$where;
		$res = $this->associativeArrayQuery($query);
	
		return $res[0]['Number of votes'];
	}
	
	/**
	 * function countResourcesByDegreeCourse
	 * 
	 * it return the number of resources of a given degree course
	 * 
	 * @param string $degCourse
	 * 
	 * @return array $res number of resource in a DegreeCourse
	 */
	public function countResourcesByDegreeCourse($degCourse)
	{
		$outerQuery = "SELECT count(*) as 'resourcesCount' FROM resource WHERE resource.subjectCode IN";
		$subQuery = "(SELECT `subjectCode` FROM `degreeCourses_Subjects` WHERE `degreeCourse`='$degCourse')";
		
		$query = $outerQuery.' '.$subQuery;
		
		$res = $this->associativeArrayQuery($query);
		
		return $res[0]['resourcesCount'];
	}
	
	/**
	 * function countResourcesBySubject
	 * 
	 * Counts the resources found in a certain subject.
	 * 
	 * @param int $subjId Code of the subject
	 * @return int Number of resources of a certain subject.
	 */
	public function countResourcesBySubject($subjId)
	{
		$query = "SELECT count(*) as 'resourcesCount' FROM `resource` WHERE `subjectCode`=$subjId";
		$res = $this->associativeArrayQuery($query);
		
		return $res[0]['resourcesCount'];
	}
	
	/**
	 * function updateScores
	 * 
	 * Updates quality and difficulty score of a resource on the database.
	 * This method doesn't calculate the average. It should be called only after 
	 * Entity\Resource::updateQualityScore() and Entity\Resource::updateDifficultyScore(). 
	 * 
	 * @param int $id
	 * @param float $qualityScore
	 * @param float $difficultyScore
	 * 
	 * @return bool
	 */
	public function updateScores($id, $qualityScore, $difficultyScore)
	{
		$updateQual = "UPDATE `resource` SET `qualityScore` = '$qualityScore' WHERE `resource`.`id` = $id;";
		$updateDiff = "UPDATE `resource` SET `difficultyScore` = '$difficultyScore' WHERE `resource`.`id` = $id";
						
		if ($this->query($updateQual) && $this->query($updateDiff))
			return true;
		else
			return false;
	}
		
	/**
	 * function updateDownloadNumber
	 * 
	 * updates the downloads number of a resource 
	 * 
	 * @param int $id
	 * @param int $newDownloadsNumber
	 */
	public function updateDownloadsNumber($id, $newDownloadsNumber)
	{
		$update = "UPDATE `resource` SET `downloadsNumber` = '$newDownloadsNumber' WHERE `resource`.`id` = $id;";

		if($this->query($update))
			return true;
		else
			return false;
	}
	
   /**
    * function addResourceQualityScore
    * 
	* Registers the quality score given by a user.
	*
	* @param string $username Who is rating the resource.
	* @param int $id The id of the resource beeing rated.
	* @param float $qualityScore Score assigned to the resource.
	* 
	* @return bool
	*/
	public function addResourceQualityScore($username,$id,$qualityScore)
	{
		$insert = "INSERT INTO `resources_scores` (`resourceId`, `username`, `score`)";
		$values = "VALUES ('$id', '$username', '$qualityScore');";
		
		$query = $insert.' '.$values;
		
		if ($qualityScore>=0 && $qualityScore<=10)
		{
			if($this->query($query))
				return true;
		}
		else
			return false;
	}
	
   /**
    * function addResourceDifficultyScore
    * 
	* Registers the difficulty score given by a user.
	*
	* @param string $username Who is rating the resource.
	* @param int $id The id of the resource beeing rated.
	* @param float $difficultyScore Score assigned to the resource.
	* 
	* @return bool
	*/
	public function addResourceDifficultyScore($username,$id,$difficultyScore)
	{
		$insert = "INSERT INTO `resources_difficultyScores` (`resourceId`, `username`, `difficultyScore`)";
		$values = "VALUES ('$id', '$username', '$difficultyScore');";
		
		$query = $insert.' '.$values;
		
		if ($difficultyScore>=0 && $difficultyScore<=10)
		{
			if($this->query($query))
				return true;
		}
		else
			return false;	
	}
	
	/**
	 * function hasBeenRated
	 * 
	 * Checks if the resource has been rated from a user.
	 * 
	 * @param int $id
	 * @param string $username
	 * 
	 * @return bool $rated if the resource has been rated or not
	 */
	public function hasBeenRated($id,$username)
	{
		$select = "SELECT *";
		$from = "FROM `resources_difficultyScores`";
		$where = "WHERE `resourceId`=$id AND `username`='$username'";
		
		$query = $select." ".$from." ".$where;
		
		$result = $this->associativeArrayQuery($query);
		
		if(count($result)==0)
			$rated = false;
		else 
			$rated = true;
		
		return $rated;	
	}	
	
	/**
	 * function getMostActiveUsers
	 * 
	 * it returns an array with the most active user into DB
	 * 
	 * @return array $user 
	 */
	public function getMostActiveUsers()
	{
		$query = "SELECT `uploaderUsername`, count(`uploaderUsername`) as 'uploadedResources' FROM `resource` group by `uploaderUsername` order by `uploadedResources` DESC, `uploaderUsername` ASC";
		$result = $this->associativeArrayQuery($query);
		
		$userDb = new \Foundation\User();
		
		if(!empty($result)) // if there is a match
		{
			foreach($result as $userRecord)
			{
				$users[] = $userDb->getByUsername($userRecord['uploaderUsername']);
			}
		}
		else
			$users = array(); //empty array
		
		
		return $users;
	}
	
	/**
	 * function getMostDownloaded
	 *
	 * it returns an array with the most downloaded resources
	 *
	 * @return array $resource
	 */
	public function getMostDownloaded()
	{
		$query= "SELECT `id` FROM `resource` group by `id` order by `downloadsNumber` ASC";
		$result=$this->associativeArrayQuery($query);
		$resourceDb= new \Foundation\Resource();
		if(!empty($result))
		{
			foreach($result as $resourceRecord)
			{
				$resource[]=$resourceDb->getById($resourceRecord['id']);
			}
		}	
		else
			$resource=array();	
		return  $resource;
	}
	
}


?>