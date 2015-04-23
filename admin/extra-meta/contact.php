<?php
/**
 * Contact extra meta.
 *
 * @since   1.0.0
 * @package MeesDist
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'add_meta_boxes', '_meesdist_add_metaboxes_contact' );
add_action( 'save_post', '_meesdist_save_metaboxes_contact' );

function _meesdist_add_metaboxes_contact() {

	global $post;

	if ( get_post_meta( $post->ID, '_wp_page_template', true ) != 'page-templates/contact.php' ) {
		return;
	}

	remove_post_type_support( 'page', 'editor' );

	add_meta_box(
		'meesdist_mb_contact',
		'Gravity Form',
		'_meesdist_mb_contact',
		'page'
	);
}

function _meesdist_mb_contact() {

	global $post;

	wp_nonce_field( __FILE__, 'meesdist_mb_contact_nonce' );

	$form = get_post_meta( $post->ID, '_form', true );

	?>
	<label>
		Enter form ID<br/>
		<input type="text" name="_form" value="<?php echo $form; ?>" />
	</label>
<?php
}

function _meesdist_save_metaboxes_contact( $post_ID ) {

	if ( ! isset( $_POST['meesdist_mb_contact_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['meesdist_mb_contact_nonce'], __FILE__ ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_page', $post_ID ) ) {
		return;
	}

	$options = array(
		'_form',
	);

	foreach ( $options as $option ) {

		if ( ! isset( $_POST[ $option ] ) || empty( $_POST[ $option ] ) ) {
			delete_post_meta( $post_ID, $option );
		}

		update_post_meta( $post_ID, $option, $_POST[ $option ] );
	}
}