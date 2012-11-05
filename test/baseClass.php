<?php
require_once(__DIR__ . '/../src/class.php');
require_once(__DIR__ . '/../src/util/array.php');

/**
* 
*/
class AClass extends AbstrctDataClass
{
	protected $array = array();

	protected function _addEl($el){
		echo "In addEl\n";
		var_dump($el);
		$this->array[] = $el;
		return $el+1;
	}

	public function on_before_addEl($el){
		echo "In on before\n";
		var_dump($el);
		$this->array[] = $el;
		return $el+1;
	}

	public function on_after_addEl($el){
		echo "In on after\n";
		var_dump($el);
		$this->array[] = $el;
		return $el+1;
	}

	public function getData(){
		return $this->array;
	}
}


class AbstrctClassTest extends PHPUnit_Framework_TestCase
{
	public function testFunction() {
		$obj = new AClass;
		echo "Testing returned value.\n";
		$this->assertEquals(4,$obj->addEl(1));
		$arr = $obj->getData();
		echo "Testing the function calls.\n";
		var_dump($arr);
		$this->assertEquals(1,$arr[0]);
		$this->assertEquals(2,$arr[1]);
		$this->assertEquals(3,$arr[2]);
	}

}

