<?php

define('DEBUG', basename(__DIR__) === 'live');

if (!DEBUG) {
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
}

session_start();

function pad(mixed $val) {
	echo '<pre>';
		print_r($val);
	echo '</pre>';
	exit();
}

function safer(string $string): string {
	return htmlspecialchars(trim($string));
}

Database::connect('localhost', 'splat', 'root', 'root');

$action  = $_GET['seo_name'] ?? 'home';

$dbh = Database::getInstance();
$dbc = $dbh->getConnection();

$router = new Router($dbc);
$router->findBy('locater', $action);

$action = $router->action !== '' ? $router->action : 'default';

$module = ucfirst($router->module) . 'Controller';

$controllerFile = MODULES_PATH . $router->module . DS . 'controllers' . DS . $module . '.php';

if (file_exists($controllerFile)) {
	include $controllerFile;
	$controller = new $module();
	$controller->setEntityID($router->entityID);
	$controller->runAction($action);
}