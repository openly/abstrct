<?php 

/**
* Module Name: Required Validation 
* Package Name: Abstrct Validations
* Author: Abhilash Hebbar
* Description: Validates a field for email value.
*/

class EmailValidation extends AbstrctDataClass{
	public function validate(&$args,$key,$label = null){
		if(isset($args[$key]) && !empty($args[$key]) && ! preg_match('/.+@.+\..+/', $args[$key])){
			$this->error = sprintf("Please enter valid email address in '%s'",($label?$label:$key));
			return false;
		}
		return true;
	}
}