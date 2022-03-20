<?php

class ValidateEmail implements ValidationRuleInterface {
	
	private int $email;
	
	public function __construct($email) {
		$this->email = $email;
	}
	
	public function validateRule($value): bool {
		return filter_var($this->email, FILTER_VALIDATE_EMAIL) ? true : false;
	}

	public function getErrorMessage(): string {
        return safer('Input contains invalid characters');
    }
	
}