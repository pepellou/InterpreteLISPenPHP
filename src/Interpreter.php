<?php

require_once dirname(__FILE__)."/Parser.php";

class Interpreter {

	protected $variables = array();

	public function evaluate(
		$input
	) {
		if ($this->isVariable($input)) {
			if (!isset($this->variables[$input])) {
				throw new Exception();
			}
			return $this->variables[$input];
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

