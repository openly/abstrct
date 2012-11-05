<?php

/**
* Module Name: Abstrct Object Factory 
* Package Name: Main
* Author: Abhilash Hebbar
* Description: This is the factory class responsible for creating the FW objects and autoloading the required files.
*/

// Include autoloader utilities & classes that are needed by factory before autoloader is initalized.
require_once (__DIR__ . '/util/autoload.php');

class AbstrctFactory extends AbstrctSingleton{

	protected function init(){
		$this->appDesc = new AbstrctAppDesc;
	}

	public function _getModel($name){
		$modelDesc = $this->appDesc->getModeldesc($name);
		$modelClassName = AutoloadUtil::getUserClassName($name,'Model');
		$interface = DataInterfaceStore::getDataInterface(
						$modelDesc['data_interface']['name'],
						$this->appDesc->getDataInterface($modelDesc['data_interface']['name']),
						$this->appDesc->models
					);
		$model = (class_exists($modelClassName))?(new $modelClassName):(new AbstrctModel);
		$model->_interface = $interface;
		$model->name = $name;
		return $model;
	}

	public function _getForm($name){
		$v = new AbstrctView;
		$v->templateFile = AutoloadUtil::getTemplate($name,'form','form');
		$v->datasource = new AbstrctForm($this->appDesc->getFormDesc($name));
		return $v;
	}

	public function _getValidation($name){
		$v = new AbstrctValidation($this->appDesc->getValidationDesc($name));
		return $v;
	}

	public function _getField($details,$addData){
		extract($details);
		$fieldClassName = AutoloadUtil::getUserClassName($type,'Field');
		$v = new AbstrctView;
		$v->templateFile = AutoloadUtil::getTemplate($type,'form/field','field');
		$v->datasource = new $fieldClassName(array('details' => $details,'addData'=>$addData));
		return $v->getMarkup();
	}
	
	public function _getView($name){
		$v = new AbstrctView;
		if($desc = $this->appDesc->getViewDesc($name)){
			if($desc['model']){
				$v->datasource = self::getModel($desc['model'])->getDataSource();
			}
		}else
			$v->masterView = true;
		$v->templateFile = AutoloadUtil::getTemplate($name);
		return $v;
	}
	public function _getController($name){}
}