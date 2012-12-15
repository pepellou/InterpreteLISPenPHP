<?php

require_once dirname(__FILE__)."/../src/Parser.php";

class ParserTest extends PHPUnit_Framework_TestCase {

	/**
	* @dataProvider parse_cases
	*/
	public function test_parse(
		$anInput,
		$expectedOutput
	) {
		$parser = new Parser($anInput);

		$this->assertEquals(
			$expectedOutput,
			$parser->getElements()
		);
	}

	public static function parse_cases(
	) {
		return array(
			array( 
				"(1)", 
				array("1") 
			),
			array( 
				"(1 2)", 
				array("1", "2") 
			),
			array( 
				"(1 2 3)", 
				array("1", "2", "3") 
			),
			array( 
				"(1 (2))", 
				array("1", array("2")) 
			),
			array( 
				"(1  (2))", 
				array("1", array("2")) 
			),
			array( 
				"(quote  (a b c))", 
				array("quote", array("a", "b", "c")) 
			),
		);
	}

	/**
	* @dataProvider numbers
	*/
	public function test_isNumber(
		$aNumber
	) {
		$parser = new Parser("");

		$this->assertTrue($parser->isNumber($aNumber));
	}

	public static function numbers(
	) {
		return array(
			"Sample number (a)" => array("1"),
			"Sample number (b)" => array("12"),
			"Negative" => array("-1"),
			"Explicit positive" => array("+1"),
			"Zero" => array("0"),
			"- Zero" => array("-0"),
			"+ Zero" => array("+0"),
			"Float number" => array("1.2"),
			"Scientific notation (a)" => array("1.2e12"),
			"Scientific notation (b)" => array("1.2e+12"),
			"Scientific notation (c)" => array("1.2e-12"),
			"Ending with point" => array("12."),
			"Starting with point" => array(".12"),
		);
	}

	/**
	* @dataProvider not_numbers
	*/
	public function test_isNumber_fail(
		$aNumber
	) {
		$parser = new Parser("");

		$this->assertFalse($parser->isNumber($aNumber));
	}

	public static function not_numbers(
	) {
		return array(
			"sample variable name" => array("x"),
			"letters & numbers" => array("x1"),
			"identifier starting with - (a)" => array("-a"),
			"identifier starting with - (b)" => array("-12a"),
			"upcase" => array("X"),
			"any length" => array("asjdghadsgdfk"),
			"bad syntax (a)" => array("-12e"),
			"bad syntax (b)" => array("-1..2"),
			"bad syntax (c)" => array("1-2"),
			"bad syntax (d)" => array("."),
			"bad syntax (e)" => array(".e12"),
			"bad syntax (f)" => array("+."),
		);
	}

}
