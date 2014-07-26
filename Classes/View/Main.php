<?php
/**
 * view Main File
 * 
 * Contains a View class that displays the web app
 *
 */
namespace View;

require_once './Classes/View/SmartyConfiguration.php';

/**
 * View Main Class
 * 
 *this is the main and only viewer class, that control every inputs from the browser, like post, get, request
 */
class Main extends \View\SmartyConfiguration
{
	/**
	 * constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}
	/**
	 * fucntion get
	 * 
	 * getter the request from browser by $key
	 * 
	 * @param unknown_type $key
	 * 
	 * @return mixed
	 */
	public function get($key)
	{
		if (isset($_REQUEST[$key]))
			return $_REQUEST[$key];
		else
			return false;		
	}
	
	/**
	 * function getFile
	 * 
	 * function for insert a new resource
	 * 
	 * @param unknown_type $key
	 * @return ?
	 */
	public function getFile($key)
	{
		return $_FILES[$key];
	}
		
}
?>