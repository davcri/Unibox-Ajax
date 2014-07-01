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
		
		$this->handleUpload();
	}
	
	/**
	 * It calls the function addNewResource if the form's fields are setted, otherwise
	 * it shows the input form of a new resource.
	 * 
	 */
	public function handleUpload()
	{	
		if (isset($_REQUEST['uploadAction']))
		{
			print json_encode(($this->processSubjectList($_REQUEST['uploadAction'])));
		}
		elseif(empty($_REQUEST['name']) || empty($_REQUEST['subject']) || empty($_REQUEST['category']) || empty($_REQUEST['degreeCourse']) || empty($_FILES))
		{			
			$this->getForm();
		}
		else
		{
			$this->addNewResourceIntoDb();
		}		
	}
	
	/**
	 *  @todo 
	 */
	public function getForm()
	{		
		$degreeCourseDb = new \Foundation\DegreeCourse();
		$degreeCourses = $degreeCourseDb->getDegreeCourses();
		//$uploadPage->setTplContent('form');
		$uploadPage = \Utility\Singleton::getInstance("\View\Home");
		$uploadPage->assign("degreeCourses",$degreeCourses);
		
		//$this->processSubjectList($courseDegree);
		
		$uploadPage->display("upload.tpl");
	}
	
	/**
	 *  It takes the form's fields from the resource form and create an Entity\Resource with these details and 
	 *  after stores it into the database.
	 *  
	 */
	public function addNewResourceIntoDb()
	{
		//print dirname($_SERVER['SCRIPT_NAME']).'/Resources';
		
		$elaboratedForm = new \View\Upload();		
		$resourceDetail = $elaboratedForm->getResourceDetailArray();
		
		$elaboratedForm->setTplContent('completed'); //@todo change this name. The tpl 'completed' is displayed also when the uploading is not completed
													 // so the name 'completed' is misleading.
		
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
			
			$resource = new \Entity\Resource(NULL,$resourceDetail['name'], $resourceDetail['category'], $subj->getCode(), $username, $uploadedFile['type'], 0, 0, $currentDate, 0, false, $this->resourceDestinationPath);
			
			// taking the absolute path to store the file. Because $this->resourceDestinationPath is relative to the server Document Root. 
			$destination = $_SERVER['DOCUMENT_ROOT'].$this->resourceDestinationPath;
			
			if(move_uploaded_file($tmpUploadedFile, $destination))
			{
				chmod($destination, 0777); // all permission given to the uploaded file. 				
				
				$resourceDb = new \Foundation\Resource($destination);
				
				if($resourceDb->store($resource))
				{
					$elaboratedForm->assign("result",$resource);
					$elaboratedForm->assign("problem", null);					
				}
				else
				{
					$elaboratedForm->assign("problem","Error while storing the resource on the database");
				}							
			}
			else
			{
				//handle returns exceptions.
			}
		}
		else
		{
			$elaboratedForm->assign("problem","please check if the subject inserted is correct");
			// no subject found
			// we need to create it...maybe
		}
		
		return $elaboratedForm->processTemplate();
	}
	
	public function processSubjectList($courseDegree)
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
}















