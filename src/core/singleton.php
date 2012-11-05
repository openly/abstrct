<?php 

/**
* Module Name: Abstrct Singleton 
* Package Name: Abstrct Core
* Author: Abhilash Hebbar
* Description: This class is a base class to use with singleton classes. This basically calls all the static method on the created static object.
*/

class AbstrctSingleton{
	private static $instance = array();

	private function __construct(){}

	protected function init(){}

	public static function getInstance(){
		if(!is_object(self::$instance[$name])){
			$name = get_called_class();
			self::$instance[$name] = new $name;
			self::$instance[$name]->init();
		}
		return self::$instance[$name];
	}

	public static function __callStatic($name,$args){
		return call_user_func_array(array(self::getInstance(),"_$name"), $args);
	}
}