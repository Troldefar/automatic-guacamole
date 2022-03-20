<?php

class ValidateTrim implements ValidationRuleInterface {

    public function validateRule($value): bool {
        return strpos(' ', $value) === false ? true : false;
    }

    public function getErrorMessage(): string {
        return safer('No empty spaces');
    }

}