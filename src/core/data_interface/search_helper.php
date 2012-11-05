<?php 

/**
* Module Name: Query Builder 
* Package Name: Abstrct Data Interface
* Author: Abhilash Hebbar
* Description: This module generates the SQL queries based on the variables passed. Also used for lazy loading.
*/

/**
* 
*/
class AbstrctSearchHelper extends AbstrctDataClass
{
	public function on_function_call($function,$args){
		if(preg_match('/^add(Column|Clause|Sort|Resource|Limit)$/',$function,$match)){
			$property = strtolower($match[1]) . 's';
			$current = (is_array($this->{$property})? $this->{$property}:array());
			ArrayUtil::addUnique($current,$args[0],$args[1]);
			$this->{$property}=$current;
		}else if($function == 'reset'){
			$this->data = array();
		}
		return $this;
	}
}