<?php

class Interpreter {

	public function evaluate(
		$input
	) {
		return $input;
	}

}

class InterpreterTest extends PHPUnit_Framework_TestCase {

	/**
	* @dataProvider numbers
	*/
	public function test_numbersAreEvaluatedAsThemselves(
		$aNumber
	) {
		$interpreter = new Interpreter();
		
		$this->assertEquals(
			$aNumber,
			$interpreter->evaluate($aNumber)
		);
	}

	public static function numbers(
	) {
		return array(
			"Sample number (a)" => array("1"),
			"Sample number (b)" => array("12"),
			"Negative" => array("-1"),
			"Zero" => array("0"),
			"Float number" => array("1.2"),
		);
	}

}
