<?php

class Auth {
	
	public function __construct() {
		
	}
	
	public function login(): bool {
		
		$validation = new Validation();
		
		if (!$validation
			->addRule(new ValidateMinimum(3))
			->addRule(new ValidateMaximum(20))
			->validate($_POST['test'])
		) {
			$_SESSION['auth']['error'] = 'Error';
		}
		
		return true;
		
	}
	
}