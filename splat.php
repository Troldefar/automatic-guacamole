<?php

if (php_sapi_name() !== 'cli') exit('Can only be called from the terminal 🧐');

require_once 'src/Cli.php';

$cli = new Cli([...$argv]);
$method = $argv[1];
$cli->$method();