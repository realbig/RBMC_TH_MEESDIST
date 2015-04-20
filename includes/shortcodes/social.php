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
	add_shortcode( 'googleplus', '_meesdist_sc_googleplus' );
	add_shortcode( 'youtube', '_meesdist_sc_youtube' );
} );

function _meesdist_sc_facebook( $atts = array() ) {

	$atts = shortcode_atts( array(
		'size' => 'medium',
	), $atts );

	return "<span class=\"social-icon-facebook-$atts[size] icon-facebook\"></span>";
}

function _meesdist_sc_twitter( $atts = array() ) {

	$atts = shortcode_atts( array(
		'size' => 'medium',
	), $atts );

	return "<span class=\"social-icon-twitter-$atts[size] icon-twitter\"></span>";
}

function _meesdist_sc_googleplus( $atts = array() ) {

	$atts = shortcode_atts( array(
		'size' => 'medium',
	), $atts );

	return "<span class=\"social-icon-googleplus-$atts[size] icon-google-plus\"></span>";
}

function _meesdist_sc_youtube( $atts = array() ) {

	$atts = shortcode_atts( array(
		'size' => 'medium',
	), $atts );

	return "<span class=\"social-icon-youtube-$atts[size] icon-youtube\"></span>";
}