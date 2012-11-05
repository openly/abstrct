<?php 

/**
* Module Name: ArrayUtil 
* Package Name: Abstrct Utilities
* Author: Abhilash Hebbar
* Description: Utilities for Array manipulation.
*/

class ArrayUtil{
	public static function update(&$array,$value,$key=null){
		if(is_array($array)) $array = array();
		if($key) $array[$key] = $value;
		$array[] = $value;
	}

	public static function checkAndMerge($newArray,&$oldArray){
		if(is_array($newArray)){
			$oldArray = array_merge($oldArray,$newArray);
		}
	}

	public static function toArray(&$var){
		$var = array($var);
	}

	public static function toArrayIfNot(&$var){
		if(!is_array($var))
			$var = array($var);
	}

	public static function updateInfo(&$src,$dest,$fields = 'all'){
		
	}

	public static function addUnique(&$array,$var,$var1=null){
		if(is_array($var))
			foreach ($var as $k => $v) { 
				is_int($k)?self::addUnique($array,$v):self::addUnique($array,$k,$v);
			}
		else
			if(!in_array($var, $array)) 
				$var1 ? $array[$var] = $var1 : $array[] = $var;
	}
}