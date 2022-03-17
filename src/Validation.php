<?php

class Validate {
	
	private array $rules;
	
	public function __construct() {
		
	}
	
	public function addRule($rule) {
		$this->$rules[] = $rule;
		return $this;
	}
	
	public function validate($value): bool {
		foreach ($this->rules as $rule) {
			if (!$rule->validationRule($value)) return false;
		}
		return true;
	}
	
}