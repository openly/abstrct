<?php 

/**
* Module Name: Model 
* Package Name: Abstrct
* Author: Abhilash Hebbar
* Description: This class provides the bindings to interact with the data interfaces. This class manages the CURD operations of the data, and also some level of Business logic.
*/

class AbstrctModel extends AbstrctDataClass{
	
	protected function _load($id=null){
		ExceptionUtil::notNull($id,"ID","Load model " . $this->name);
		return new ModelDatasource(array(
				'_interface'	=> $this->_interface,
				'clauses'		=> array('id'=>$id),
				'name' 			=> $this->name
			)
		);
	}

	protected function _searchOne($args){
		return new ModelDatasource(array(
				'_interface'	=> $this->_interface,
				'clauses'		=> $args,
				'name' 			=> $this->name
			)
		);
	}
	
	protected function _search($args){
		return new ModelListDatasource(array(
				'_interface'	=> $this->_interface,
				'clauses'		=> $args,
				'name'			=> $this->name
			)
		);
	}

	protected function _getDataSource($args = null){
		return new ModelDatasource(array(
				'_interface'	=> $this->_interface,
				'clauses'		=> $args,
				'name'			=> $this->name
			)
		);
	}

	protected function _save($newData = null){
		return $this->_interface->save($this->data,$newData);
	}

	protected function _delete($id=null){
		ExceptionUtil::notNull($id,"ID","Delete model " . $this->name);
		$this->_interface->delete($this->data,$id);	
	}

	public function generateSchema(){ return $this->_interface->generateSchema(); }
}