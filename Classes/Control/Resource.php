<?php
/**
 * Contains the Resource controller.
 *
 */

namespace Control;

use Utility\Singleton;

require_once $projectDirectory.'/Classes/Foundation/Resource.php';
require_once $projectDirectory.'/Classes/Foundation/Subject.php';

/**
 * Handles the AJAX requests of the resource page.
 * 
 *
 */
class Resource
{
	/**
	 * Empty constructor
	 * 
	 */
	public function __construct()
	{

	}
	
	/**
	 * Handles the resource page.
	 * 
	 * Sends the tpl file requested through AJAX.
	 */
	public function controlResource()
	{
		$resourcePage = \Utility\Singleton::getInstance('\View\Home');
		
		switch($resourcePage->get('resourceAction'))
		{
			case 'incrementDownloadsCount':
				$data=$this->incrementDownloads();
				break;
			
			case 'getResourcePage':
				$data=$this->setTplVariables();
				$resourcePage->display('resourcePage.tpl');				
				break;
			case 'getResourcePageFromUser':
				$data=$this->setTplVariablesFromUser();
				break;
			case 'rateResource':
				$userSession = \Utility\Singleton::getInstance('\Control\Session');
				
				if ($userSession->isLoggedIn())
				{
					$data=$this->rateResource();
				}
				else
					print 'Error. The user is not logged in but is still trying to rate a resource.';
				break;
		}	
		return $data;			
	}
	
	/**
	 * Sets the smarty variables of resourcePage.tpl
	 * 
	 * Assigns all the requested smarty variables.
	 */
	private function setTplVariables()
	{
		$resourcePage = \Utility\Singleton::getInstance('\View\Home');		
		$resourceId = $resourcePage->get('resourceId');
		$degreeCourse = $resourcePage->get('degreeCourse');
		
		$resourceDb = new \Foundation\Resource();
		$res = $resourceDb->getById($resourceId);
		
		$subjectDb = new \Foundation\Subject();
		$subject = $subjectDb->getByCode($res->getSubjectCode());
		
		$userSession = \Utility\Singleton::getInstance('\Control\Session');
		
		if($userSession->isLoggedIn())
		{
			$username = $userSession->get("username");			
			$db = new \Foundation\User();
			$user = $db->getByUsername($username);			
		}
		else
			$user = false;
		
		$resourcePage->assign('degreeCourse',$degreeCourse);
		$resourcePage->assign('subject',$subject);
		$resourcePage->assign('resource',$res);	
		$resourcePage->assign('user',$user);
	}
	
	/**
	 * Rates a resource.
	 *
	 * This method should be called only by AJAX.
	 */
	private function rateResource()
	{
		/* These values come from the ajax call */
		$resId = $_REQUEST["resourceId"];
		$difficulty = $_REQUEST["difficulty"];
		$quality = $_REQUEST["quality"];
		
		$session = \Utility\Singleton::getInstance("\Control\Session");
		$username = $session->get("username");
	
		$db = new \Foundation\Resource();
		
		$db->addResourceDifficultyScore($username,$resId,$difficulty);
		$db->addResourceQualityScore($username,$resId,$quality);
	
		$difficultyVotes = $db->getNumberOfDifficultyVotes($resId);
		$qualityVotes = $db->getNumberOfVotes($resId);
		$res = $db->getById($resId);
				
		$res->updateDifficultyScore($difficultyVotes,$difficulty);
		$res->updateQualityScore($qualityVotes,$quality);
	
		$retCode = $db->updateScores($resId, $res->getQualityScore(), $res->getDifficultyScore()); 
	
		return json_encode(array("returnCode"=>$retCode, "newDifficulty"=>$res->getDifficultyScore(), "newQuality"=>$res->getQualityScore(), "voti diff"=>$difficultyVotes, "voti qual"=>$qualityVotes));
	}
	
	private function incrementDownloads()
	{
		$resourcePage = \Utility\Singleton::getInstance('\View\Home');
		$resourceId = $resourcePage->get("resourceId");
		$resourceDb = new \Foundation\Resource();
		$resource = $resourceDb->getById($resourceId);
		
		$resource->incrementDownloadsNumber();
		
		$resourceDb->updateDownloadsNumber($resourceId, $resource->getDownloadsNumber());
		
		return json_encode(array('newDownloadsCount' => $resource->getDownloadsNumber()));
	}
}
?>
