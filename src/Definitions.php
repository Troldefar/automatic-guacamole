<?php

class Definitions {

    public function define() {

        define( 'DS', DIRECTORY_SEPARATOR );
        define( 'ROOT_PATH', '..' . DS);
        define( 'VIEW_PATH', '..' . DS . 'modules' . DS . 'page' . DS . 'views' . DS);
        define( 'MODULES_PATH', '..' . DS . 'modules' . DS);
        
    }

}