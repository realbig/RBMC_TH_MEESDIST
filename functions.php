<?php
/**
 * The theme's functions file that loads on EVERY page, used for uniform functionality.
 *
 * @since   0.1.0
 * @package MeesDist
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

// Make sure PHP version is correct
if ( ! version_compare( PHP_VERSION, '5.3.0', '>=' ) ) {
	wp_die( 'ERROR in MeesDist theme: PHP version 5.3 or greater is required.' );
}

// Make sure no theme constants are already defined (realistically, there should be no conflicts)
if ( defined( 'THEME_VERSION' ) || defined( 'THEME_ID' ) || isset( $theme_fonts ) ) {
	wp_die( 'ERROR in MeesDist theme: There is a conflicting constant. Please either find the conflict or rename the constant.' );
}

/**
 * The theme's current version (make sure to keep this up to date!)
 */
define( 'THEME_VERSION', '0.1.0' );

/**
 * The theme's ID (used in handlers).
 */
define( 'THEME_ID', 'my_theme' );

/**
 * Setup theme properties and stuff.
 *
 * @since 0.1.0
 */
add_action( 'after_setup_theme', function() {

	// Add theme support
	require_once __DIR__ . '/includes/theme-support.php';

	// Allow shortcodes in text widget
	add_filter('widget_text', 'do_shortcode');
});

/**
 * Register theme files.
 *
 * @since 0.1.0
 */
add_action( 'init', function () {

	// Theme styles
	wp_register_style(
		THEME_ID,
		get_template_directory_uri() . '/style.css',
		null,
		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VERSION
	);

	// Theme script
	wp_register_script(
		THEME_ID,
		get_template_directory_uri() . '/script.js',
		array( 'jquery' ),
		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VERSION,
		true
	);

	// Font Awesome
	wp_register_style(
		THEME_ID . '-font-awesome',
		'//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css',
		array(),
		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : '4.3.0'
	);
} );

/**
 * Enqueue theme files.
 *
 * @since 0.1.0
 */
add_action( 'wp_enqueue_scripts', function () {

	// Theme styles
	wp_enqueue_style( THEME_ID );

	// Theme script
	wp_enqueue_script( THEME_ID );

	// Font Awesome
	wp_enqueue_style( THEME_ID . '-font-awesome' );
} );

/**
 * Register nav menus.
 *
 * @since 0.1.0
 */
add_action( 'after_setup_theme', function () {
	register_nav_menu( 'primary', 'Primary Menu' );
} );

/**
 * Register sidebars.
 *
 * @since 0.1.0
 */
add_action( 'widgets_init', function () {

	// Header
	register_sidebar( array(
		'name' => 'Header',
		'id' => 'header',
		'description' => 'Shows on the right side of the site\'s top header.',
		'before_widget' => '',
		'after_widget' => '',
	));

	// Home
	register_sidebar( array(
		'name' => 'Home',
		'id' => 'home',
		'description' => 'Shows under the Home Page content.',
	));

	// Footer
	register_sidebar( array(
		'name' => 'Footer',
		'id' => 'footer',
		'description' => 'Shows on left side of the site\'s footer.',
	));
} );

require_once __DIR__ . '/admin/admin.php';

// Include shortcodes
require_once __DIR__ . '/includes/shortcodes/social.php';
require_once __DIR__ . '/includes/shortcodes/button.php';
require_once __DIR__ . '/includes/shortcodes/contact.php';

// Include widgets
require_once __DIR__ . '/includes/widgets/image.php';
require_once __DIR__ . '/includes/widgets/text-icon.php';