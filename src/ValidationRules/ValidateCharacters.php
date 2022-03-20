<?php

class ValidateCharacter implements ValidationRuleInterface {

	private string $preg = '';
	
	public function __construct($preg = '/[^a-zA-Z0-9]+/') {
		$this->preg = $preg;
	}
	
	public function validateRule($value): bool {
		return !preg_match($this->preg, $value) ? false : true;
	}

	public function getErrorMessage(): string {
        return safer('Input contains invalid characters');
    }
	
}