<?php

class ValidateMaximum implements ValidationRuleInterface {
	
	private int $maximum;
	
	public function __construct($maximum) {
		$this->maximum = $maximum;
	}
	
	public function validateRule($value): bool {
		return strlen($value) > $this->maximum ? false : true;
	}

	public function getErrorMessage(): string {
        return safer('Input should be less than ' . $this->minimum);
    }
	
}