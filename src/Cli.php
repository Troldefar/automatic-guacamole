<?php

class Cli {

    private array $args = [];

    public function __construct(array $args) {
        unset($args[0]);
        $this->args = $args;
    }

    public function generate(): bool {
        try {
            $folderIdentifier = $this->args[2].rand();
            mkdir($folderIdentifier, 0777, true);
            rename($folderIdentifier, 'modules/generated/'.$this->args[2].rand());
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

}