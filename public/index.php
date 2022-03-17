<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

define( 'DS', DIRECTORY_SEPARATOR );
define( 'ROOT_PATH', '..' . DS);
define( 'VIEW_PATH', '..' . DS . 'modules' . DS . 'page' . DS . 'views' . DS);
define( 'MODULES_PATH', '..' . DS . 'modules' . DS);

require_once ROOT_PATH . 'src' . DS . 'Entity.php';
require_once ROOT_PATH . 'src' . DS . 'Controller.php';
require_once ROOT_PATH . 'src' . DS . 'Template.php';
require_once ROOT_PATH . 'src' . DS . 'Database.php';
require_once ROOT_PATH . 'src' . DS . 'Router.php';
require_once ROOT_PATH . 'src' . DS . 'Validation.php';
require_once ROOT_PATH . 'src' . DS . 'Auth.php';

require_once ROOT_PATH . 'src/ValidationRules' . DS . 'ValidateMinimum.php';
require_once ROOT_PATH . 'src/ValidationRules' . DS . 'ValidateMaximum.php';
require_once ROOT_PATH . 'src/ValidationRules' . DS . 'ValidateEmail.php';
require_once ROOT_PATH . 'src/ValidationRules' . DS . 'ValidateCharacters.php';

require_once MODULES_PATH . 'page' . DS . 'models' . DS . 'Page.php';

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