<?php

class Interpreter {

	public function evaluate(
		$input
	) {
		if ($this->isVariable($input)) {
			throw new Exception();
		}
		return $input;
	}

	private function isVariable(
		$input
	) {
		return !$this->isNumber($input);
	}

	private function isNumber(
		$input
	) {
		$parser = new Parser();
		return $parser->isNumber($input);
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

	/**
	* @dataProvider variable_names
	* @expectedException Exception
	*/
	public function test_variableEvaluatesErrorIfNotExist(
		$aVariable
	) {
		$interpreter = new Interpreter();
		
		$interpreter->evaluate($aVariable);
	}

	public static function variable_names(
	) {
		return array(
			"sample variable name" => array("x"),
			"letters & numbers" => array("x1"),
			"identifier starting with - (a)" => array("-a"),
			"identifier starting with - (b)" => array("-12a"),
			"upcase" => array("X"),
			"any length" => array("asjdghadsgdfk"),
		);
	}

}
