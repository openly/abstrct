<?php 
/**
* Module Name: SQL Utilities 
* Package Name: Abstrct Utilities
* Author: Abhilash Hebbar
* Description: This module has utility functions for generating SQL statements.
*/
define('TABLE_ALIAS_PREFIX','t');
define('ALIAS_SEPERATOR','__');

class SqlUtil extends AbstrctDataClass{

	public function getSelectQuery(){
		return 	'SELECT ' . $this->getDBColumns() .
				' FROM '  . $this->getTables() . $this->getJoins() .
				$this->getClause() . $this->getSort() . $this->getLimits();

	}

	public function getArgs(){
		return $this->args;
	}

	public function getDBColumns($columns){
		$this->data += array('args'=>array(),'joins'=>array(),'tableAlias'=>array(),'joinModels'=>array(),'idColumns'=>array());
		$newColumns = array_filter(array_map(array($this,'columnSQL'), $this->columns));
		return 't0.ID id, ' 
				.(!empty($this->idColumns)?(implode(', ', $this->idColumns) . ', '): '')
				. implode(', ',$newColumns);
	}

	public function getTables(){
		return $this->resources[$this->model] . ' ' . TABLE_ALIAS_PREFIX . '0 ';
	}

	public function getJoins(){
		return implode(' ',$this->joins) .' ';
	}

	public function getClause(){
		$clauses = $this->getClausesFor($this->clauses);
		if(count($clauses)>0)
			return 'WHERE (' . implode(') AND (', $clauses) . ') ';
		return '';
	}

	public function getLimits(){
		if(count($this->limits)<1) return '';
		$limits = "LIMIT ";
		foreach ($this->limits as $key => $value) {
			$limits .= "$key,$value";
		}
		return $limits;
	}

	public function columnSQL($col){
		list($model,$model_col,$tblAlias) = $this->prepareJoin($col);
		if($this->schemas[$model][$model_col])
			return $tblAlias.'.'.$this->schemas[$model][$model_col] . ' ' . 
					str_replace('.', ALIAS_SEPERATOR, $col);
	}

	private function prepareJoin($col){
		list($parts,$col) = $this->seperate($col);
		if(count($parts)<1) return array($this->model,$col, TABLE_ALIAS_PREFIX . '0');
		$curModel = $this->model;
		$joinName = array();
		foreach ($parts as $part) {
			$joinName[] = $part;
			$curModel = $this->addJoin($curModel,$part,implode(ALIAS_SEPERATOR,$joinName));
		}
		$joinName = implode(ALIAS_SEPERATOR,$joinName);
		return array($curModel,$col,$this->tableAlias[$joinName]);
	}

	private function addJoin($model,$column,$name){
		if($this->joins[$name]) return $this->joinModels[$name];
		$relation = array_shift(array_filter($this->relations,$this->filterRelation($model,$column)));
		$tblAlias = TABLE_ALIAS_PREFIX . (count($this->joins) + 1);
		$this->data['joins'][$name] = 'INNER JOIN ' . $relation['dest-resource'] . ' ' . 
						$tblAlias . ' ON ' . $this->prevAliasName($name) . '.' . 
						$relation['src-column'] . '=' . $tblAlias . '.' . $relation['dest-column'];
		$this->data['joinModels'][$name] = $relation['dest-model'];
		$this->data['tableAlias'][$name] = $tblAlias;
		$this->data['idColumns'][$name] = "{$tblAlias}.ID {$name}__id";
		return $relation['dest-model'];
	}

	private function seperate($col){
		$parts = explode('.',$col);
		$col = array_pop($parts);
		return array($parts,$col);
	}

	private function filterRelation($model,$column){
		return function($rel) use ($model,$column){
			return $rel['src-model'] == $model && $rel['column'] == $column;
		};
	}

	private function prevAliasName($name){
		if(preg_match('/(.*)\_\_[^\_\_]*$/',$name,$match))
			return $this->tableAlias[$match[1]];
		else
			return TABLE_ALIAS_PREFIX . '0';
	}

	private function getClausesFor($clausesArr){
		$retval = array();
		foreach ($clausesArr as $k => $v) {
			if(!$k) continue;
			if(is_array($v)){
				if($v['condition']){ 
					$retval[] = $v['condition'];
					$this->data['args'][] = $v['args'];
				}else{
					$retval += $this->getClausesFor($v);
				}
			}else if(is_int($k))
				$retval[] = $k;
			else{
				list($model,$model_col,$tblAlias) = $this->prepareJoin($k);
				$retval[] = "{$tblAlias}." . $this->schemas[$model][$model_col] . " = ?";
				$this->data['args'][] = $v;
			}
		}
		return $retval;
	}
}