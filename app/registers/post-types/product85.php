<?php

function custom_post_type_product85() {
    $settings = [
        'name_post_type_plural'   => '',
        'name_post_type_Singular' => '',
        'name_register_post_type' => '',
        'rewrite_slug'            => '',
        'supports_post_type'      => [ 'title', 'editor', 'thumbnail' ],
        'taxonomy_post_type'      => [],
        'menu_icon_post_type'     => 'dashicons-megaphone',
        'text_domain'             => 'pandawp'
    ];

    $labels = [
        'name'                  => _x( $settings['name_post_type_plural'], 'Post Type General Name', $settings['text_domain'] ),
        'singular_name'         => _x( $settings['name_post_type_Singular'], 'Post Type Singular Name', $settings['text_domain'] ),
        'menu_name'             => __( $settings['name_post_type_plural'], $settings['text_domain'] ),
        'name_admin_bar'        => __( $settings['name_post_type_Singular'], $settings['text_domain'] )
    ];

    $rewrite = [
        'slug'                  => $settings['rewrite_slug'],
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true
    ];

    $args = [
        'label'                 => __( $settings['name_post_type_Singular'], $settings['text_domain'] ),
        'labels'                => $labels,
        'supports'              => $settings['supports_post_type'],
        'taxonomies'            => $settings['taxonomy_post_type'],
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => $settings['menu_icon_post_type'],
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'page',
        'show_in_rest'          => true,
    ];

    register_post_type( $settings['name_register_post_type'], $args );
}
add_action( 'init', 'custom_post_type_product85', 0 );
