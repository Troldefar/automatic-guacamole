<?php

class Cli {

    private array $args = [];

    public function __construct(array $args) {
        unset($arguments[0]);
        $this->args = $args;
    }

    public function generate(): bool {
        unset($this->args[0]);
        try {
            var_dump($this->args);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

}