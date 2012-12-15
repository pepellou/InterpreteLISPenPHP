<?php

require_once dirname(__FILE__)."/../src/Interpreter.php";

class InterpreterTest extends PHPUnit_Framework_TestCase {

	public function test_numbersAreEvaluatedAsThemselves(
	) {
		$aNumber = "12";
		$interpreter = new Interpreter();
		
		$this->assertEquals(
			$aNumber,
			$interpreter->evaluate($aNumber)
		);
	}

	/**
	* @expectedException Exception
	*/
	public function test_variableEvaluatesErrorIfNotExist(
	) {
		$aVariable = "x";
		$interpreter = new Interpreter();
		
		$interpreter->evaluate($aVariable);
	}

}
