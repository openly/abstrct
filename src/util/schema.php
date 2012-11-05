<?php 

/**
* Module Name: Schema Utility 
* Package Name: Abstrct Utility
* Author: Abhilash Hebbar
* Description: This module is responsible for genrating required arras for passing the schemas between the objects.
*/

/**
* 
*/
class SchemaUtil
{
	public static function schema($fields){
		$filtered = array_filter($fields,array(self,'persist'));
		$retval = array('id'=>'ID');
		foreach ($filtered as $name => $field) {
			$retval[$name] = isset($field['column'])?$field['column']:$name;
		}
		return $retval;
	}

	public static function relations($fields,$model,$modelResources){
		$filtered = array_filter($fields,array(self,'hasRelations'));
		$retval = array();
		foreach ($filtered as $name => $field) {
			$retval[] = array(
				'src-resource' 	=> $modelResources[$model],
				'dest-resource' => $modelResources[$field['relation']['model']],
				'src-column'	=> ($field['relation']['type'] == 'many-to-one' 
									 || $field['relation']['type'] == 'many-to-many' ) ? 
									$field['relation']['join-column']:'id',
				'dest-column'	=> ($field['relation']['type'] == 'many-to-one' 
									 || $field['relation']['type'] == 'many-to-many' ) ?
									'id' : $field['relation']['join-column'],
				'type'			=> $field['relation']['type'],
				'src-model'		=> $model,
				'dest-model'	=> $field['relation']['model'],
				'column'		=> $name
			);
		}
		return $retval;
	}

	public static function resources($models){
		return array_map(array(self,'resourceName'), $models);
	}

	static function persist($field){ return !isset($field['no_persist']); }

	static function hasRelations($field){ return is_array($field['relation']); }

	static function resourceName($model){ return $model['data_interface']['resource']; }
}