<?php

class Parser {

	private $input;
	private $parsePosition;

	public function __construct(
		$input
	) {
		$this->input = $input;
	}

	public function isNumber(
		$input
	) {
		$valid_chars = array(
			'+', '-', 'e', 'E', '.',
			'0', '1', '2', '3', '4', '5', '6', '7', '8', '9'
		);
		for ($i = 0; $i < strlen($input); $i++) {
			if (!in_array($input[$i], $valid_chars)) {
				return false;
			}
		}
		return preg_match("/^[+-]?([0-9]*\.[0-9]+|[0-9]+\.[0-9]*|[0-9]+)([eE][+-]?[0-9]+)?$/", $input) != false;
	}

	public function getElements(	
	) {
		$this->parsePosition = 0;
		$elements = $this->parse();
		return $elements[0];
	}

	private function parse(
	) {
		$results = array();
		$atom_name = "";
		while ($this->parsePosition < strlen($this->input)) {
			$current_char = $this->input[$this->parsePosition++];
			switch ($current_char) {
				case '(':
					$results []= $this->parse();
					break;
				case ')':
					if ($atom_name != "") {
						$results []= $atom_name;
					}
					return $results;
				case ' ':
					if ($atom_name != "") {
						$results []= $atom_name;
						$atom_name = "";
					}
					break;
				default:
					$atom_name = $atom_name . $current_char;
			}
		}
		return $results;
	}

}
