<?php 

/**
* Module Name: TextField 
* Package Name: Abstrct Form/Fields
* Author: Abhilash Hebbar
* Description: This class is responsible for providing the data for rendering the text field
*/

class TextField extends AbstrctField{
	public function getReady($args){
		//var_dump($this->details);
		$fieldName = $this->details["name"];
		$this->input = true;
		$this->tag = "input";
		$this->type = "text";//Not required for input type="text"
		$this->fieldname = $fieldName;
		$this->label = $this->details["label"];

		$this->disabled = isset($this->details["editable"]) && !$this->details["editable"];
		$this->placeholder = $this->label;
		//$this->classes = $fieldName;

		
		if(isset($this->addData["values"]) && isset($this->addData["values"][$fieldName]))
			$this->value = $this->addData["values"][$fieldName];
	}
}