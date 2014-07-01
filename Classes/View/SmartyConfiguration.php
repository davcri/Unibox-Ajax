<?php
/**
 * 
 * Smarty configuration class. 
 * 
 *
 */
namespace View;	

require_once $projectDirectory.'/Library/Smarty-3.1.17/Smarty.class.php';
require_once $projectDirectory.'/Configuration Files/smartyConfig.php';

/**
 * 
 * This class simply extends Smarty and sets its working directories.
 *
 */
class SmartyConfiguration extends \Smarty
{
	/**
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