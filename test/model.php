<?php
require_once(__DIR__ . '/../src/factory.php');
class ModelTest extends PHPUnit_Framework_TestCase
{
	public function testing(){
		$e = AbstrctFactory::getModel('employee')
				->load(24)
				->addRequired('name')->addRequired('employer_email')->addRequired('designation')
				->addRequired('employer',array('employees'=>array('name' => null,'employer_email' => null),'name'=>null))
				->getAll()
		;
		var_dump($e);
	}

	public function testsaveForm(){
		$args = array("id"=>24,"employer"=>1);
		$e = AbstrctFactory::getModel('employee');
		$e->values = $args;
		$result = $e->save();
		var_dump($result);
	}

}
