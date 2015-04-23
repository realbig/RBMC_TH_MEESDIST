<?php
/**
 * Shortcode: Clear.
 *
 * Clearfix.
 *
 * @since   1.0.0
 * @package MeesDist
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}
add_action( 'init', function () {
	add_shortcode( 'clear', 'meesdist_sc_clear' );
} );

function meesdist_sc_clear() {
	return '<div class="clear"></div>';
}