<?php

function pad(mixed $val) {
	echo '<pre>';
		print_r($val);
	echo '</pre>';
	exit();
}

function safer(string $string): string {
	return htmlspecialchars(trim($string));
}

define('DEBUG', basename(__DIR__) === 'live');

if (!DEBUG) {
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
}