<?php

class Json {

    public static function config(): object {
        return json_decode(file_get_contents("../configs/config.json"));
    }

}