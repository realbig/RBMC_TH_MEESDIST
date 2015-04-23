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

	// Category taxonomy
	register_taxonomy(
		'slide_location',
		'slide',
		array(
			'labels'        => array(
				'name'          => 'Slide Location',
				'add_new_item'  => 'Add New Slide Location',
				'new_item_name' => "New Slide Location"
			),
			'show_admin_column' => true,
			'show_ui'       => true,
			'show_tagcloud' => false,
			'hierarchical'  => true,
		)
	);
} );