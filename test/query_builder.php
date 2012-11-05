<?php 

require_once(__DIR__ . '/../src/factory.php');

class QBTest extends PHPUnit_Framework_TestCase{
	public function testQB(){
		$qb = new AbstrctQueryBuilder;
		$qb->addColumn(array('`kc` kc','`gaju` gaju'));
		$qb->addColumn('`abhi` abhi');
		$qb->addColumn(array('`kc` kc','`gaju` gaju'));
		var_dump($qb);
	}
}