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
		$this->setTplVariables();
		$resourcePage->display('resourcePage.tpl');				
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
	public function rateResource()
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
	
		$retCode = $db->updateScores($resId,$res->getQualityScore(),$res->getDifficultyScore()); 
	
		print json_encode(array("returnCode"=>$retCode, "newDifficulty"=>$res->getDifficultyScore(),"newQuality"=>$res->getQualityScore()));
	}
}
?>