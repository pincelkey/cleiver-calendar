<?php

return [
    'resources' => [
        /**
         * Scripts
         * */
        'vendors' => get_theme_file_uri(__getResourceURL('js', 'vendors.bundle.js')),
        'wp_example' => get_theme_file_uri(__getResourceURL('js', 'wp_example.bundle.js')),

        /**
         * Styles
         * */
        'style_admin' => get_theme_file_uri(__getResourceURL('css', 'wp_admin.css')),
    ],
    'vertion' => '1649044939599',
];
