<?php


/**
 * --------------------------------------------------------------------------
 * Helper | register_assets();
 * --------------------------------------------------------------------------
 *
 * @param $type
 * @param $resource
 *
 */

function register_assets($type, $resource) {
    if ($type === 'style') {
        wp_register_style(
            $resource['handle'],
            $resource['src'],
            $resource['deps'],
            $resource['ver'],
            $resource['media']
        );
        wp_enqueue_style( $resource['handle'] );
    } elseif ($type === 'script') {
        wp_register_script(
            $resource['handle'],
            $resource['src'],
            $resource['deps'],
            $resource['ver'],
            $resource['in_footer']
        );
        wp_enqueue_script( $resource['handle'] );
    }
}

/**
 * --------------------------------------------------------------------------
 * Helper | Autoload functions custom post type or taxonomy
 * --------------------------------------------------------------------------
 *
 * @param string $path
 *
 * @return array
 *
 */
function __autoload_functions_by_dir($path) {
    $dir = scandir(get_template_directory() . $path);
    $files = [];

    foreach ( $dir as $key => $file ) {
        if ( ! in_array($file, ['.', '..', '.gitkeep']) ) {
            $files[] = $file;
        }
    }

    return $files;
}
