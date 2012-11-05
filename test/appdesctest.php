<?php

require_once(__DIR__ . '/../src/factory.php');

class AppDescTest extends PHPUnit_Framework_TestCase
{

	protected $appDesc ;

	protected function setUp(){
		$this->appDesc = new AbstrctAppDesc;
	}

	public function testModel() {
		echo "Checking the number of models: ";
		echo count($this->appDesc->models) . "\n";
		$this->assertEquals(2,count($this->appDesc->models));

		echo "Testing exception when requesting invalid model.";

		try{
			$this->appDesc->getModelDesc('model1');
		}catch(Exception $e){
			return;
		}
		$this->fail('Did not catch exception when trying to load invalid object.');
	}

	public function testForm(){
		echo "Checking the number of forms: ";
		echo count($this->appDesc->forms) . "\n";
		$this->assertEquals(2,count($this->appDesc->forms));

		$form = $this->appDesc->getFormDesc('employee_registration');

		var_dump($form);

		echo "Testing exception when requesting invalid form.";

		try{
			$this->appDesc->getFormDesc('form1');
		}catch(Exception $e){
			return;
		}
		$this->fail('Did not catch exception when trying to load invalid object.');
	}

}

