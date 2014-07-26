<?php
/**
 * 
 * Smarty configuration File
 * 
 * it contains the smartu ocnfiguration class
 *
 */
namespace View;	

require_once './Library/Smarty-3.1.17/Smarty.class.php';
require_once './Configuration Files/smartyConfig.php';

/**
 * Smarty configuration class
 * 
 * This class simply extends Smarty and sets its working directories.
 *
 */
class SmartyConfiguration extends \Smarty
{
	/**
	 * constructor
	 * 
	 * Sets the smarty working directories.
	 * 
	 * @todo Maybe we could move this configuration in the ConfigurationFiles folder ? 
	 */
	function __construct()
	{
		parent::__construct();
		
		global $smarty;
		
		$this->template_dir = $smarty['template_dir']; 
		$this->compile_dir = $smarty['compile_dir'];
		$this->cache_dir = $smarty['cache_dir'];
		$this->config_dir = $smarty['config_dir'];
	}
}
?>