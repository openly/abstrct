<?php 

/**
* Module Name: Number Validation 
* Package Name: Abstrct Validations
* Author: Raghu
* Description: Validates a field for numeric value.
*/

class NumberValidation extends AbstrctDataClass{
	public function validate(&$args,$key,$label = null){
		if(isset($args[$key]) && !empty($args[$key]) && !is_numeric($args[$key])){
			$this->error = sprintf("Please enter valid numeric value in '%s'",($label?$label:$key));
			return false;
		}
		return true;
	}
}