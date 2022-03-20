<?php

class ValidateMinimum implements ValidationRuleInterface {
	
	private int $minimum;
	
	public function __construct($minimum) {
		$this->minimum = $minimum;
	}
	
	public function validateRule($value): bool {
		return strlen($value) < $this->minimum ? false : true;
	}

	public function getErrorMessage(): string {
        return safer('Input should be larger than ' . $this->minimum);
    }
	
}