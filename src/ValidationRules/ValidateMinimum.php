<?php

class ValidateMinimum {
	
	private int $minimum;
	
	public function __construct($minimum) {
		$this->minimum = $minimum;
	}
	
	public function validateRule(): bool {
		return strlen($value) < $this->minimum ? false : true;
	}
	
}