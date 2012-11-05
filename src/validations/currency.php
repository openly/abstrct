<?php 

/**
* Module Name: Currency Validation 
* Package Name: Abstrct Validations
* Author: Raghu
* Description: Validates a field for currency value.
*/

//To Do: It's not independent of the regions, better to remove it
class CurrencyValidation extends AbstrctDataClass{
	public function validate(&$args,$key,$label = null){
		if(isset($args[$key]) && !empty($args[$key]) && 
			! preg_match('/^\$?.?.?.?[1-9]\d*(?:\.?\d{0,2})?$/',$args[$key])){
			$this->error = sprintf("Please enter valid currency in '%s'",($label?$label:$key));
			return false;
		}
		return true;
	}
}