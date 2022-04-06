<?php

require_once(__DIR__ . "/config/database.php");

date_default_timezone_set('America/Lima');

function __importProviders($type, $array) {
    switch ($type) {
        case 'model':
            array_map(function ($file) {
                require_once(__DIR__ . "/app/models/$file.php");
            }, $array);
            break;

        case 'controller':
            array_map(function ($file) {
                require_once(__DIR__ . "/app/controllers/$file.php");
            }, $array);
            break;

        case 'router':
            array_map(function ($file) {
                require_once(__DIR__ . "/routes/$file.php"); new $file();
            }, $array);
            break;
    }
}
