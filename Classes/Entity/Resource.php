<?php

/** 
 * Entity Resource file
 * 
 * Contains the definition of the Resource enitity class. 
 */

namespace Entity;



require_once "./Classes/Foundation/Resource.php";

/**
 * Entity class resource
 * 
 * This class model a resource. 
 * 
 *
 */
class Resource 
{	
	/**
	 * this is the unique identifier for a resource
	 * @var int
	 */
	private $id;
	
	/**
	 * The name of the resource.
	 *
	 * @var string
	 */
	private $name;
	
	/**
	 * The category of the resource.
	 * 
	 * @var string
	 */	
	private $category;	
		
	/**
	 * The subject code of the resource.
	 *
	 *@var int
	 */
	private $subjectCode;
	
	/**
	* The name of the uploader.
	*
	* @var string
	*/
	private $uploaderUsername;
	
	/**
	 * The type of the resource.
	 * 
	 * @var string 
	 */
	private $type;
		
	/**
	* Average of all the difficulty scores assigned to the resource.
	*
	* @var float
	*/
	private $difficultyScore;
	
	/**
	 * Average of all the quality scores assigned to the resource.
	 * 
	 * @var float
	 */
	private $qualityScore;
	
	/**
	* The DateTime (it is a php core class) of the resource loading date. It includes date, time and timezone.
	*
	* @var \DateTime
	*/
	private $uploadingDate;
	
	/**
	 * The number of downloads.
	 * 
	 * @var int
	 */
	private $downloadsNumber;
	
	/**
	 * The visibility of the resource. When the resource is loaded <code>$visible</code> is false until an administrator approve the resource. 
	 * 
	 * @var boolean
	 */
	private $visible;
	
	/**
	 * Path where the resource is stored.
	 * 
	 * @var string
	 */
	private $path;
		
	/**
	 * Brief description of the resource.
	 * 
	 * @var string
	 */
	private $description;

	/**
	 * Creates a resource and initializes all its attributes.
	 * 
	 * @param string $name
	 * @param string $category
	 * @param int $subjectCode
	 * @param string $type
	 * @param string $uploaderUsername
	 * @param int $qualityScore
	 * @param int $difficultyScore
	 * @param \DateTime $uploadingDate
	 * @param int $downloadsNumber
	 * @param bool $visible
	 * @param string $path
	 * @param string $description
	 * 
	 */
	public function __construct($id, $name, $category, $subjectCode, $uploaderUsername, $type, $qualityScore, $difficultyScore, $uploadingDate, $downloadsNumber, $visible, $path, $description)
	{
		$this->id = $id;
		$this->name = $name;
		$this->category = $category;
		$this->subjectCode = $subjectCode;
		$this->type = $type;
		$this->uploaderUsername = $uploaderUsername;
		$this->qualityScore = $qualityScore;
		$this->difficultyScore = $difficultyScore;
		$this->uploadingDate = $uploadingDate;
		$this->downloadsNumber = $downloadsNumber;
		$this->visible = $visible;
		$this->path = $path;
		$this->description = $description;
	}
	/**
	 * function getId
	 * 
	 * it return the id of a resources
	 * 
	 * @return int $id
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/** 
	 * function getName
	 * 
	 * Returns the name of the resource.
	 * 
	 * @return string Name of the resource.
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
	*function getCategory 
	* 
	* Returns the category of the resource.
	*
	* @return string Category of the resource.
	*/
	public function getCategory()
	{
		return $this->category;
	}
	
	/**
	*function getSubjectCode
	*
	* Returns the subject code of the resource.
	*
	* @return int Subject code of the resource.
	*/
	public function getSubjectCode()
	{
		return $this->subjectCode;
	}
	
	/**
	* function getType
	* 
	* Returns the type of the resource.
	*
	* @return string Type of the resource.
	*/
	public function getType()
	{
		return pathinfo($this->path, PATHINFO_EXTENSION);
		//return $this->type;
	}
	
	/**
	* function getUploaderUsername
	* 
	* Returns the uploader's name of the resource.
	*
	* @return string Uploader's name.
	*/
	public function getUploaderUsername()
	{
		return $this->uploaderUsername;
	}
	
	/**
	* function getQualityScore
	* 
	* Returns the quality score of the resource.
	*
	* @return float Quality score of the resource.
	*/
	public function getQualityScore()
	{
		return $this->qualityScore;
	}
	
	/**
	* function getDifficultyScore
	* 
	* Returns the difficulty score of the resource.
	*
	* @return float Difficulty score of the resource.
	*/
	public function getDifficultyScore()
	{
		return $this->difficultyScore;
	}
	
	/**
	* function getUploadingDate
	* 
	* Returns the uploading date of the resource.
	*
	* @return \DateTime Uploading date of the resource.
	*/
	public function getUploadingDate()
	{
		return $this->uploadingDate;
	}
	
	/**
	* function getDownloadsNumber
	* 
	* Returns the downloads number of the resource.
	*
	* @return int Downloads number of the resource.
	*/
	public function getDownloadsNumber()
	{
		return $this->downloadsNumber;
	}
	
	/**
	 * function getPath
	 * 
	 * Returns the path where the resource is stored.
	 * 
	 * @return string
	 */
	public function getPath()
	{
		return $this->path;
	}
	/**
	 * function getDescription
	 *
	 * Returns the description of a resource
	 *
	 * @return string
	 */
	public function getDescription()
	{
		return $this->description;
	}
	
