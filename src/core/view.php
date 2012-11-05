<?php 

/**
* Module Name: View 
* Package Name: Abstrct
* Author: Raghu
* Description: 
*/

class AbstrctView extends AbstrctDataClass
{
	public function render(&$args = null){
		echo $this->getMarkUp($args);
	}

	public function getMarkUp(&$args = null){
		//Read the template files to get the required fields
		if(!$this->template && $this->templateFile)
			$this->template = file_get_contents($this->templateFile);
		
		$m = new Mustache;
		if($this->datasource && in_array('AbstrctDataSourceInterface', array_keys(class_implements($this->datasource)))) {
			//Find the required data and add to the data source
			foreach(MustacheUtil::getReqData($this->template) as $data => $addData){
				$this->datasource->addRequired($data,$addData);
			}
			$this->datasource->getReady($args);
			return $m->render($this->template,$this->datasource);
		}else if($this->masterView){
			foreach(MustacheUtil::getReqData($this->template) as $data => $addData){
				if(preg_match('/\_form$/',$data)){
					$form = preg_replace('/\_form$/','', $data);
					$args[$data] = AbstrctFactory::getForm($form)->getMarkUp();
				}else 
					$args[$data] = AbstrctFactory::getView($data)->getMarkUp();

			}
		}
		return $m->render($this->template,$args);
	}
}