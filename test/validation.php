<?php 

require_once ( __DIR__ .'/../src/factory.php' );

class ValidationTest extends PHPUnit_Framework_TestCase
{

	public function testValidation() {
		$v = new AbstrctValidation;
		$v->rules = array(
			'name' => array('required','alphabetic'),
			'email' => array('required','email','field-label'=>'Email'),
			'age'=>array('number','field-label'=>'Age'),
			//'currency'=>array('currency','field-label'=>'Currency'),
			//'contact'=>array('phone','field-label'=>'Contact'),
			//'dob'=>array('date_time','field-label'=>'Date of Birth'),
			'password-match' => array('condition' => 'password == confirm-password','message'=>'Passwords must match.')
		);
		echo "Testing error for empty name.\n";
		$args = array('name'=>'abhi','age'=>"123.123.123",'contact'=>'+919945365412','currency'=>'1.1.21.121.00');//'dob'=>'30/13/1988');
		if($v->validate($args)){
			$this->fail('Email Required validation failed.');
		}else{
			$errs = $v->getErrors();
			var_dump($errs);
			if($errs[0]['field']!= 'email'){
				$this->fail('Error for invalid field');
			}
		}
		// $args = array('name'=>'abhi','email'=>'abhi@openjuice.in','password'=>'abc');
		// if($v->validate($args)){
		// 	//$this->fail('Password match validation is not working.');
		// }
	}
}