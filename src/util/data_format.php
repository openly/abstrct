<?php 

/**
* Module Name: Data Formater Utility 
* Package Name: Abstrct Utility
* Author: Abhilash Hebbar
* Description: This module is responsible for formatting the data as a result of a Query or a web service call etc.
*/

class DataFormatUtil{
	public static function format($data,$from='sql'){
		if($from == 'sql'){
			return self::formatSQL($data);
		}
	}

	public static function formatSQL($rows){
		$retval = array();
		if(count($rows)<1) return $retval;

		foreach ($rows as $row) {
			$retRow = $retval[$row['id']]?$retval[$row['id']]:array();
			foreach ($row as $key => $value) {
				if(self::isNotSQLRelation($key))
					$retRow[$key] = $value;
				else
					self::insert(explode('__',$key),$value,$retRow,$row);
			}
			$retval[$row['id']] = $retRow;
		}

		return $retval;
	}


	private static function isSQLRelation($name){
		return preg_match('/\_\_/',$name);
	}
	
	private static function isNotSQLRelation($name){
		return !self::isSQLRelation($name);
	}

	private static function insert($cols,$value,&$arr,$row,$key=''){
		if(count($cols)>1){
			$col = array_shift($cols);
			$id = self::getIDFor("{$key}{$col}",$row);
			$key = $key . $col . '__';
			if(!is_array($arr[$col]))
				$arr[$col] = array();
			if(!is_array($arr[$col][$id]))
				$arr[$col][$id] = array();
			self::insert($cols,$value,$arr[$col][$id],$row,$key);
		}
		else{
			$arr[$cols[0]] = $value;
		}
	}

	private static function getIDFor($col,$row){
		return $row["{$col}__id"];
	}

}