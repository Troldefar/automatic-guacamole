<?php

class Auth {
	
	public function __construct() {
		
	}
	
	public function login(): bool {

		$test = $_POST['test'];
		
		$validation = new Validation();
		
		if (!$validation
			->addRule(new ValidateMinimum(3))
			->addRule(new ValidateMaximum(20))
			->addRule(new ValidateCharacters())
			->addRule(new ValidateTrim())
			->validate($test)
		) {
			$_SESSION['auth']['errors'] = $validation->getAllErrorMessages();
		}
		
		return true;
		
	}
	
}