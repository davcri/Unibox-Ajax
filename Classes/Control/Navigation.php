<?php
/**
 *this file contains the navigation class,   
 *
 */

namespace Control;

global $projectDirectory;

require_once $projectDirectory.'/Classes/View/Navigation.php';
require_once $projectDirectory.'/Classes/Foundation/Resource.php';
require_once $projectDirectory.'/Classes/Entity/Resource.php';
require_once $projectDirectory.'/Classes/Foundation/Subject.php';
require_once $projectDirectory.'/Classes/Utility/Singleton.php';


/**
 * it is the navigation control class, it manages the navigation of the web appplication and every view of any resource
 * 
 *
 */
class Navigation
{	
	public function __construct()
	{	
		//$this->session = $session;
	}
	
	/**
	 * this function populates the upper part of the body, the menú.
	 * it brings the values of course degree, and insert the corrisponding subject into
	 * a select list( calling an Foundation Function that perform a sql query to the db)
	 */
	public function controlNavigation()
	{
		if(!isset($_REQUEST['degreeCourse']))
		{
			$this->chooseDegreeCourse();
		}
		else if(!isset($_REQUEST['subject']))
		{
			$this->chooseSubject();
		}
		else
		{
			$this->handleNavigation();
		}
	}
	
	//funzione che gestisce la visualizzazione di tutti i degree course presenti nel database
	public function chooseDegreeCourse()
	{
		$db = new \Foundation\DegreeCourse();
		$degreeCourses = $db->getDegreeCourses();
		
		$view = \Utility\Singleton::getInstance('\View\Home');
		$view->assign('degreeCourses',$degreeCourses);
		
		$resourceDb = new \Foundation\Resource();
		$view->assign('resourceDb',$resourceDb);
		
		$view->display('degreeCoursesNav.tpl');
	}
	
	/**
	 *
	 * 
	 */
	public function chooseSubject()
	{
		// this should be removed and replaced with $view = \Utility\Singleton::getInstance('\View\Home');
		$navigation=new \View\Navigation();		
		$degreeCourse=$navigation->getCourseDegree();
			
		$subjectsList=$this->processSubjectList($degreeCourse);
		$navigation->setSubjectList($subjectsList,$degreeCourse);
		
		$mainView = \Utility\Singleton::getInstance('\View\Home');
		$mainView->assign('degreeCourse',$degreeCourse);
		$mainView->assign('subjects',$subjectsList);
		
		$resourceDb = new \Foundation\Resource();
		$mainView->assign('resourceDb',$resourceDb); // used to count the number of resources 
													 // found in a given subject.
				
		$mainView->display('subjectsNav.tpl');
	}
	
	/**
	 * 
	 */
	public function handleNavigation()
	{	
		$resource = new \Foundation\Resource();
		$view = \Utility\Singleton::getInstance("\View\Home");
		
		$selectedSubject = $view->get("subject"); //ritorna l'id della materia
		$allResources = $resource->getResourcesBySubjectCode($selectedSubject);
		$view->assign('resource',$allResources);		
		
		$degreeCourse = $view->get("degreeCourse");		
		$view->assign('degreeCourse',$degreeCourse); // @todo check if this is really needed
		$subjectsList = $this->processSubjectList($degreeCourse);
				
		$subjectName='';		
		foreach($subjectsList as $sub)
		{
			if($sub->getCode() == $selectedSubject){
				$subjectName= $sub->getName();
			}
		}
		$view->assign('subject_name', $subjectName);
		
		
		$view->display('resources.tpl');
			
		
		/*$subject->assign("user",$this->session->get("username"));*/
	
	
		/*if($this->userLoggedIn)
		 $subject->assign("loggedin",true);
		else
			$subject->assign("loggedin",false);*/
		
	}
	
	
	public function controlLoginNavigation()
	{
		if(!isset($_SESSION['degreeCourse']))
		{
			return $this->chooseDegreeCourse();
		}
		else
		{
			return $this->chooseSubject();
		}		
	}	
	
	/**
	 * 
	 *
	 * @param string $courseDegree
	 */
	public function processSubjectList($courseDegree)
	{
		$subjects=new \Foundation\Subject();
		$subjectsList=$subjects->getByDegreeCourse($courseDegree);
		
		return $subjectsList;
	}	
}
