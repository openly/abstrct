<?php 

/**
* Module Name: Data Interface Implementation
* Package Name: Abstrct
* Author: Abhilash Hebbar
* Description: 
*/

Class MysqlDataInterface extends AbstrctDataClass implements AbstrctDataInterface {
	private function generateQuery($data){
		$sqlUtil = new SqlUtil(
			array(
				'schemas' 	=> $this->schemas,
				'relations' => $this->relations,
				'resources'	=> $this->resources,
				'model'		=> $data->name,
				'columns'	=> $data->columns,
				'clauses'	=> $data->clauses,
				'sort'		=> $data->sort,
				'limits'	=> $data->limits
			)
		);
		return array($sqlUtil->getSelectQuery(),$sqlUtil->getArgs());
	}

	public function getOne($data){
		$data->addLimit(1);
		return $this->getAll($data);			
	}

	public function getAll($data){
		@list($query,$args) = $this->generateQuery($data);
		return DataFormatUtil::format($this->_db->getAll($query,$args));
	}

	//Search returns multiple values
	public function search($args){

	}

	public function save($data,$newData){
		$modelName = $data['name'];
		$tableName = $this->resources[$modelName];
		if(empty($isNew))
			$isNew = !(isset($data['values']['id']) && $data['values']['id'] > 0);

		$val = array();
		if($isNew){
			$oper = "INSERT INTO";
		}else{
			$oper = "UPDATE";
			$where = " WHERE `ID` = {$data['values']['id']}";//Assumed ID will be always an integer
		}
		
		$query = "$oper $tableName SET ";

		if(isset($data['values']))
			$data['values'] = array_merge($data['values'],$newData);
		else
			$data['values'] = $newData;

		foreach($this->schemas[$data['name']] as $key=>$column){
			if($key == "id") continue;
			if(isset($data['values'][$key])){
				$query .= "`$column` = ?,";
				$val[] = $data['values'][$key];
			}
		}
		$query = substr($query,0,-1);

		$query .= $where;
		try{
			$this->_db->execute($query,$val);
			return $isNew ? $this->_db->Insert_ID(): $this->_db->Affected_Rows();
		}catch(Exception $e){
			ExceptionUtil::exception("Error saving model: {$e->getMessage()}");
		}
	}

	public function delete($data,$condition){
		$modelName = $data['name'];
		$tableName = $this->resources[$modelName];
		$query = "DELETE FROM $tableName";
		if(is_numeric($condition))
			$where = " WHERE `ID` = $condition";
		else
			$where = " WHERE $condition";
		try{
			$this->_db->execute($query.$where);
			$affectedRows = $this->_db->Affected_Rows();
			return $affectedRows;
		}catch(Exception $e){
			ExceptionUtil::exception("Error deleting model: {$e->getMessage()}");
		}
	}
}