<?php 

/**
* Module Name: DataInterfaceStore 
* Package Name: Abstrct Core - Data Interface
* Author: Abhilash Hebbar
* Description: This module is the store of the data interfaces. This creates and supplies single intace of data interface objects.
*/
class DataInterfaceStore extends AbstrctSingleton{
	protected $instances;

	function _getDataInterface($iName,$details,$models){
		if(!is_object($this->instances[$iName])){
			extract($details);
			$className = ucfirst($type) . "DataInterface";
			$args = array('schemas'=>array(),'relations'=>array());
			$modelResources = SchemaUtil::resources($models);
			$args['resources'] = $modelResources;
			foreach ($models as $mName => $model) {
				if($model['data_interface']['name'] != $iName) continue;
				$args['schemas'][$mName] = SchemaUtil::schema($model['fields']);
				$args['relations'] = array_merge(
										$args['relations'],
										SchemaUtil::relations(
											$model['fields'],
											$mName,
											$modelResources
										)
									);
			}
			if($type == 'mysql'){
				$args['_db'] = Database::getDB($iName,$details);
			}
			$this->instances[$iName] = new $className($args);
		}
		return $this->instances[$iName];
	}
}