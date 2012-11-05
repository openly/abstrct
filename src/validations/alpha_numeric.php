<?php 

/**
* Module Name: Alpha Numeric Validation 
* Package Name: Abstrct Validations
* Author: Raghu
* Description: Validates a field for alpha numeric value.
*/

class AlphaNumericValidation extends AbstrctDataClass{
	public function validate(&$args,$key,$label = null){
		if(isset($args[$key]) && !empty($args[$key]) && ! ctype_alnum($args[$key])){
			$this->error = sprintf("'%s' must be alpha-numeric",($label?$label:$key));
			return false;
		}
		return true;
	}
}