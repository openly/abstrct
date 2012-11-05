<?php

require_once(__DIR__ . '/../src/factory.php');

class DBTest extends PHPUnit_Framework_TestCase{
	function testMysqlDataInterface(){
		$model = AbstrctFactory::getModel('employee');
		echo "Load:\n";
		$model = $model->load(2)->get();
		var_dump($model);
	}
}

