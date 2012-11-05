<?php

require_once(__DIR__ . '/../src/lib/spyc/spyc.php');


class AbstrctClassTest extends PHPUnit_Framework_TestCase
{
	public function testRead() {
		$settings = spyc_load_file(__DIR__ . '/../app.yaml');
		var_dump($settings);
	}

}

