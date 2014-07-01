<?php
/**
 * this file contain the definition of view class Navigation
 *
 */
namespace View;

/**
 *
 * class that manages the Navigation of the resource
 *
 */
class Navigation extends SmartyConfiguration
{
	//private $_main_content;
	//private $_sidebar_content='default_sidebar';
	private $_defaultSx='contentDefault';
	private $_defaultDx='default_sidebar';
	
	
	public function getCourseDegree() 
	{
		if (isset($_REQUEST['degreeCourse'])) 
		{
			return $_REQUEST['degreeCourse'];
		} 
		else if($_SESSION['degreeCourse'])
		{
			return $_SESSION['degreeCourse'];
		}
		else
			return 0;
	}
	
	public function getSubject() 
	{
		if (isset($_REQUEST['subject'])) 
		{
			return $_REQUEST['subject'];
		} else
			return 0;
	}
	
	public function processTemplates()
	{
		$contentTemplateSrc='navigation_'.$this->_defaultSx.'.tpl';
		$contenuto=$this->fetch($contentTemplateSrc);

		$contentDxTemplateSrc= $this->_defaultDx.'.tpl';
		$contentDx=$this->fetch($contentDxTemplateSrc);
		$content[]=$contenuto;
		$content[]=$contentDx;

		return $content;		
	}
	
	public function setTplContent($tpl)
	{
		$this->_defaultSx=$tpl;
	}
	
	public function setContent($smartyVar,$content)
	{
		//$this->_main_content=$content;
		$this->assign($smartyVar,$content);
	}
	
	public function setSubjectList($subjectList,$degreeCourse)
	{
		$this->_defaultDx='navigation_sidebar';
		$this->assign('content_navigation_sidebar', $subjectList);
		$this->assign('degreeCourse',$degreeCourse);		
	}

}
