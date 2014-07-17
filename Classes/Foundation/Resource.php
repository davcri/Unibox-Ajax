<?php
/**
 * 
 * Foundation class for the resource. 
 * 
 * Stores and loads a resource with a connection to a mysql's database. 
 * 
 */

namespace Foundation;

global $projectDirectory;
require_once $projectDirectory.'/Classes/Foundation/Database.php';
require_once $projectDirectory.'/Classes/Entity/Resource.php';

/**
 * 
 * Stores and loads a resource using a connection to a mysql's database. 
 * 
 * Extends the Foundation\Database class that handles the configuration to the database.
 *
 */
class Resource extends Database
{
		
	/**
	 * Initializes the object, setting the path property.
	 * 
	 * @param string $path If the variable is considered empty, then a default path is setted.
	 */
	public function __construct()
	{
		parent::__construct();	 
	}
		
	/**
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
	 * Gets an array of resources relative to a subject.
	 * 
	 * @param int $subjectCode The code of the subject.
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
	* Gets an array of resources uploaded by a certain user.
	*
	* @param string $username 
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
	 * Gets the number of votes of a resource.
	 * 
	 * @param int $id The id of the resource.
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
	* Gets the number of votes  of the difficulty of a resource.
	*
	* @param int $id The id of the resource.
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
	 * 
	 * @todo is this method used ? 
	 * @param string $degCourse
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
	 * Updates quality and difficulty score of a resource on the database.
	 * 
	 * This method doesn't calculate the average. It should be called only after 
	 * Entity\Resource::updateQualityScore() and Entity\Resource::updateDifficultyScore(). 
	 * 
	 * @param int $id
	 * @param float $qualityScore
	 * @param float $difficultyScore
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
	 * 
	 * Enter description here ...
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
	* Registers the quality score given by a user.
	*
	* @param string $username Who is rating the resource.
	* @param int $id The id of the resource beeing rated.
	* @param float $qualityScore Score assigned to the resource.
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
	* Registers the difficulty score given by a user.
	*
	* @param string $username Who is rating the resource.
	* @param int $id The id of the resource beeing rated.
	* @param float $difficultyScore Score assigned to the resource.
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
	 * Checks if the resource has been rated from a user.
	 * 
	 * @param int $id
	 * @param string $username
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
}


?>