<?php

require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/functions/libs/context.php');
require_once(__DIR__ . '/functions/routes.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

define('ENV', $_ENV);

/**
 * --------------------------------------------------------------------------
 * Functions
 * --------------------------------------------------------------------------
 *
 */
array_map(function ($file) {
    require_once get_theme_file_path("functions/") . "{$file}.php";
}, ['helpers', 'setup', 'enqueues', 'filters', 'acf', 'login', 'api/main']);

array_map(function ($file) {
    require_once get_theme_file_path("functions/") . "{$file}.php";
}, ['admin/pages/example/main']);

/**
 * --------------------------------------------------------------------------
 * Post Types
 * --------------------------------------------------------------------------
 *
 */
array_map(function ($file) {
    require_once get_theme_file_path("registers/post-types/") . "{$file}";
}, __autoload_functions_by_dir('/registers/post-types'));


/**
 * --------------------------------------------------------------------------
 * Taxonomies
 * --------------------------------------------------------------------------
 *
 */
array_map(function ($file) {
    require_once get_theme_file_path("registers/taxonomies/") . "{$file}";
}, __autoload_functions_by_dir('/registers/taxonomies'));

/**
 * --------------------------------------------------------------------------
 * Plguins
 * --------------------------------------------------------------------------
 *
 */

require_once(__DIR__ . '/plugins/main.php');
