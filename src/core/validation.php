<?php 

/**
* Module Name: Abstrct Validations 
* Package Name: Abstrct core
* Author: Raghu, Abhilash Hebbar
* Description: This class is resposible for validation. It happens in 2 ways. With a single field and with multiple fields. We use a expression handler for validation for multiple fields.
*/

class AbstrctValidation extends AbstrctDataClass
{
	public function validate(&$args){
		ExceptionUtil::notNull($this->rules,'Rules','Validate AbstrctValidation');
		$errors = array();
		foreach ($this->rules as $field => $validations) {
			if(isset($validations['condition'])){
				// Use expression
			}else{
				$fieldLabel = $validations['field-label'];
				unset($validations['field-label']);
				foreach ($validations as $validationType) {
					$vClass = AutoloadUtil::getUserClassName($validationType,'Validation');
					$v = new $vClass;
					if(!$v->validate($args,$field,$fieldLabel)){
						$errors[] = array('field'=>$field,'message'=>$v->error);
					}
				}
			}
		}
		$this->errors = $errors;
		return $this->isSuccess();
	}

	public function hasErrors(){ return count($this->errors) > 0; }

	public function isSuccess(){ return !$this->hasErrors(); }

	public function getErrors(){ return $this->errors; }
}