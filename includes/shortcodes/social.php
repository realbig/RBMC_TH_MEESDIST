<?php
/**
 * Shortcodes: Facebook, Twitter, GooglePlus, YouTube.
 *
 * Social link shortcodes
 *
 * @since   1.0.0
 * @package MeesDist
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}
add_action( 'init', function () {

	add_shortcode( 'facebook', '_meesdist_sc_facebook' );
	add_shortcode( 'twitter', '_meesdist_sc_twitter' );
	add_shortcode( 'instagram', '_meesdist_sc_instagram' );
	add_shortcode( 'pinterest', '_meesdist_sc_pinterest' );
} );

function _meesdist_sc_facebook( $atts = array() ) {

	$atts = shortcode_atts( array(
		'size' => 'medium',
	), $atts );

	return "<span class=\"social-icon-facebook-$atts[size] fa fa-facebook\"></span>";
}

function _meesdist_sc_twitter( $atts = array() ) {

	$atts = shortcode_atts( array(
		'size' => 'medium',
	), $atts );

	return "<span class=\"social-icon-twitter-$atts[size] fa fa-twitter\"></span>";
}

function _meesdist_sc_instagram( $atts = array() ) {

	$atts = shortcode_atts( array(
		'size' => 'medium',
	), $atts );

	return "<span class=\"social-icon-instagram-$atts[size] fa fa-instagram\"></span>";
}

function _meesdist_sc_pinterest( $atts = array() ) {

	$atts = shortcode_atts( array(
		'size' => 'medium',
	), $atts );

	return "<span class=\"social-icon-pinterest-$atts[size] fa fa-pinterest\"></span>";
}