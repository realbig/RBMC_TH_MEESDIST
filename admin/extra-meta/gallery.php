<?php
/**
 * Gallery extra meta.
 *
 * @since   1.0.0
 * @package MeesDist
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'add_meta_boxes', '_meesdist_add_metaboxes_gallery' );
add_action( 'save_post', '_meesdist_save_metaboxes_gallery' );

function _meesdist_add_metaboxes_gallery() {

	global $post;

	if ( get_post_meta( $post->ID, '_wp_page_template', true ) != 'page-templates/gallery.php' ) {
		return;
	}

	add_meta_box(
		'meesdist_mb_gallery',
		'Gallery (below content)',
		'_meesdist_mb_gallery',
		'page'
	);
}

function _meesdist_mb_gallery() {

	global $post;

	wp_nonce_field( __FILE__, 'meesdist_mb_gallery_nonce' );

	$gallery = get_post_meta( $post->ID, '_gallery', true );

	?>
	<label>
		<?php
		wp_editor( $gallery, '_gallery', array(
			'textarea_name' => '_gallery',
		));
		?>
	</label>
<?php
}

function _meesdist_save_metaboxes_gallery( $post_ID ) {

	if ( ! isset( $_POST['meesdist_mb_gallery_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['meesdist_mb_gallery_nonce'], __FILE__ ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_page', $post_ID ) ) {
		return;
	}

	$options = array(
		'_gallery',
	);

	foreach ( $options as $option ) {

		if ( ! isset( $_POST[ $option ] ) || empty( $_POST[ $option ] ) ) {
			delete_post_meta( $post_ID, $option );
		}

		update_post_meta( $post_ID, $option, $_POST[ $option ] );
	}
}