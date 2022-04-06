<?php

if ( !function_exists('pw_custom_login_stylesheet') ):
    function pw_custom_login_stylesheet() {
        wp_enqueue_style(
            'custom-login',
            get_stylesheet_directory_uri() . '/static/admin/'. ((ENV['APP_ENV'] == 'development') ? 'temp/' : '') .'css/wp_login_styles.css'
        );
    }
endif;
add_action( 'login_enqueue_scripts', 'pw_custom_login_stylesheet' );

if (!function_exists('pw_login_logo') ):
    function pw_login_logo() {
        $uri = get_stylesheet_directory_uri();

        $style = "<style type='text/css'>";
        $style .= "#login h1 a, .login h1 a {  background-image: url($uri/static/admin/". ((ENV['APP_ENV'] == 'development') ? 'temp/' : '') ."images/login/logo.png); }";
        $style .= "</style>";

        echo $style;
    }
endif;
add_action( 'login_enqueue_scripts', 'pw_login_logo' );

if ( !function_exists('pw_login_logo_url') ):
    function pw_login_logo_url() {
        return home_url();
    }
endif;
add_filter( 'login_headerurl', 'pw_login_logo_url' );
