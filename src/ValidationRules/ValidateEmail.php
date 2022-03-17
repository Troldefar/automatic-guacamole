<?php

class ValidateEmail {
	
	private int $email;
	
	public function __construct($email) {
		$this->email = $email;
	}
	
	public function validateRule(): bool {
		return filter_var($this->email, FILTER_VALIDATE_EMAIL) ? true : false;
	}
	
}