<?php
/**
 * Shortcode: Image.
 *
 * Displays an image.
 *
 * @since   1.0.0
 * @package MeesDist
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}
add_action( 'init', function () {
	add_shortcode( 'image', 'meesdist_sc_image' );
} );

function meesdist_sc_image( $atts = array() ) {

	$atts = shortcode_atts( array(
		'id' => false,
		'link' => false,
		'size' => 'full',
		'class' => '',
	), $atts );

	$html = '';

	$html .= $atts['link'] !== false ? "<a href=\"{$atts['link']}\">" : '';
	$html .= wp_get_attachment_image( $atts['id'], $atts['size'], false, array(
		'class' => $atts['class'],
	) );
	$html .= '</a>';

	return $html;
}