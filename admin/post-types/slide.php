<?php
/**
 * Slide post type.
 *
 * @since   1.0.0
 * @package MeetDist
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'init', function () {
	easy_register_post_type( 'slide', 'Slide', 'Slides', array(
		'menu_icon' => 'dashicons-images-alt',
		'supports'  => array( 'title', 'thumbnail' ),
		'rewrite'   => array( 'slug' => 'slides' ),
	) );
} );