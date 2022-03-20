<?php

interface ValidationRuleInterface {
    
    public function validateRule($value): bool;
    public function getErrorMessage(): string;

}