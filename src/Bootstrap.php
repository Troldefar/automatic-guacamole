<?php

class Bootstrap {

    public function init() {

        require_once '../src/Definitions.php';
        
        $define = new Definitions();
        $define->define();

        require_once ROOT_PATH . 'src' . DS . 'interfaces' . DS . 'ValidationRuleInterface.php';
        require_once ROOT_PATH . 'src' . DS . 'Entity.php';
        require_once ROOT_PATH . 'src' . DS . 'Controller.php';
        require_once ROOT_PATH . 'src' . DS . 'Template.php';
        require_once ROOT_PATH . 'src' . DS . 'Session.php';
        require_once ROOT_PATH . 'src' . DS . 'Database.php';
        require_once ROOT_PATH . 'src' . DS . 'Router.php';
        require_once ROOT_PATH . 'src' . DS . 'Validation.php';
        require_once ROOT_PATH . 'src' . DS . 'Auth.php';

        require_once ROOT_PATH . 'src/ValidationRules' . DS . 'ValidateMinimum.php';
        require_once ROOT_PATH . 'src/ValidationRules' . DS . 'ValidateMaximum.php';
        require_once ROOT_PATH . 'src/ValidationRules' . DS . 'ValidateEmail.php';
        require_once ROOT_PATH . 'src/ValidationRules' . DS . 'ValidateCharacters.php';
        require_once ROOT_PATH . 'src/ValidationRules' . DS . 'ValidateTrim.php';

        spl_autoload_register(function($class) {
            echo $class;
            $file = ROOT_PATH . 'src' . DS . $class . '.php';
            echo ROOT_PATH . 'src' . DS . $class . '.php';
            if (file_exists($file)) require_once $file;
        });

        require_once MODULES_PATH . 'page' . DS . 'models' . DS . 'Page.php';

        Database::connect('localhost', 'splat', 'root', 'root');

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
    }

}