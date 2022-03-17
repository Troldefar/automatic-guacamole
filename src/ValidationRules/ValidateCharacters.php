<?php

class ValidateCharacter {

	private string $rule = '';
	
	public function __construct($rule = '/[^a-zA-Z0-9]+/') {
		$this->rule = $rule;
	}
	
	public function validateRule($value): bool {
		return !preg_match($this->rule, $value) ? false : true;
	}
	
}