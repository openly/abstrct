<?php 

/**
* Module Name: SelectField 
* Package Name: Abstrct Form/Fields
* Author: Abhilash Hebbar
* Description: This class is responsible for providing the data for rendering the password field
*/

class SelectField extends AbstrctField{
	public function getReady($args){
		$fieldName = $this->details["name"];
		$this->tag = "select";
		$this->fieldname = $fieldName;
		$this->label = $this->details["label"];

		$this->disabled = isset($this->details["editable"]) && !$this->details["editable"];

		//$this->placeholder = $fieldName;
		//$this->classes = $fieldName;

		if(isset($this->addData["values"]) && isset($this->addData["values"][$fieldName]))
			$selectedValue = $this->addData["values"][$fieldName];

		$this->select = true;

		$options = $this->details['options'];
		$finalOptions = array();
		if(is_array($options)){
			foreach($options as $value=>$label){
				if((is_array($selectedValue) && in_array($value, $selectedValue)) || $selectedValue == $value)
					$finalOptions[] = array("value" => $value, "label" => $label, "selected"=>true);
				else{
					$finalOptions[] = array("value" => $value, "label" => $label);
				}
			}
		}elseif(is_object($options)){// && get_class($options) == "")
			foreach($options->data->options as $value=>$label){
				if((is_array($selectedValue) && in_array($value, $selectedValue)) || $selectedValue == $value)
					$finalOptions[] = array("value" => $value, "label" => $label, "selected"=>true);
				else
					$finalOptions[] = array("value" => $value, "label" => $label);
			}
		}
		$this->options = $finalOptions;
	}
}