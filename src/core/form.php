<?php 

/**
* Module Name: Abstrct Form 
* Package Name: Abstrct Core
* Author: Abhilash Hebbar
* Description: This module is resposible for rendering the form
*/

class AbstrctForm extends AbstrctDataClass implements AbstrctDataSourceInterface{
	public function addRequired($data,$addData = null){
		if($data = 'fields') $this->fields = $this->getFields($addData);
		else if(preg_match('/^fields\_exclude\_(.*)$/', $data, $match))
			$this->{$data} = $this->getFields($addData,null,explode('__',$match[1]));
		else if(preg_match('/^fields_(.*)$/', $data,$match))
			$this->{$data} = $this->getFields($addData,explode('__',$match[1]));
		else if(preg_match('/^(.*)\_field$/', $data,$match))
			$this->{$data} = AbstrctFactory::getField($field,$addData);
	}
	public function getReady($args){ $this->isReady = true; }
	public function isReady(){ return $this->isReady; }

	private function getFields($addData,$include = null,$exclude=null){
		$reqFields = is_array($include)?$include:$this->fields;
		if(is_array($exclude)) $reqFields = array_diff($reqFields, $exclude);
		$retval = array();
		foreach ($reqFields as $key=>$field) {
			$field["name"] = $key;
			$retval[] = AbstrctFactory::getField($field,$addData);
		}
		return $retval;
	}
}