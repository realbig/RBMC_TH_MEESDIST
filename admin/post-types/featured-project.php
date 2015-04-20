<?php
/**
 * Featured Project post type.
 *
 * @since   1.0.0
 * @package MeesDist
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'init', function () {
	easy_register_post_type( 'featured_product', 'Featured Project', 'Featured Projects', array(
		'menu_icon' => 'dashicons-hammer',
		'supports'  => array( 'title', 'thumbnail', 'editor' ),
		'rewrite'   => array( 'slug' => 'featured_products' ),
	) );
} );

add_action( 'add_meta_boxes', function () {

	add_meta_box(
		'meesdist-featured_product-materials',
		'Product Link',
		'_meesdist_metabox_featured_product_materials',
		'featured_product'
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
function _meesdist_metabox_featured_product_materials( $post ) {

	wp_nonce_field( __FILE__, 'featured_product_materials_nonce' );

	$materials = get_post_meta( $post->ID, '_materials', true );

	// TODO get materials properly
	$products = get_posts( array(
		'post_type' => 'product',
	) );
	?>
	<label>
		<?php
		if ( ! empty( $products ) ) {
			?>
			<select name="_materials" data-placeholder="Select a product" class="chosen">
				<option></option>
				<?php
				foreach ( $products as $product ) {
					?>
					<option value="<?php echo $product->ID; ?>" <?php selected( $product->ID, $materials ); ?>>
						<?php echo $product->post_title; ?>
					</option>
					<?php
				}
				?>
			</select>
		<?php
		}
		?>
	</label>
<?php
}

add_action( 'save_post', function ( $post_ID ) {

	if ( ! isset( $_POST['featured_product_materials_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['featured_product_materials_nonce'], __FILE__ ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_page', $post_ID ) ) {
		return;
	}

	$options = array(
		'_materials',
	);

	foreach ( $options as $option ) {

		if ( ! isset( $_POST[ $option ] ) || empty( $_POST[ $option ] ) ) {
			delete_post_meta( $post_ID, $option );
		}

		update_post_meta( $post_ID, $option, $_POST[ $option ] );
	}
} );