<?php
/**
 * this file contain the definition of view class Upload
 *
 */
namespace View;

/**
 *
 * class that manages the immission of a resource
 *
 */
class Upload extends SmartyConfiguration
{
	/**
	 * Contains the details of the resource.
	 *
	 * @var array
	 */
	private $resourceDetailArray;
	
	private $_value='form';
	
	public function __construct()
	{		
		parent::__construct();
	}
	
	/**
	* returns the name of the inserted resource
	* @return mixed String on success, FALSE on error.
	*/
	public function getName() 
	{
		if (isset($_REQUEST['name'])) 
		{
			return $_REQUEST['name'];
		} else
			return false;
	}
	
	/**
	 * returns the category of the inserted resource
	 * @return mixed String on success, FALSE on error.
	 */
	public function getCategory() 
	{
		if (isset($_REQUEST['category'])) 
		{
			return $_REQUEST['category'];
		} else
			return false;
	}
	
	/**
	 * returns the subject of the inserted resource
	 * @return mixed String on success, FALSE on error.
	 */
	public function getSubject() 
	{
		if (isset($_REQUEST['subject'])) 
		{
			return $_REQUEST['subject'];
		} else
			return false;
	}
	
	/**
	 * returns the type of the inserted resource
	 * @return mixed String on success, FALSE on error.
	 */
	public function getType() 
	{
		if (isset($_REQUEST['type']))
		{
			return $_REQUEST['type'];
		} else
			return false;
	}
	
	/**
	 * returns the uploder username of the inserted resource
	 * @return mixed String on success, FALSE on error.
	 */
	public function getUploaderUsername() 
	{
		if (isset($_REQUEST['uploaderUsername'])) 
		{
			return $_REQUEST['uploaderUsername'];
		} else
			return false;
	}
	
	/**
	 * returns the quality score of the inserted resource
	 * @return mixed String on success, FALSE on error.
	 */
	public function getQualityScore() 
	{
		if (isset($_REQUEST['qualityScore'])) 
		{
			return $_REQUEST['qualityScore'];
		} else
			return false;
	}
	
	/**
	 * returns the difficulty score of the inserted resource
	 * @return mixed String on success, FALSE on error.
	 */
	public function getDifficultyScore() 
	{
		if (isset($_REQUEST['difficultyScore'])) 
		{
			return $_REQUEST['difficultyScore'];
		} else
			return false;
	}
	
	/**
	 * returns the visibility of the inserted resource
	 * @return boolean
	 */
	public function getVisible() 
	{
		if (isset($_REQUEST['visible'])) 
		{
			return $_REQUEST['visible'];
		} else
			return false;
	}
	
	/**
	 * returns the downloads number  of the inserted resource
	 * @return mixed String on success, FALSE on error.
	 */
	public function getDownloadsNumber() 
	{
		if (isset($_REQUEST['downloadsNumber'])) 
		{
			return $_REQUEST['downloadsNumber'];
		} else
			return false;
	}
	
	/**
	 * returns the resourcePath of the inserted resource, through the method post or get 
	 * @return mixed String on success, FALSE on error.  
	 */
	public function getResourcePath() 
	{
		if (isset($_REQUEST['resourcePath'])) 
		{
			return $_REQUEST['resourcePath'];
		} else
			return false;
	}
	
	
	/**
	 * Returns the degreeCourse inserted in the upload form.
	 *
	 * returns the name of the inserted resource
	 * @return mixed string on succes, FALSE on error.
	 */
	public function getDegreeCourse()
	{
		if (isset($_REQUEST['degreeCourse']))
		{
			return $_REQUEST['degreeCourse'];
		} else
			return false;
	}
	
	/**
	 * Returns the uploaded file from the $_FILES array.
	 * 
	 * returns the name of the inserted resource
	 * @return mixed FILE on succes, FALSE on error. 
	 */
	public function getUploadedFile()
	{
		if (isset($_FILES['uploadedFile']))
		{
			return $_FILES['uploadedFile'];
		} 
		else
			return false;
	}
	
	/**
	 * function that fills all the field of the detail array of a resource , using the previous methods
	 */
	public function createResourceDetailArray()
	{
		$this->resourceDetailArray['name']=$this->getName();
		$this->resourceDetailArray['category']=$this->getCategory();
		$this->resourceDetailArray['subject']=$this->getSubject();
		$this->resourceDetailArray['uploadedFile']=$this->getUploadedFile();
		$this->resourceDetailArray['degreeCourse']=$this->getDegreeCourse();

	}
	
	/**
	 * return the array with all the datail of a resource
	 * 
	 * @return array
	 */
	public function getResourceDetailArray()
	{	
		$this->createResourceDetailArray();
		
		return $this->resourceDetailArray;
	}
	
    public function processTemplate() 
    {
    	$templateSrc='upload_'.$this->_value.'.tpl';
        $contenuto=$this->fetch($templateSrc);

        return $contenuto;
    }
    public function setTplContent($tpl)
    {
    	$this->_value=$tpl;
    }
	
}