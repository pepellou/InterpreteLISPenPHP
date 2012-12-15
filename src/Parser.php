<?php

class Parser {

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

}
