<?php 

/**
* Module Name: Integer Validation 
* Package Name: Abstrct Validations
* Author: Raghu
* Description: Validates a field for integer value.
*/

class IntegerValidation extends AbstrctDataClass{
	public function validate(&$args,$key,$label = null){
		if(isset($args[$key]) && !empty($args[$key]) && ! $this->isInteger($args[$key])){
			$this->error = sprintf("Please enter valid integer number in '%s'",($label?$label:$key));
			return false;
		}
		return true;
	}

	private function isInteger($data){
		if (is_int($data)) {
			return true;
		} else if (is_string($data) && is_numeric($data)) {
			return !(strpos($data, '.'));
		}
		return false;
	}
}