<?php

class Bootstrap {

    public function init(): bool {

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        try {
            require_once '../src/Definitions.php';
    
            $define = new Definitions();
            $define->define();

            require_once ROOT_PATH . 'src' . DS . 'interfaces' . DS . 'ValidationRuleInterface.php';

            spl_autoload_register(function($class) {
                $file = ROOT_PATH . 'src' . DS . $class . '.php';
                if (file_exists($file)) require_once $file;
            });

            spl_autoload_register(function($class) {
                ROOT_PATH . 'src/ValidationRules' . DS . $class . '.php';
                if (file_exists($file)) require_once $file;
            });

            require_once MODULES_PATH . 'page' . DS . 'models' . DS . 'Page.php';

            Database::connect(
                Json::config()->db->host, 
                Json::config()->db->table, 
                Json::config()->db->username, 
                Json::config()->db->password
            );

            $dbh = Database::getInstance();
            $dbc = $dbh->getConnection();

            $session = new Session();
            $session->start();

            $action  = $_GET['seo_name'] ?? 'home';

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

            return true;
        } catch (\Exception $e) {
            var_dump($e);
            return false;
        }
        
    }

}