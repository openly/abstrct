<?php

require_once(__DIR__ . '/../src/core/class.php');
require_once(__DIR__ . '/../src/core/data_class.php');
require_once(__DIR__ . '/../src/core/view.php');
require_once(__DIR__ . '/../src/lib/mustache.php');
require_once(__DIR__ . '/../src/util/mustache.php');
require_once(__DIR__ . '/../src/util/exception.php');
require_once(__DIR__ . '/../src/core/interface/data_source_interface.php');

class TestDS extends AbstrctDataClass implements AbstrctDataSourceInterface{
	public function addRequired($data,$addData = null){
		if(!is_array($addData))
			$this->{$data} = "Sample $data";
		else{
			if(count($addData)<1){
				$this->{$data} = array("Sample $data 1","Sample $data 2");
				return;
			}
			$subDS = new TestDS;
			foreach ($addData as $key => $value) {
				$subDS->addRequired($key,$value);
			}
			$this->{$data} = $subDS;
		}

		$this->isReady = true;
	}
	public function getReady(){}
	public function isReady(){return $this->isReady;}
}

class ViewTest extends PHPUnit_Framework_TestCase
{
	public function testGetBodyMarkUp() {
    	$view = new AbstrctView();
    	$view->templateFile = __DIR__ . '/../bodyTemplate.html';
    	$view->datasource = new TestDS;
    	$view->render();
    	var_dump($view->datasource);
    	$m = new Mustache;
    	echo $m->render('{{#a}}{{a}}{{/a}}',array('a'=>'a'));
	}

}