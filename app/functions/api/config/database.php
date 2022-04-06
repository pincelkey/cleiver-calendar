<?php 

use Illuminate\Database\Capsule\Manager as Database;

$database = new Database;

$database->addConnection([
    'driver'    => 'mysql',
    'host'      => DB_HOST,
    'database'  => DB_NAME,
    'username'  => DB_USER,
    'password'  => DB_PASSWORD,
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci'
]);

$database->setAsGlobal();
$database->bootEloquent();
