<?php 

/**
* Module Name: Integer Validation 
* Package Name: Abstrct Validations
* Author: Raghu
* Description: Validates a field for datetime value.
*/

//To DO: need to take care of the time zones here
class DateTimeValidation extends AbstrctDataClass{
	public function validate(&$args,$key,$label = null){
		$date = strtotime($args[$key]);
		if(isset($args[$key]) && !empty($args[$key]) && ($date === false || $date == -1)){
			$this->error = sprintf("Please enter valid date/time in '%s'",($label?$label:$key));
			return false;
		}
		return true;
	}
}