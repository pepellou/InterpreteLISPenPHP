<?php

require_once dirname(__FILE__)."/Parser.php";

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

