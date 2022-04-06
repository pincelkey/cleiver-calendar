<?php

require_once dirname( __FILE__ ) . '/libs/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );

function my_theme_register_required_plugins() {
	$plugins = array(
		array(
			'name'               	=> 'Advanced Custom Fields Pro',
			'slug'               	=> 'advanced-custom-fields-pro',
			'source'             	=>	dirname( __FILE__ ) . '/packages/acf-pro.zip',
			// 'required'           	=> true,
			'version'				=> '5.8.1',
			'force_activation'		=> false,
			'force_deactivation'	=> false,
		),

		array(
			'name'        => 'WordPress SEO by Yoast',
			'slug'        => 'wordpress-seo',
			'is_callable' => 'wpseo_init',
		),

		array(
			'name'                  => 'Pixabay Free Images',
			'slug'                  => 'free-images',
			'force_activation'  	=> false,
			'force_deactivation' 	=> false,
		),

		array(
			'name'                  => 'ACF Duplicate Repeater',
			'slug'                  => 'acf-duplicate-repeater',
			'force_activation'  	=> false,
			'force_deactivation' 	=> false,
		),

		array(
			'name'        			=> 'SVG Support',
			'slug'        			=> 'svg-support',
			'force_activation'  	=> false,
			'force_deactivation' 	=> false,
		),

		array(
			'name'        			=> 'Duplicate Page',
			'slug'        			=> 'duplicate-page',
			'force_activation'  	=> false,
			'force_deactivation' 	=> false,
		),
	);

	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'plugins.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

		'strings'      => array(
			'page_title'    => __( 'Install Required Plugins 🔋', 'theme-slug' ),
			'menu_title'    => __( 'Install Plugins 🔋', 'theme-slug' ),
		),
	);

	tgmpa( $plugins, $config );
}