	/**
	 * function getSize
	 * 
	 * Get the size of the resource in Megabytes, with a precision of 2 decimal digits.
	 * 
	 * @return float 
	 */
	public function getSize()
	{
		$documentRoot = $_SERVER['DOCUMENT_ROOT'];
		$resourceAbsolutePath = $documentRoot.$this->getPath();
		$fileSizeInMegaBytes = filesize($resourceAbsolutePath)/(1000*1000);
		
		return round($fileSizeInMegaBytes,2);		
	}
	
	/**
	* function isVisible
	* 
	* Returns the visibility of the resource.
	*
	* @return bool TRUE if the resource is visible, FALSE otherwise.
	*/
	public function isVisible()
	{
		return $this->visible;
	}
	
	/**
	 *function __toString
	 * 
	 * Override of the php's magic method __toString.
	 * 
	 * @return string A string representing the name of the resource.
	 */
	public function __toString()
	{
		return $this->name;
	}
	
	/**
	 * function setName
	 * 
	 * Sets the name of the resource.
	 * 
	 * @param string $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}
	
	/**
	 * function setCategory
	 * 
	 * Sets the category of the resource.
	 * 
	 * @param string $category
	 */
	public function setCategory($category)
	{
		$this->category = $category;
	}
	
	/**
	 * setSubjectCode
	 * 
	 * Sets the subject of the resource.
	 * 
	 * @param string $subject
	 */
	public function setSubjectCode($subjectCode)
	{
		$this->subjectCode = $subjectCode;
	}

	/**
	 * setUploaderName
	 * 
	 * Sets the uploader's name of the resource.
	 * 
	 * @param string $uploaderName
	 */
	public function setUploaderName($uploaderUsername)
	{
		$this->uploaderUsername = $uploaderUsername;	
	}
	
	/**
	 * function setQualityScore
	 * 
	 * Sets the quality score of the resource.
	 * 
	 * @param float $qualityScore
	 */
	public function setQualityScore($qualityScore)
	{
		$this->qualityScore = $qualityScore;
	}
	
	/**
	 * function setDifficultyScore
	 * 
	 * Sets the difficulty score of the resource.
	 * 
	 * @param float $difficultyScore
	 */
	public function setDifficultyScore($difficultyScore)
	{
		$this->difficultyScore = $difficutyScore;
	}
	
	/**
	 * function updateQualityScore
	 * 
	 * Updates the quality score of the resource with the average between the current 
	 * quality score and the new score given (according to the number of votes).
	 * 
	 * @param int $votes Number of votes given to the resource.
	 * @param int $score Score to add in the average.
	 */
	public function updateQualityScore($votes, $score)
	{
		// avoiding division by zero
		if($votes==0)
			$votes = 1;
		
		$newAvg = ($this->qualityScore * ($votes-1) + $score)/$votes;
		$this->qualityScore = $newAvg;
	}
	
	/**
	* function updateDifficultyScore
	* 
	* Updates the difficulty score of the resource with the average between the current
	* difficulty score and the new score given (according to the number of votes).
	*
	* @param int $votes Number of votes given to the resource.
	* @param int $score Score to add in the average.
	*/
	public function updateDifficultyScore($votes, $score)
	{
		// avoiding division by zero
		if($votes==0)	
			$votes = 1;
		
		$newAvg=($this->difficultyScore *($votes-1) + $score)/($votes);
		//$this->difficultyScore = ($this->difficultyScore+$score)/$votes;
		$this->difficultyScore = $newAvg;
	}	
	
	/**
	 * function incrementDownloadsNumber
	 * 
	 * Increments the downloads number.
	 * 
	 */
	public function incrementDownloadsNumber()
	{
		$this->downloadsNumber++;		
	}
	
	/**
	 * function setUploadingDate
	 * 
	 * Sets the uploading date of the resource.
	 * 
	 * @param \DateTime $uploadingDate
	 */
	public function setUploadingDate($uploadingDate)
	{
		$this->uploadingDate = $uploadingDate;
	}
	
	/**
	 * function setDownloadNumber
	 * 
	 * Sets the downloads number of the resource.
	 *
	 * @param int $downloadsNumber
	 */
	public function setDownloadsNumber($downloadsNumber)
	{
		$this->downloadsNumber = $downloadsNumber;
	}
	
	/**
	 * function setVisibility
	 * 
	 * Sets the visibility of the resource.
	 * 
	 * @param bool $visibility
	 */
	public function setVisibility($visibility)
	{
		$this->visible = $visibility;
	}
	
	/**
	 * function setDescription
	 * 
	 * Sets the description of a resource.
	 *  
	 * @param string $desc
	 */
	public function setDescription($desc)
	{
		$this->description = $desc;
	}
	
	/**
	 * function hasBeenRated
	 * 
	 * Checks if the resource has been rated by a certain user.
	 * 
	 * @param string $username
	 * @return bool 
	 */
	public function hasBeenRated($username)
	{
		$db = new \Foundation\Resource();
		
		return $db->hasBeenRated($this->id, $username);
	}
	
	/**
	 * function countDifficultyVotes
	 *
	 * it returns the number of difficultyVotes of a resource
	 *
	 * @return int
	 */
	public function countDifficultyVotes()
	{
		$db = new \Foundation\Resource();
	
		return $db->getNumberOfDifficultyVotes($this->id);
	}
	
	/**
	 * function countQualityVotes
	 *
	 * it returns the number of difficultyVotes of a resource
	 *
	 * @return int
	 */
	public function countQualityVotes()
	{
		$db = new \Foundation\Resource();
	
		return $db->getNumberOfVotes($this->id);
	}
}

?>	