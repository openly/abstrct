<?php 

/**
* Module Name: Required Validation 
* Package Name: Abstrct Validations
* Author: Abhilash Hebbar
* Description: Validates a field for empty value.
*/

class RequiredValidation extends AbstrctDataClass{
	public function validate(&$args,$key,$label = null){
		if(!isset($args[$key]) || empty($args[$key])){
			$this->error = sprintf("Field '%s' is required",($label?$label:$key));
			return false;
		}
		return true;
	}
}