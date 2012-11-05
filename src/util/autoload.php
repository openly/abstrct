<?php 
/**
* Module Name: Autoloader Utility 
* Package Name: Abstrct Utility
* Author: Abhilash Hebbar
* Description: This module helps in loading the classes when their instances are created. Used manjorly by load method of the factory.
*/

define('SRC_DIR', __DIR__ . '/../');
define('USER_DIR', SRC_DIR . '../');
define('USER_TEMPLATES_DIR', SRC_DIR . '../templates/');
define('TEMPLATES_DIR', SRC_DIR . 'templates/');

spl_autoload_register(array('AutoloadUtil','load'));

class AutoloadUtil{
	public static function load($name){
		// echo "Loading file for class: $name \n";
		return (
			self::requireCore($name) || self::requireLib($name)        ||
			self::requireUtil($name) || self::requireModel($name)      || 
			self::requireView($name) || self::requireValidation($name) || 
			self::requireForm($name)
		);
	}

	public static function __callStatic($function,$args){
		if(preg_match('/^require/', $function)){
			$dir = preg_replace('/^require/','',$function);
			if(in_array(strtolower($dir), array('core','util','lib'))){
				return self::requireFromDir($args[0], (SRC_DIR . strtolower($dir)));
			}
			else
				return self::requireUserClass($args[0],$dir);
		}
	}

	public static function getUserClassName($name,$type){
		return implode('',array_map('ucfirst',preg_split('/[_-]/',$name))) . ucfirst($type);
	}

	public static function getTemplate($name,$dir = '',$default=null){
		if(file_exists(USER_TEMPLATES_DIR . $dir . "/{$name}.html"))
			return USER_TEMPLATES_DIR . $dir . "/{$name}.html";
		else if(file_exists(TEMPLATES_DIR . $dir . "/{$name}.html"))
			return TEMPLATES_DIR . $dir . "/{$name}.html";
		else if($default && file_exists(USER_TEMPLATES_DIR . $dir . "/{$default}.html"))
			return USER_TEMPLATES_DIR . $dir . "/{$default}.html";
		else if($default && file_exists(TEMPLATES_DIR . $dir . "/{$default}.html"))
			return TEMPLATES_DIR . $dir . "/{$default}.html";
		else
			ExceptionUtil::exception("Cannot find the template for $name in $dir");
	}

	private static function requireUserClass($name,$type){
		if(!preg_match("/$type/i",$name))return false;
		$name = str_replace($type,'',$name);
		// echo "Checking for $name - $type<br />";
		return self::requireFromDir($name, (USER_DIR . strtolower($type) . 's')) 
			|| self::requireFromDir($name, (SRC_DIR  . strtolower($type) . 's'));
	}

	private static function requireFromDir($name,$dir){
		if(!is_dir($dir))return false;
		// echo "Scanning dir $dir<br />";
		if(self::checkAndInclude($dir . '/' . self::getFileName($name)))
			return true;
		else{
			foreach(scandir($dir . '/') as $subdir){
				// if(is_dir($dir . '/' . $subdir) && $subdir != '.' && $subdir != '..')
				// 	echo "Scanning subdir $dir/$subdir for ".self::getFileName($name)."<br />";
				if(is_dir($dir . '/' .$subdir) && $subdir != '.' && $subdir != '..' && self::checkAndInclude($dir . '/' . $subdir . '/' . self::getFileName($name)))
					return true;
			}
		}
		return false;
	}

	private static function getFileName($name){
		$replaces = array('/^Abstrct/' => '','/Util$/'=>'','/([A-Z]+)/'=>'_$1','/^_/'=>'');
		return strtolower(preg_replace(array_keys($replaces), array_values($replaces), $name)) . '.php';
	}

	private static function checkAndInclude($filePath){
		// echo "Checking if $filePath exists.";
		// echo (file_exists($filePath)?"Yes<br/>":"No<br />");
		if(file_exists($filePath)){
			require_once($filePath);
			return true;
		}
		return false;
	}
}