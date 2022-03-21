<?php

class Bootstrap {

    public function init() {
        define( 'DS', DIRECTORY_SEPARATOR );
        define( 'ROOT_PATH', '..' . DS);
        define( 'VIEW_PATH', '..' . DS . 'modules' . DS . 'page' . DS . 'views' . DS);
        define( 'MODULES_PATH', '..' . DS . 'modules' . DS);

        spl_autoload_register(function($class) {
            echo $class;
            $file = ROOT_PATH . 'src' . DS . $class . '.php';
            echo ROOT_PATH . 'src' . DS . $class . '.php';
            if (file_exists($file)) require_once $file;
        });

        require_once ROOT_PATH . 'src' . DS . 'interfaces' . DS . 'ValidationRuleInterface.php';
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
        require_once ROOT_PATH . 'src/ValidationRules' . DS . 'ValidateTrim.php';

        require_once MODULES_PATH . 'page' . DS . 'models' . DS . 'Page.php';
    }

}