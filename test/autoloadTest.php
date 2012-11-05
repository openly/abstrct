<?php

require_once(__DIR__ . '/../src/factory.php');

class AutoloadTest extends PHPUnit_Framework_TestCase
{
	public function testUserClassName() {
		echo "Checking EmployeeModel = " .AutoloadUtil::getUserClassName('employee','Model') . "\n";
		$this->assertEquals('EmployeeModel',AutoloadUtil::getUserClassName('employee','Model'));
		echo "Checking OfficeAddressModel = " .AutoloadUtil::getUserClassName('office_address','Model') . "\n";
		$this->assertEquals('OfficeAddressModel',AutoloadUtil::getUserClassName('office_address','Model'));
	}

	public function testAutoLoad(){
		echo "Test loading AbstrctModel.\n";
		$a = new AbstrctModel;
		echo "Test loading AbstrctDataInterface.\n";
		$a = new MysqlDataInterface;
		echo "Test loading AbstrctModel.\n";
		echo "Test loading AbstrctModel.\n";
		echo "Test loading AbstrctModel.\n";
	}
}