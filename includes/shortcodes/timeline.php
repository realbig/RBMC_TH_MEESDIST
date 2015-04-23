<?php
/**
 * Shortcodes: Timeline Wrapper, Timeline Item.
 *
 * @since   1.0.0
 * @package MeesDist
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}
add_action( 'init', function () {
	add_shortcode( 'timeline_wrapper', 'meesdist_sc_timeline_wrapper' );
	add_shortcode( 'timeline_item', 'meesdist_sc_timeline_item' );
} );

function meesdist_sc_timeline_wrapper( $atts = array(), $content = '' ) {

	$atts = shortcode_atts( array(
		'columns' => 5,
	), $atts );

	$content = do_shortcode( $content );

	return '<ul class="timeline-wrapper ' . meesdist_get_dynamic_columns( $atts['columns'], true ) . '">' . $content . '</ul>';
}

function meesdist_sc_timeline_item( $atts = array(), $content = '' ) {

	$atts = shortcode_atts( array(
		'year' => '2000',
		'image' => '',
	), $atts );

	$html = '<li>';

	$html .= wp_get_attachment_image( $atts['image'], 'full' );
	$html .= '<p class="timeline-year">' . $atts['year'] . '</p>';
	$html .= '<div class="timeline-content">' . $content . '</div>';

	$html .= '</li>';

	return $html;
}