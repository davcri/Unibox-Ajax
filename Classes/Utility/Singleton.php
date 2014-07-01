<?php

namespace Utility;

class Singleton
{
	private static $instances = array();

	public static function getInstance($obj)
	{
		if(!isset(self::$instances[$obj]))
		{
			self::$instances[$obj] = new $obj;
		}
		return self::$instances[$obj];
	}
}

?>