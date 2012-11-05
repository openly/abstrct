<?php 

/**
* Module Name: Phone Validation 
* Package Name: Abstrct Validations
* Author: Raghu
* Description: Validates a field for phone value.
*/

//To Do: It's not independent of the regions, better to remove it
class PhoneValidation extends AbstrctDataClass{
	public function validate(&$args,$key,$label = null){
		if(isset($args[$key]) && !empty($args[$key]) && 
			! preg_match('/^[0-9\-\+\. \(\)]+$/',$args[$key])){
			$this->error = sprintf("Please enter valid phone number in '%s'",($label?$label:$key));
			return false;
		}
		return true;
	}
}