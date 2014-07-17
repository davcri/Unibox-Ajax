<?php

/** 
 * 
 * Contains the definition of the Resource enitity class. 
 * 
 * @todo remove 'type' property from this class ?  
 */

namespace Entity;

global $projectDirectory;

require_once $projectDirectory."/Classes/Foundation/Resource.php";

/**
 * This class models a resource. 
 *
 */
class Resource 
{	
	/**
	 * 
	 * Enter description here ...
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
	 * @todo Exceptions handling. Many parameters need to be checked.
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
	
	public function getId()
	{
		return $this->id;
	}
	
	/** 
	 * Returns the name of the resource.
	 * 
	 * @return string Name of the resource.
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
	* Returns the category of the resource.
	*
	* @return string Category of the resource.
	*/
	public function getCategory()
	{
		return $this->category;
	}
	
	/**
	* Returns the subject code of the resource.
	*
	* @return int Subject code of the resource.
	*/
	public function getSubjectCode()
	{
		return $this->subjectCode;
	}
	
	/**
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
	* Returns the uploader's name of the resource.
	*
	* @return string Uploader's name.
	*/
	public function getUploaderUsername()
	{
		return $this->uploaderUsername;
	}
	
	/**
	* Returns the quality score of the resource.
	*
	* @return float Quality score of the resource.
	*/
	public function getQualityScore()
	{
		return $this->qualityScore;
	}
	
	/**
	* Returns the difficulty score of the resource.
	*
	* @return float Difficulty score of the resource.
	*/
	public function getDifficultyScore()
	{
		return $this->difficultyScore;
	}
	
	/**
	* Returns the uploading date of the resource.
	*
	* @return \DateTime Uploading date of the resource.
	*/
	public function getUploadingDate()
	{
		return $this->uploadingDate;
	}
	
	/**
	* Returns the downloads number of the resource.
	*
	* @return int Downloads number of the resource.
	*/
	public function getDownloadsNumber()
	{
		return $this->downloadsNumber;
	}
	
	/**
	 * Returns the path where the resource is stored.
	 * 
	 * @return string
	 */
	public function getPath()
	{
		return $this->path;
	}
	
	public function getDescription()
	{
		return $this->description;
	}
	
	/**
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
	* Returns the visibility of the resource.
	*
	* @return bool TRUE if the resource is visible, FALSE otherwise.
	*/
	public function isVisible()
	{
		return $this->visible;
	}
	
	/**
	 * Override of the php's magic method __toString.
	 * 
	 * @return string A string representing the name of the resource.
	 */
	public function __toString()
	{
		return $this->name;
	}
	
	/**
	 * Sets the name of the resource.
	 * 
	 * @param string $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}
	
	/**
	 * Sets the category of the resource.
	 * 
	 * @param string $category
	 */
	public function setCategory($category)
	{
		$this->category = $category;
	}
	
	/**
	 * Sets the subject of the resource.
	 * 
	 * @param string $subject
	 */
	public function setSubjectCode($subjectCode)
	{
		$this->subjectCode = $subjectCode;
	}

	/**
	 * Sets the uploader's name of the resource.
	 * 
	 * @param string $uploaderName
	 */
	public function setUploaderName($uploaderUsername)
	{
		$this->uploaderUsername = $uploaderUsername;	
	}
	
	/**
	 * Sets the quality score of the resource.
	 * 
	 * @param float $qualityScore
	 */
	public function setQualityScore($qualityScore)
	{
		$this->qualityScore = $qualityScore;
	}
	
	/**
	 * Sets the difficulty score of the resource.
	 * 
	 * @param float $difficultyScore
	 */
	public function setDifficultyScore($difficultyScore)
	{
		$this->difficultyScore = $difficutyScore;
	}
	
	/**
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
	 * Increments the downloads number.
	 * 
	 */
	public function incrementDownloadsNumber()
	{
		$this->downloadsNumber++;		
	}
	
	/**
	 * Sets the uploading date of the resource.
	 * 
	 * @param \DateTime $uploadingDate
	 */
	public function setUploadingDate($uploadingDate)
	{
		$this->uploadingDate = $uploadingDate;
	}
	
	/**
	 * Sets the downloads number of the resource.
	 *
	 * @param int $downloadsNumber
	 */
	public function setDownloadsNumber($downloadsNumber)
	{
		$this->downloadsNumber = $downloadsNumber;
	}
	
	/**
	 * Sets the visibility of the resource.
	 * 
	 * @param bool $visibility
	 */
	public function setVisibility($visibility)
	{
		$this->visible = $visibility;
	}
	
	/**
	 * Sets the description of a resource.
	 *  
	 * @param string $desc
	 */
	public function setDescription($desc)
	{
		$this->description = $desc;
	}
	
	/**
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
}

?>	