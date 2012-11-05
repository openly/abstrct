<?php 

/**
* Module Name: HiddenField 
* Package Name: Abstrct Form/Fields
* Author: Abhilash Hebbar
* Description: This class is responsible for providing the data for rendering the hidden field
*/

class HiddenField extends AbstrctField{
	public function getReady($args){
		$fieldName = $this->details["name"];
		$this->input = true;
		$this->tag = "input";
		$this->type = "hidden";
		$this->fieldname = $fieldName;
		
		if(isset($this->addData["values"]) && isset($this->addData["values"][$fieldName]))
			$this->value = $this->addData["values"][$fieldName];
		else if(isset($this->details["default"])){
			$this->value = $this->details["default"];
		}
	}
}