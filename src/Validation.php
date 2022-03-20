<?php

class Validate {
	
	private array $rules;
	private array $errorMessages = [];
	
	public function __construct() {
		
	}
	
	public function addRule(ValidationRuleInterface $rule) {
		$this->$rules[] = $rule;
		return $this;
	}
	
	public function validate($value): bool {
		foreach ($this->rules as $rule) if (!$rule->validationRule($value)) {
			$this->errorMessages[] = $rule->getErrorMessage();
			return false;
		}
		return true;
	}

	public function getAllErrorMessages(): array {
		return $this->errorMessages;
	}
	
}