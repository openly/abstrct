<?php 

/**
* Module Name: RadioField 
* Package Name: Abstrct Form/Fields
* Author: Abhilash Hebbar
* Description: This class is responsible for providing the data for rendering the checkbox field
*/

class RadioField extends AbstrctField{
	public function getReady($args){
		$this->multipleInput = true;
		$this->tag = "input";
		$this->type = "radio";
		$this->label = $this->details["label"];
		$this->fieldname = $this->details["name"];

		$this->disabled = isset($this->details["editable"]) && !$this->details["editable"];

		//$this->placeholder = $fName;
		//$this->classes = $fName;
		
		if(isset($this->addData["values"]) && isset($this->addData["values"][$fieldName]))
			$selectedValue = $this->addData["values"][$fieldName];

		$values = $this->details['values'];
		if(is_array($values)){
			foreach($values as $value=>$label){
				if((is_array($selectedValue) && in_array($value, $selectedValue)) || $selectedValue == $value)
					$finalValues[] = array("value" => $value, "label" => $label, "checked"=>true);
				else{
					$finalValues[] = array("value" => $value, "label" => $label);
				}
			}
			$this->fieldname .= "[]";
		}elseif(is_object($values)){// && get_class($options) == "")
			foreach($values->data->values as $value=>$label){
				if((is_array($selectedValue) && in_array($value, $selectedValue)) || $selectedValue == $value)
					$finalValues[] = array("value" => $value, "label" => $label, "checked"=>true);
				else
					$finalValues[] = array("value" => $value, "label" => $label);
			}
			$this->fieldname .= "[]";
		}else{
			if($selectedValue == $fieldName)
				$finalValues[] = array("value" => $fieldName, "checked"=>true);
			else
				$finalValues[] = array("value" => $fieldName);

							
		}

		$this->values = $finalValues;
	}
}