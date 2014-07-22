<?php

/**
 * this file contain the definition of control class Upload
 *
 */

namespace Control;

global $projectDirectory;
require_once './Classes/View/Main.php';
require_once './Classes/Control/Registration.php';
require_once './Classes/Entity/Resource.php';
require_once './Classes/Foundation/Resource.php';
require_once './Classes/Foundation/DegreeCourse.php';
require_once './Classes/Foundation/Subject.php';

/**
* Class that control the immission of a new resource
* 
*/
class Upload
{
	private $resourcesFolderName = "Resources";
	
	/**
	 * Relative path to the resource folder on the server file system. This isn't an absolute path but is relative to the @todo
	 * 
	 * @var string
	 */
	private $resourceDestinationPath ;
	
	private $maxCharsAllowed;
	
	/**
	 * 	 
	 */
	public function __construct()
	{	
		$this->resourceDestinationPath = "./".$this->resourcesFolderName;
		
		$fileList = (scandir($this->resourceDestinationPath));
		
		$this->maxCharsAllowed = array("name" => 30, 
									   "description" => 150,
									   "subject" => 50,
									   "degreeCourse" => 50,
									   "category" => 50);
	}
	
	/**
	 * It calls the function addNewResource if the form's fields are setted, otherwise
	 * it shows the input form of a new resource.
	 * 
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
					$errorStatus = "You're a bad, evil person";
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
	 *  @return string Rendered template. 
	 */
	private function getForm()
	{		
		$degreeCourseDb = new \Foundation\DegreeCourse();
		$degreeCourses = $degreeCourseDb->getDegreeCourses();

		$uploadPage = \Utility\Singleton::getInstance("\View\Main");
		$uploadPage->assign("degreeCourses", $degreeCourses);
		$uploadPage->assign("maxFileSize", ini_get("upload_max_filesize"));
				
		//$uploadPage->display("upload.tpl");
		return $uploadPage->fetch("upload.tpl");
	}
	
	/**
	 *  It takes the form's fields from the resource form and create an Entity\Resource with these details and 
	 *  after stores it into the database.
	 *  
	 *  @return string Rendered template.
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
			$pathRelativeToDocumentRoot = dirname($_SERVER['SCRIPT_NAME'])."/".$this->resourcesFolderName."/".$newFileName;
			
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
			$elaboratedForm->assign('problem', 'please check if the subject inserted is correct');
		}
		
		return $elaboratedForm->fetch('uploadCompleted.tpl');
	}
	
	/**
	 * Gets a valid filename with which a resource can safely be stored. 
	 * 
	 * This method checks if the name already exists in the folder. In this case, 
	 * it changes the name of the new file adding a timestamp to it.
	 * 
	 * @param string $uploadedFile  
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
	 * Validates the input data from the upload form page.
	 * 
	 * @todo add controls on max file size
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
			$validate = true;
		}
						
		return $validate;		
	}
	
	private function getUploadFormData()
	{
		$uploadForm = \Utility\Singleton::getInstance("\View\Main");
		
		$resourceDetail['name'] = $uploadForm->get('name');
		$resourceDetail['category'] = $uploadForm->get('category');
		$resourceDetail['degreeCourse'] = $uploadForm->get('degreeCourse');
		$resourceDetail['subject'] = $uploadForm->get('subject');
		$resourceDetail['uploadedFile'] = $uploadForm->getFile('uploadedFile');
		$resourceDetail['description'] =  $uploadForm->get('description');
		
		return $resourceDetail;
	}
}















