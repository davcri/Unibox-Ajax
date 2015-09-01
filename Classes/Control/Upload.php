<?php

/**
 * This is the Upload control file
 * 
 * this file contain the definition of control class Upload
 *
 */

namespace Control;


require_once './Classes/View/Main.php';
require_once './Classes/Control/Registration.php';
require_once './Classes/Entity/Resource.php';
require_once './Classes/Foundation/Resource.php';
require_once './Classes/Foundation/DegreeCourse.php';
require_once './Classes/Foundation/Subject.php';

/**
*The upload control class
* 
* it controls the immission of a new resource
* 
*/
class Upload
{
	/**
	 * Folder where this class will store the uploaded resources.
	 * 
	 * @var string
	 */
	private $resourcesFolderName = "Resources";
	
	/**
	 * Relative path to the resource folder on the server file system. This isn't an absolute path but is relative to the @todo
	 * 
	 * @var string
	 */
	private $resourceDestinationPath ;
	
	/**
	 * Contains the server-side limitations for the upload form.
	 * 
	 * Associative array containing the couples ("form field" => "max chars allowed").
	 * When changing these values remember to change also the values on the javascript code! 
	 * 
	 * @example array("name" => 30)
	 * @var array
	 */
	private $maxCharsAllowed;
	
	/**
	 * Array containing the accepted file extensions.
	 *
	 * NOTE: if you modify this variable, remember to modify also the file
	 * ./Smarty_dir/templates/javascript/upload.js, it has a variable whitelist
	 * in the isExtensionSupported() function. 
	 */
	private $whitelist = array('pdf', 'txt', 'odt', 'doc', 'zip', '7z', 'tar', 'gz', 'bz');

	/**
	 * Inizializes all the class variable
	 * 
	 */
	public function __construct()
	{	
		$this->resourceDestinationPath = "./".$this->resourcesFolderName;
		
		$fileList = (scandir($this->resourceDestinationPath)); //@todo remove this useless line of code ? 
		
		$this->maxCharsAllowed = array("name" => 30, 
									   "description" => 150,
									   "subject" => 50,
									   "degreeCourse" => 50,
									   "category" => 50);
	}
	
	/**
	 * Controller for "uploadAction" requests.
	 * 
	 * Switches the control to the appropriate private method, according to the "uploadAction" value.
	 * 
	 * @return string Rendered template output
	 */
	public function handleUpload()
	{
		$mainView = \Utility\Singleton::getInstance("\View\Main");
		$data = "";
				
		switch($mainView->get('uploadAction'))
		{
			case 'getUploadPage' :
				$data = $this->getForm();
				break;
				
			case 'updateSubjectsField' :
				$subjects = $this->getSubjectList($mainView->get('degreeCourse'));
				$data = json_encode($subjects);
				break;
			
			case 'uploadResource':				
				if ($this->validateFormInputData())
				{	
					$data = $this->addNewResourceIntoDb();
				}
				else
				{
					$errorStatus = "There was an error loading the resource. Remember that the accepted file types are:" . "<br> - " . implode("<br> - ", $this->whitelist);
					$data = json_encode($errorStatus);
				}				
				break;
			
			default :
				break;
		}

		return $data;	
	}
	
	/**
	 * Gets the upload form.
	 * 
	 * @return string Rendered template. 
	 */
	private function getForm()
	{		
		$degreeCourseDb = new \Foundation\DegreeCourse();
		$degreeCourses = $degreeCourseDb->getDegreeCourses();

		$uploadPage = \Utility\Singleton::getInstance("\View\Main");
		$uploadPage->assign("degreeCourses", $degreeCourses);
		$uploadPage->assign("maxFileSize", ini_get("upload_max_filesize")); //gets the server max uploadfilesize.
				
		return $uploadPage->fetch("upload.tpl");
	}
	
	/**
	 * Stores the resource on the database.
	 * 
	 * Creates an Entity\Resource with the upload form data and tries to store it on the database.
	 *  
	 * @return string Rendered template.
	 */
	private function addNewResourceIntoDb()
	{
		$elaboratedForm = \Utility\Singleton::getInstance("\View\Main");
		
		$resourceDetail = $this->getUploadFormData();
							
		$uploadedFile = $resourceDetail['uploadedFile'];
		$tmpUploadedFile = $uploadedFile['tmp_name'];		
			
		$subjectDb = new \Foundation\Subject();	
		$subj = $subjectDb->getByName_DegreeCourse($resourceDetail['subject'], $resourceDetail['degreeCourse']);
		
		if ($subj!=false) //if a subject was found
		{			
			$newFileName = $this->getValidResourceFilename($uploadedFile['name']);
			$destination = $this->resourceDestinationPath."/".$newFileName; // this variable contains a valid filename string.
					
			$session = \Utility\Singleton::getInstance("\Control\Session");
			$username = $session->get("username");
			
			$currentDate = new \DateTime("now");
			
			if(dirname($_SERVER['SCRIPT_NAME'])!="/") 
				$pathRelativeToDocumentRoot = dirname($_SERVER['SCRIPT_NAME'])."/".$this->resourcesFolderName."/".$newFileName;
			else //	dirname($_SERVER['SCRIPT_NAME']) == "/"
				$pathRelativeToDocumentRoot = "/".$this->resourcesFolderName."/".$newFileName;
			
			$resource = new \Entity\Resource(NULL,$resourceDetail['name'], $resourceDetail['category'], $subj->getCode(), $username, $uploadedFile['type'], 0, 0, $currentDate, 0, false, $pathRelativeToDocumentRoot, $resourceDetail['description']);
			
			if(move_uploaded_file($tmpUploadedFile, $destination))
			{
				chmod($destination, 0644); // all read permission given to the uploaded file. 				
				
				$resourceDb = new \Foundation\Resource();
				
				if($resourceDb->store($resource))
				{
					$elaboratedForm->assign('result',$resource);
					$elaboratedForm->assign('problem', null);					
				}
				else
				{
					$elaboratedForm->assign('problem', 'Error while storing the resource on the database');
				}							
			}
			else
			{
				$elaboratedForm->assign('problem', "Error while moving the tmp_uploaded file from $tmpUploadedFile to $destination");
			}
		}
		else
		{
			$elaboratedForm->assign('problem', 'Error, check if the inserted subject is correct');
		}
		
		return $elaboratedForm->fetch('uploadCompleted.tpl');
	}
	
