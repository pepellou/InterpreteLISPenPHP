<?php

require_once dirname(__FILE__)."/Parser.php";

class Interpreter {

	protected $variables = array();

	public function evaluate(
		$input
	) {
		$parser = new Parser($input);
		if (!$this->isNumber($input)) {
			if ($input[0] == "(") {
				$parsed = $parser->getElements();
				$evaluated = $parsed[1];
				return $this->printOutput($evaluated);
			} else {
				if (!isset($this->variables[$input])) {
					throw new Exception();
				}
				return $this->printOutput($this->variables[$input]);
			}
		}
		return $this->printOutput($input);
	}

	private function printOutput(
		$expression
	) {
		if (is_array($expression)) {
			$parts = array();
			foreach ($expression as $item) {
				$parts []= $this->printOutput($item);
			}
			return "(".implode(" ", $parts).")";
		}
		return $expression;
	}

	private function isNumber(
		$input
	) {
		$parser = new Parser($input);
		return $parser->isNumber($input);
	}

}

