<?php
/**
 * Gallery Item post type.
 *
 * @since   1.0.0
 * @package MeesDist
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'init', function () {
	easy_register_post_type( 'gallery_item', 'Gallery Item', 'Gallery Items', array(
		'menu_icon' => 'dashicons-format-gallery',
		'supports'  => array( 'title', 'thumbnail', 'content' ),
		'rewrite'   => array( 'slug' => 'gallery_items' ),
	) );
} );