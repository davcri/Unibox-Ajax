<?php

namespace Control;

require_once $projectDirectory.'/Classes/Foundation/Resource.php';
require_once $projectDirectory.'/Classes/Foundation/Subject.php';

class Resource
{
	public function __construct()
	{
		//$this->controlResource();
	}
	
	public function controlResource()
	{
		$this->setTplVariables();			
	}
	
	private function setTplVariables()
	{
		$resourcePage = \Utility\Singleton::getInstance('\View\Home');
		
		$resourceId = $resourcePage->get('resourceId');
		$degreeCourse = $resourcePage->get('degreeCourse');
		
		$resourceDb = new \Foundation\Resource();
		$res = $resourceDb->getById($resourceId);
		
		$subjectDb = new \Foundation\Subject();
		$subject = $subjectDb->getByCode($res->getSubjectCode());
		
		$resourcePage->assign('degreeCourse',$degreeCourse);
		$resourcePage->assign('subject',$subject);
		$resourcePage->assign('resource',$res);
		
		$resourcePage->display('resourcePage.tpl');
	}
}
?>