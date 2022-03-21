<?php

class Json {

    public static function config(): object {
        return json_decode(file_get_contents('..'.DS.'configs'.DS.'config.json'));
    }

}