<?php
/**
 * Location post type.
 *
 * @since   1.0.0
 * @package MeesDist
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'init', function () {

	easy_register_post_type( 'location', 'Location', 'Locations', array(
		'menu_icon' => 'dashicons-location',
		'supports'  => array( 'title', 'thumbnail' ),
		'rewrite'   => array( 'slug' => 'locations' ),
	) );

	// Category taxonomy
	register_taxonomy(
		'location_type',
		'location',
		array(
			'labels'        => array(
				'name'          => 'Location Type',
				'add_new_item'  => 'Add New Location Type',
				'new_item_name' => "New Location Type"
			),
			'show_admin_column' => true,
			'show_ui'       => true,
			'show_tagcloud' => false,
			'hierarchical'  => true,
		)
	);
} );

add_action( 'add_meta_boxes', function () {

	add_meta_box(
		'meesdist-location-info',
		'Product Link',
		'_meesdist_metabox_location_info',
		'location'
	);
} );

/**
 * The form callback for the testimonial role.
 *
 * @since  1.0.0
 * @access Private.
 *
 * @param object $post The current post object.
 */
function _meesdist_metabox_location_info( $post ) {

	wp_nonce_field( __FILE__, 'location_info_nonce' );

	$address_line_1 = get_post_meta( $post->ID, '_address_line_1', true );
	$address_line_2 = get_post_meta( $post->ID, '_address_line_2', true );
	$phone = get_post_meta( $post->ID, '_phone', true );
	$fax = get_post_meta( $post->ID, '_fax', true );
	$email = get_post_meta( $post->ID, '_email', true );
	$hours = get_post_meta( $post->ID, '_hours', true );
	?>
		<p>
		<label>
			Address (line 1)<br/>
			<input type="text" name="_address_line_1" value="<?php echo esc_attr( $address_line_1 ); ?>" />
		</label>
	</p>

	<p>
		<label>
			Address (line 2)<br/>
			<input type="text" name="_address_line_2" value="<?php echo esc_attr( $address_line_2 ); ?>" />
		</label>
	</p>

	<p>
		<label>
			Phone<br/>
			<input type="text" name="_phone" value="<?php echo esc_attr( $phone ); ?>" />
		</label>
	</p>

	<p>
		<label>
			Fax<br/>
			<input type="text" name="_fax" value="<?php echo esc_attr( $fax ); ?>" />
		</label>
	</p>

	<p>
		<label>
			Email<br/>
			<input type="text" name="_email" value="<?php echo esc_attr( $email ); ?>" />
		</label>
	</p>

	<p>
		<label>
			Hours<br/>

			<div style="width: 400px; max-width: 100%;">
				<?php
				wp_editor( $hours, '_hours', array(
					'textarea_name' => '_hours',
					'textarea_rows' => 4,
					'teeny'         => true,
					'media_buttons' => false,
				) );
				?>
			</div>
		</label>
	</p>
<?php
}

add_action( 'save_post', function ( $post_ID ) {

	if ( ! isset( $_POST['location_info_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['location_info_nonce'], __FILE__ ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_page', $post_ID ) ) {
		return;
	}

	$options = array(
		'_address_line_1',
		'_address_line_2',
		'_phone',
		'_fax',
		'_email',
		'_hours',
	);

	foreach ( $options as $option ) {

		if ( ! isset( $_POST[ $option ] ) || empty( $_POST[ $option ] ) ) {
			delete_post_meta( $post_ID, $option );
		}

		update_post_meta( $post_ID, $option, $_POST[ $option ] );
	}
} );