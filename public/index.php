<?php

session_start();

function pad(mixed $val) {
	echo '<pre>';
		print_r($val);
	echo '</pre>';
	exit();
}

function safer(string $val): string {
	return htmlspecialchars(trim($val));
}

define( 'ROOT_PATH', '../');
define( 'VIEW_PATH', '../view/');
define( 'MODULES_PATH', '../modules/');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once ROOT_PATH . 'src/Entity.php';
require_once ROOT_PATH . 'src/Controller.php';
require_once ROOT_PATH . 'src/Template.php';
require_once MODULES_PATH . 'page/models/Page.php';
require_once ROOT_PATH . 'src/Database.php';
require_once ROOT_PATH . 'src/Router.php';

Database::connect('localhost', 'splat', 'root', 'root');

$action  = $_GET['seo_name'] ?? 'home';

$dbh = Database::getInstance();
$dbc = $dbh->getConnection();

$router = new Router($dbc);
$router->findBy('locater', $action);

$action = $router->action !== '' ? $router->action : 'default';

$module = ucfirst($router->module) . 'Controller';

$controllerFile = MODULES_PATH . $router->module . '/controllers/' . $module . '.php';

if (file_exists($controllerFile)) {
	include $controllerFile;
	$controller = new $module();
	$controller->setEntityID($router->entityID);
	$controller->runAction($action);
}