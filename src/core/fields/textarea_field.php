<?php 

/**
* Module Name: TextField 
* Package Name: Abstrct Form/Fields
* Author: Abhilash Hebbar
* Description: This class is responsible for providing the data for rendering the text field
*/

class TextareaField extends AbstrctField{
	public function getReady($args){
		//var_dump($this->details);
		$fieldName = $this->details["name"];
		$this->textarea = true;
		$this->fieldname = $fieldName;
		$this->label = $this->details["label"];

		$this->disabled = isset($this->details["editable"]) && !$this->details["editable"];
		//$this->placeholder = $fieldName;
		//$this->classes = $fieldName;
		
		if(isset($this->addData["values"]) && isset($this->addData["values"][$fieldName]))
			$this->value = $this->addData["values"][$fieldName];
	}
}