	/**
	 * Gets a valid filename with which a resource can safely be stored.  
	 * 
	 * This method checks if the given name already exists in the folder. In this case, 
	 * it changes the name of the new file adding a timestamp to it.
	 * 
	 * @param string $uploadedFile Initial filename. 
	 * 
	 * @return string
	 */
	private function getValidResourceFilename($uploadedFile)
	{
		$fileList = (scandir($this->resourceDestinationPath));

		$nameConflicts = false; // this variable becomes true if two files with the same name
							    // were found in $this->resourceDestinationPath
		
		$newResourceName="";
		foreach($fileList as $file)
		{
			if ($file == $uploadedFile) // check if uploadedFile already exists.
			{
				$nameConflicts = true;
								
				$currentDate = new \DateTime("now");
				
				$fileName = pathinfo($uploadedFile, PATHINFO_FILENAME);
				$fileExtension = pathinfo($uploadedFile, PATHINFO_EXTENSION);
				
				if(!empty($fileExtension))
					$newResourceName = $fileName.$currentDate->format("y_m_d-h_i_s").".".$fileExtension;
				else
					$newResourceName = $fileName.$currentDate->format("y_m_d-h_i_s");
			}							
		}

		if($nameConflicts)
		{
			$validFileName = $newResourceName;
		}
		else
			$validFileName = $uploadedFile;
		
		return $validFileName;
	}
	
	/**
	 * function getSubjectList
	 * 
	 * it returns the subject list of a given degree course
	 * 
	 * @param string $courseDegree
	 * @return array Contains all the subjects of a degree course
	 */
	private function getSubjectList($courseDegree)
	{
		$subjects=new \Foundation\Subject();
		
		$subjectsList=$subjects->getByDegreeCourse($courseDegree);
		
		$result;		
		foreach($subjectsList as $subj)
		{
			$result[] = $subj->getName();						
		}
	
		return $result;
	}
	
	/**
	 * this is the function  validateFormInputData
	 * 
	 * Validates the input data from the upload form page.
	 * 
	 * 
	 * @return boolean True if the form is valid, false otherwise
	 */
	private function validateFormInputData()
	{	
		$formData = \Utility\Singleton::getInstance("\View\Main");
		
		$name = $formData->get('name');
		$subject = $formData->get('subject');
		$category = $formData->get('category');
		$degreeCourse = $formData->get('degreeCourse');
		$description = $formData->get('description');
		$uploadedFile = $formData->getFile('uploadedFile');
		
		$validate = false;		
		
		if( !empty($name) && strlen($name) <= $this->maxCharsAllowed['name'] && 
			!empty($subject) && strlen($subject) <= $this->maxCharsAllowed['subject'] &&
			!empty($category) && strlen($category) <= $this->maxCharsAllowed['category'] &&
			!empty($degreeCourse) && strlen($degreeCourse) <= $this->maxCharsAllowed['degreeCourse'] &&
			!empty($description) && strlen($description) <= $this->maxCharsAllowed['description'] &&
			!empty($uploadedFile))
		{
			$isValid = true;
		}

		// file type verification
		$isTypeValid = false;
		$fileExtension = pathinfo($uploadedFile['name'], PATHINFO_EXTENSION);

		foreach ($this->whitelist as $type)
		{
			if (strtolower($fileExtension) == $type)
			{
				$isTypeValid = true;
			}
		}

		return $isValid && $isTypeValid;
	}
	
	/**
	 * this is the function  getUploadFormData
	 *
	 * it gets the data from upload form
	 *
	 *
	 * @return array $resourceDetail
	 */
	private function getUploadFormData()
	{
		$uploadForm = \Utility\Singleton::getInstance("\View\Main");

		$resourceDetail['name'] = htmlspecialchars($uploadForm->get('name'));
		$resourceDetail['category'] = htmlspecialchars($uploadForm->get('category'));
		$resourceDetail['degreeCourse'] = htmlspecialchars($uploadForm->get('degreeCourse'));
		$resourceDetail['subject'] = htmlspecialchars($uploadForm->get('subject'));
		$resourceDetail['uploadedFile'] = $uploadForm->getFile('uploadedFile');
		$resourceDetail['description'] =  htmlspecialchars($uploadForm->get('description'));

		return $resourceDetail;
	}
}















