<?php 
require_once(__DIR__ . '/../src/factory.php');
require_once(__DIR__ . '/../src/util/mustache.php');
class FormTest extends PHPUnit_Framework_TestCase
{
	public function testForm() {
		$f = AbstrctFactory::getForm('employee_registration');
		$f->render();
	}

}