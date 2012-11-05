<?php 


/**
* Module Name: AbstrctClass 
* Package Name: Abstrct
* Author: Abhilash Hebbar
* Description: This class implements generic function call methods which can call 2 additional method on_before and on_after
*/
class AbstrctDataClass extends AbstrctClass{
	protected $data = array();
	
	public function __construct($args=null){
		if(is_array($args))
			$this->data = $args;
	}

	public function __get($field){return $this->data[$field];}

	public function __set($field,$value){ 
		$this->data[$field] = $value;
	}

	public function __isset($field){return isset($this->data[$field]);}
	public function __toString(){return print_r($this->data,true);}
}