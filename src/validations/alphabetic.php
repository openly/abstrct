<?php 

/**
* Module Name: Alphabetic Validation 
* Package Name: Abstrct Validations
* Author: Raghu
* Description: Validates a field for alphabetcs value.
*/

class AlphabeticValidation extends AbstrctDataClass{
	public function validate(&$args,$key,$label = null){
		$testVal = preg_replace('/\s/', '', $args[$key]);
		if(isset($args[$key]) && !empty($args[$key]) && ! ctype_alpha($testVal)){
			$this->error = sprintf("'%s' must be alphabetic",($label?$label:$key));
			return false;
		}
		return true;
	}
}