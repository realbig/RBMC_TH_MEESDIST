<?php
/**
 * Shortcode: Style.
 *
 * Styles text.
 *
 * @since   1.0.0
 * @package MeesDist
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}
add_action( 'init', function () {
	add_shortcode( 'style', 'meesdist_sc_style' );
} );

function meesdist_sc_style( $atts = array(), $content = '' ) {

	$atts = shortcode_atts( array(
		'color' => 'primary',
		'tag' => 'div',
	), $atts );

	$tag = $atts['tag'];

	switch ( $atts['color'] ) {
		case 'primary':
			$atts['color'] = '#0D4A74';
			break;
	}

	$styles = 'style="';
	$styles .= ! empty( $atts['color'] ) ? "color: $atts[color];" : '';
	$styles .= '"';

	return "<$tag $styles>" . do_shortcode( $content ) . "</$tag>";
}