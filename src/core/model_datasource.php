<?php

/**
* 
*/
class ModelDataSource extends AbstrctSearchHelper implements AbstrctDataSourceInterface
{
	public function addRequired($data,$addData = null){
		if($data == 'rows'){
			foreach ($addData as $key => $row) {
				$this->addRequired($key,$row);
			}
			return $this;
		}
		if(is_array($addData)){
			foreach ($addData as $key => $value) {
				$this->addRequired("{$data}.{$key}", $value);
			}
		}else
			$this->addColumn($data);
		return $this;
	}

	public function getReady($args){
		$this->addClause($args);
		$rows = $this->getAll();
		$firstKey = array_shift(array_keys($rows));
		if(is_numeric($firstKey)){
			$this->data['rows'] = array();
			foreach($rows as $row) $this->data['rows'][] = $row;
		}
		else
			$this->data = array_merge($this->data,$rows);
		return $this;
	}
	public function isReady(){}

	public function get(){
		return $this->_interface->getOne($this);
	}

	public function getAll(){
		return $this->_interface->getAll($this);
	}
}