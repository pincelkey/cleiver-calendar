<?php

function __getResourceURL($type, $resource){
    $staticDir  = (ENV['APP_ENV'] == 'development') ? 'temp/' : '';

    if ($type == 'css') {
        return "/static/admin/{$staticDir}css/{$resource}";
    } elseif ($type == 'js') {
        return "/static/admin/{$staticDir}js/{$resource}";
    }
}

$config = require get_theme_file_path('config/base.php');

function __removeGlobalPackages() {
    wp_dequeue_script('wp-embed'); wp_deregister_script('wp-embed');

    wp_dequeue_style('wp-block-library'); wp_deregister_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme'); wp_deregister_style('wp-block-library-theme');

    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
}

function __enqueueGlobalPackages($config) {
    register_assets('script', [
        'handle'    => 'pandawp/base/vendors',
        'src'       => $config['resources']['vendors'],
        'deps'      => [ ],
        'ver'       => $config['vertion'],
        'in_footer' => true
    ]);
};

add_action( 'wp_enqueue_scripts', function () use ($config) {
    if ( !get_current_user_id() ) __removeGlobalPackages();

    /**
     * --------------------------------------------------------------------------
     * Register Scripts
     * --------------------------------------------------------------------------
     *
     */
    array_map(function ($file) {
        if ( !strpos($file, '.map') ) {
            register_assets('script', [
                'handle'    => 'pandawp/script/' . $file,
                'src'       => get_theme_file_uri("/static/public/" . ((ENV['APP_ENV'] == 'development') ? "temp/js/{$file}" : "js/{$file}")),
                'deps'      => [ ],
                'ver'       => '1.0.0',
                'in_footer' => true
            ]);
        }
    }, __autoload_functions_by_dir('/static/public/' . ((ENV['APP_ENV'] == 'development') ? 'temp/js' : 'js')));

    /**
     * --------------------------------------------------------------------------
     * Register Styles
     * --------------------------------------------------------------------------
     *
     */
    array_map(function ($file) {
        register_assets('style', [
            'handle'    => 'pandawp/style/' . $file,
            'src'       => get_theme_file_uri("/static/public/" . ((ENV['APP_ENV'] == 'development') ? "temp/css/{$file}" : "css/{$file}")),
            'deps'      => [ ],
            'ver'       => '1.0.0',
            'in_footer' => true
        ]);
    }, __autoload_functions_by_dir('/static/public/' . ((ENV['APP_ENV'] == 'development') ? 'temp/css' : 'css')));
});

add_action( 'admin_head', function() use ($config) {
    $current = get_current_screen();

    register_assets('style', [
        'handle' => 'pandawp/style/admin',
        'src'    => $config['resources']['style_admin'],
        'deps'   => [ ],
        'ver'    => $config['vertion'],
        'media'  => 'all'
    ]);

    switch ($current->base) {
        case 'toplevel_page_examples': {
                __enqueueGlobalPackages($config);

                register_assets('script', [
                    'handle'    => 'pandawp/wp/example',
                    'src'       =>  $config['resources']['wp_example'],
                    'deps'      => [ ],
                    'ver'       => $config['vertion'],
                    'in_footer' => true
                ]); 

                wp_localize_script( 'pandawp/base/vendors', 'panda', getContextVariables());
            }
            break;
    }
});
