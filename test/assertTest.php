<?php
class AddTest
{
   
   
   }  
   public function writeName(){
   $name = array();
   $name = 'Navya H.K';
   return $name;
   }
    
}
class AddTests extends PHPUnit_Framework_TestCase{
    public function testFunction() {
      $addition = new AddTest;
      echo 'Testing Here';
        $this->assertEquals(4,$addition->add(1,3));
        $this->assertEquals('Navya H.K',$addition->writeName());
    }
    public function testFailure()
    {
        $expected = new stdClass;
        $expected->foo = 'foo';
        $expected->bar = 'bar';
 
        $actual = new stdClass;
        $actual->foo = 'foo';
        $actual->bar = 'bar';
 
        $this->assertEquals($expected, $actual);
    }
    
    public function testEquality() {
        $this->assertEquals(
            array(1,2,3 ,4,5,6),
            array(1,2,3,4,5,6)
        );
    }
    public function test()
    {
    
        $this->assertInternalType('string','ss');
        echo'tested';
        $this->assertRegExp('/foo/', 'foo');
    }

}
?>

