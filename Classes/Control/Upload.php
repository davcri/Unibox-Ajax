<?php

/**
 * this file contain the definition of control class Upload
 *
 */

namespace Control;

global $projectDirectory;
require_once $projectDirectory.'/Classes/Control/Registration.php';
require_once $projectDirectory.'/Classes/View/Upload.php';
require_once $projectDirectory.'/Classes/Entity/Resource.php';
require_once $projectDirectory.'/Classes/Foundation/Resource.php';
require_once $projectDirectory.'/Classes/Foundation/DegreeCourse.php';
require_once $projectDirectory.'/Classes/Foundation/Subject.php';

/**
* Class that control the immission of a new resource
* 
*/
class Upload
{
	/**
	 * Path to the resource folder on the server file system. This isn't an absolute path but is relative to the server document root.
	 * 
	 * @var string
	 */
	private $resourceDestinationPath;
	
	/**
	 * 	 
	 */
	public function __construct()
	{		
		$this->resourceDestinationPath = dirname($_SERVER['SCRIPT_NAME']).'/Resources';
		
		//$this->handleUpload();
	}
	
	/**
	 * It calls the function addNewResource if the form's fields are setted, otherwise
	 * it shows the input form of a new resource.
	 * 
	 */
	public function handleUpload()
	{
		$mainView = \Utility\Singleton::getInstance("\View\Home");
		$data;
		
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
					//$data = json_encode("ok");
				}
				else
					$data = json_encode("You're a bad, evil person");
				
				break;
			
			default :
				break;
		}

		return $data;	
	}
	
	/**
	 *  @todo 
	 */
	private function getForm()
	{		
		$degreeCourseDb = new \Foundation\DegreeCourse();
		$degreeCourses = $degreeCourseDb->getDegreeCourses();

		$uploadPage = \Utility\Singleton::getInstance("\View\Home");
		$uploadPage->assign("degreeCourses",$degreeCourses);
				
		//$uploadPage->display("upload.tpl");
		return $uploadPage->fetch("upload.tpl");
	}
	
	/**
	 *  It takes the form's fields from the resource form and create an Entity\Resource with these details and 
	 *  after stores it into the database.
	 *  
	 *  @todo review this method and clean it.
	 */
	private function addNewResourceIntoDb()
	{
		//print dirname($_SERVER['SCRIPT_NAME']).'/Resources';
		
		$elaboratedForm = \Utility\Singleton::getInstance("\View\Home");
		
		$resourceDetail = $this->getUploadFormData();
							
		$uploadedFile = $resourceDetail['uploadedFile'];
		$tmpUploadedFile = $uploadedFile['tmp_name'];		
			
		$subjectDb = new \Foundation\Subject();	
		$subj = $subjectDb->getByName_DegreeCourse($resourceDetail['subject'], $resourceDetail['degreeCourse']);
		
		if ($subj!=false) //if a subject was found
		{			
			$currentDate = new \DateTime("now");
			$this->resourceDestinationPath .= "/".$uploadedFile['name'];
			
			// @todo This part need to be checked ! 
			$session = \Utility\Singleton::getInstance("\Control\Session");
			$username = $session->get("username");
			
			$resource = new \Entity\Resource(NULL,$resourceDetail['name'], $resourceDetail['category'], $subj->getCode(), $username, $uploadedFile['type'], 0, 0, $currentDate, 0, false, $this->resourceDestinationPath, $resourceDetail['description']);
			
			// taking the absolute path to store the file. Because $this->resourceDestinationPath is relative to the server Document Root. 
			$destination = $_SERVER['DOCUMENT_ROOT'].$this->resourceDestinationPath;
			
			if(move_uploaded_file($tmpUploadedFile, $destination))
			{
				chmod($destination, 0644); // all read permission given to the uploaded file. 				
				
				$resourceDb = new \Foundation\Resource($destination);
				
				if($resourceDb->store($resource))
				{
					$elaboratedForm->assign('result',$resource);
					$elaboratedForm->assign('problem', null);					
				}
				else
				{
					$elaboratedForm->assign('problem','Error while storing the resource on the database');
				}							
			}
			else
			{
				//handle returns exceptions.
			}
		}
		else
		{
			$elaboratedForm->assign('problem','please check if the subject inserted is correct');
			// no subject found
			// we need to create it...maybe
		}
		
		return $elaboratedForm->fetch('uploadCompleted.tpl');
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
	 * @todo add controls on string length and max file size
	 * @return boolean True if the form is valid, false otherwise
	 */
	private function validateFormInputData()
	{	
		$formData = \Utility\Singleton::getInstance("\View\Home");
		$validate = false;
		
		if( !empty($formData->get('name')) && 
			!empty($formData->get('subject')) &&
			!empty($formData->get('category')) &&
			!empty($formData->get('degreeCourse')) &&
			!empty($formData->get('description')) &&
			!empty($formData->getFile('uploadedFile')) )
		{
			$validate = true;
		}
						
		return $validate;		
	}
	
	private function getUploadFormData()
	{
		$uploadForm = \Utility\Singleton::getInstance("\View\Home");
		
		$resourceDetail['name'] = $uploadForm->get('name');
		$resourceDetail['category'] = $uploadForm->get('category');
		$resourceDetail['degreeCourse'] = $uploadForm->get('degreeCourse');
		$resourceDetail['subject'] = $uploadForm->get('subject');
		$resourceDetail['uploadedFile'] = $uploadForm->getFile('uploadedFile');
		$resourceDetail['description'] =  $uploadForm->get('description');
		
		return $resourceDetail;
	}
}















