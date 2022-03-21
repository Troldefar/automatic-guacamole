<?php

class Cli {

    private array $args = [];

    public function __construct(array $args) {
        unset($args[0]);
        $this->args = $args;
    }

    public function generate(): bool {
        unset($this->args[0]);
        try {
            $folderIdentifier = 'generatedModule'.rand();
            mkdir($folderIdentifier, 0777, true);
            rename($folderIdentifier, 'modules/generated/testFolder'.rand());
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

}