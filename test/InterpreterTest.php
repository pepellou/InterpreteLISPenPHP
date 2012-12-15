<?php

require_once dirname(__FILE__)."/../src/Interpreter.php";

class TestableInterpreter extends Interpreter {

	public function setVariable(
		$var,
		$value
	) {
		$this->variables[$var] = $value;
	}

}

class InterpreterTest extends PHPUnit_Framework_TestCase {

	private $testee;

	public function setUp(
	) {
		$this->testee = new TestableInterpreter();
	}

	public function test_numbersAreEvaluatedAsThemselves(
	) {
		$aNumber = "12";
		
		$this->assertEquals(
			$aNumber,
			$this->testee->evaluate($aNumber)
		);
	}

	/**
	* @expectedException Exception
	*/
	public function test_variableEvaluatesErrorIfNotExist(
	) {
		$aVariable = "x";
		
		$this->testee->evaluate($aVariable);
	}

	public function test_variableEvaluatesToValueIfExist(
	) {
		$aVariable = "x";
		$aValue = "12";
		$this->testee->setVariable($aVariable, $aValue);
		
		$this->assertEquals(
			$aValue,
			$this->testee->evaluate($aVariable)
		);
	}

}
