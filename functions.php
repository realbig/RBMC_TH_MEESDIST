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

// Extra image sizes
global $meesdist_image_sizes;
$meesdist_image_sizes = array(
	'slide' => array(
		'title' => 'Slide',
		'width' => 1000,
		'height' => 500,
		'crop' => array( 'center', 'center' ),
	),
	'gallery' => array(
		'title' => 'Gallery',
		'width' => 500,
		'height' => 500,
		'crop' => array( 'center', 'center' ),
	)
);

/**
 * Setup theme properties and stuff.
 *
 * @since 0.1.0
 */
add_action( 'after_setup_theme', function () {

	global $meesdist_image_sizes;

	// Add theme support
	require_once __DIR__ . '/includes/theme-support.php';

	// Image sizes
	if ( ! empty( $meesdist_image_sizes ) ) {

		foreach ( $meesdist_image_sizes as $ID => $size ) {
			add_image_size( $ID, $size['width'], $size['height'], $size['crop'] );
		}

		add_filter( 'image_size_names_choose', '_meesdist_add_image_sizes' );
	}

	// Don't use gallery style
	add_filter( 'use_default_gallery_style', '__return_false' );

	// Allow shortcodes in text widget
	add_filter( 'widget_text', 'do_shortcode' );
} );

/**
 * Adds support for custom image sizes.
 *
 * @since 0.1.0
 *
 * @param $sizes array The existing image sizes.
 *
 * @return array The new image sizes.
 */
function _meesdist_add_image_sizes( $sizes ) {

	global $meesdist_image_sizes;

	$new_sizes = array();
 	foreach ( $meesdist_image_sizes as $ID => $size ) {
	    $new_sizes[ $ID ] = $size['title'];
	}

	return array_merge( $sizes, $new_sizes );
}

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

	// Admin script
	wp_register_script(
		THEME_ID . '-admin',
		get_template_directory_uri() . '/admin.js',
		array( 'jquery', THEME_ID . '-chosen' ),
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

	// Slick
	wp_register_style(
		THEME_ID . '-slick',
		get_template_directory_uri() . '/assets/vendor/css/slick.css',
		array(),
		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : '1.5.0'
	);
	wp_register_script(
		THEME_ID . '-slick',
		get_template_directory_uri() . '/assets/vendor/js/nomin/slick.min.js',
		array( 'jquery' ),
		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : '1.5.0'
	);

	// Chosen
	wp_register_style(
		THEME_ID . '-chosen',
		get_template_directory_uri() . '/assets/vendor/css/chosen.min.css',
		array(),
		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : '1.4.2'
	);
	wp_register_script(
		THEME_ID . '-chosen',
		get_template_directory_uri() . '/assets/vendor/js/nomin/chosen.jquery.min.js',
		array( 'jquery' ),
		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : '1.4.2'
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

	// Slick slider
	if ( is_front_page() || is_page_template( 'page-templates/featured-project.php' ) ) {
		wp_enqueue_style( THEME_ID . '-slick' );
		wp_enqueue_script( THEME_ID . '-slick' );
	}
} );

/**
 * Enqueue admin files.
 *
 * @since 0.1.0
 */
add_action( 'admin_enqueue_scripts', function () {

	// Admin script
	wp_enqueue_script( THEME_ID . '-admin' );
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
		'name'          => 'Header',
		'id'            => 'header',
		'description'   => 'Shows on the right side of the site\'s top header.',
		'before_widget' => '',
		'after_widget'  => '',
	) );

	// Home (left)
	register_sidebar( array(
		'name'        => 'Home Left',
		'id'          => 'home-left',
		'description' => 'Shows under the Home Page content on the left.',
		'before_widget' => '',
		'after_widget' => '',
	) );

	// Home (right)
	register_sidebar( array(
		'name'        => 'Home Right',
		'id'          => 'home-right',
		'description' => 'Shows under the Home Page content on the right.',
		'before_widget' => '',
		'after_widget' => '',
	) );

	// Catalog
	register_sidebar( array(
		'name'        => 'Catalog',
		'id'          => 'catalog',
		'description' => 'Shows on the catalog page.',
		'before_widget' => '',
		'after_widget' => '',
	) );

	// Gallery
	register_sidebar( array(
		'name'        => 'Gallery',
		'id'          => 'gallery',
		'description' => 'Shows on the gallery page.',
		'before_widget' => '',
		'after_widget' => '',
	) );

	// Footer
	register_sidebar( array(
		'name'        => 'Footer',
		'id'          => 'footer',
		'description' => 'Shows on left side of the site\'s footer.',
		'before_widget' => '',
		'after_widget' => '',
	) );
} );

// Theme specific functions
require_once __DIR__ . '/includes/theme-functions.php';

// Admin
require_once __DIR__ . '/admin/admin.php';

// Include shortcodes
require_once __DIR__ . '/includes/shortcodes/social.php';
require_once __DIR__ . '/includes/shortcodes/button.php';
require_once __DIR__ . '/includes/shortcodes/contact.php';
require_once __DIR__ . '/includes/shortcodes/image.php';
require_once __DIR__ . '/includes/shortcodes/style.php';
require_once __DIR__ . '/includes/shortcodes/clear.php';
require_once __DIR__ . '/includes/shortcodes/timeline.php';

// Include widgets
require_once __DIR__ . '/includes/widgets/text-icon.php';
require_once __DIR__ . '/includes/widgets/newsletter-signup.php';
require_once __DIR__ . '/includes/widgets/custom-taxonomy-list.php';

// Overrides
require_once __DIR__ . '/includes/overrides/woocommerce.php';