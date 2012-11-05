<?php 

/**
* Module Name: PasswordField 
* Package Name: Abstrct Form/Fields
* Author: Abhilash Hebbar
* Description: This class is responsible for providing the data for rendering the password field
*/

class PasswordField extends AbstrctField{
	public function getReady($args){
		$fieldName = $this->details["name"];
		$this->input = true;
		$this->tag = "input";
		$this->type = "password";
		$this->fieldname = $fieldName;
		$this->label = $this->details["label"];

		$this->disabled = isset($this->details["editable"]) && !$this->details["editable"];

		//$this->placeholder = $fieldName;
		//$this->classes = $fieldName;
		
		if(isset($this->addData["values"]) && isset($this->addData["values"][$fieldName]))
			$this->value = $this->addData["values"][$fieldName];
	}
}