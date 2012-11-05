<?php 

/**
* Module Name: Exception Utilities 
* Package Name: Abstrct Util
* Author: Abhilash Hebbar
* Description: This class helps to check some features and throw excetions accordingly.
*/

/**
* 
*/
class ExceptionUtil
{
	static function notNull(&$param,$paramName,$context){
		if(is_null($param))
			throw new Exception("$paramName cannot be null [$context]", 1);
	}

	static function exception($message){
		throw new Exception($message, 1);
	}
}