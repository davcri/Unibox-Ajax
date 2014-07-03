<?php

namespace Control;

require_once $projectDirectory.'/Classes/Foundation/Resource.php';
require_once $projectDirectory.'/Classes/Foundation/Subject.php';

class Resource
{
	public function __construct()
	{
		$resourcePage = \Utility\Singleton::getInstance("\View\Home");
		$resourceId = $resourcePage->get("resourceId");
		$resourceDb = new \Foundation\Resource();
		$res = $resourceDb->getById($resourceId);
		
		$subjectDb = new \Foundation\Subject();
		$subject = $subjectDb->getByCode($res->getSubjectCode());		
		
		$resourcePage->assign('resource',$res);
		
		$resourcePage->display('resourcePage.tpl');
	}
}
?>