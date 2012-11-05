<?php 

/**
* Module Name: Database 
* Package Name: Abstrct Library wrapper
* Author: Abhilash Hebbar
* Description: Wrapper on ADODB
*/

require_once (__DIR__ . '/adodb5/adodb.inc.php');
require_once (__DIR__ . '/adodb5/adodb-exceptions.inc.php');
require_once (__DIR__ . '/adodb5/adodb-active-record.inc.php');
require_once (__DIR__ . '/adodb5/adodb-xmlschema03.inc.php');

class Database extends AbstrctSingleton{
	protected $instances;

	function _getDB($name,$details){
		if(!is_object($this->instances[$name])){
			extract($details);
			$this->instances[$name] = NewADOConnection($type);
			$this->instances[$name]->Connect($host,$user,$password,$database);
			$this->instances[$name]->setFetchMode(ADODB_FETCH_ASSOC);
		}
		return $this->instances[$name];
	}
}