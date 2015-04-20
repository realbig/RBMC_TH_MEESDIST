<?php
/**
 * Shortcodes: Phone, Email, Address.
 *
 * Displays company phone number.
 *
 * @since   1.0.0
 * @package MeesDist
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}
add_action( 'init', function () {

	add_shortcode( 'phone', '_meesdist_sc_phone' );
	add_shortcode( 'email', '_meesdist_sc_email' );
	add_shortcode( 'address', '_meesdist_sc_address' );
} );

function _meesdist_sc_phone() {

	$phone = get_option( '_meesdist_phone', '' );
	return wp_is_mobile() ? "<a href=\"tel:$phone\">$phone</a>" : $phone;
}

function _meesdist_sc_email() {

	$email = get_option( '_meesdist_email', '' );
	return "<a href=\"mailto:$email\">$email</a>";
}

function _meesdist_sc_address() {

	$address = get_option( '_meesdist_address', '' );
	return wpautop( do_shortcode( $address ) );
}