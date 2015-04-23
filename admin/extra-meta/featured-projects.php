<?php
/**
 * Featured Projects extra meta.
 *
 * @since   1.0.0
 * @package MeesDist
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'add_meta_boxes', '_meesdist_add_metaboxes_featuredprojects' );
add_action( 'save_post', '_meesdist_save_metaboxes_featuredprojects' );

function _meesdist_add_metaboxes_featuredprojects() {

	global $post;

	if ( get_post_meta( $post->ID, '_wp_page_template', true ) != 'page-templates/featured-project.php' ) {
		return;
	}

	wp_enqueue_style( THEME_ID . '-chosen' );
	wp_enqueue_script( THEME_ID . '-chosen' );

	add_meta_box(
		'meesdist_mb_featuredprojects',
		'Home Information',
		'_meesdist_mb_featuredprojects',
		'page'
	);
}

function _meesdist_mb_featuredprojects() {

	global $post;

	wp_nonce_field( __FILE__, 'meesdist_mb_featuredprojects_nonce' );

	$materials_used = get_post_meta( $post->ID, '_materials_used', true );

	$material_term = get_term_by( 'name', 'materials', 'product_cat' );
	$materials = get_term_children( $material_term->term_id, 'product_cat' );
	?>
	<label>
		<?php
		if ( ! empty( $materials ) ) {
			?>
			<select style="width: 100%;" name="_materials_used[]" data-placeholder="Select a product" class="chosen" multiple>
				<option></option>
				<?php
				foreach ( $materials as $term_ID ) {
					$material = get_term_by( 'id', $term_ID, 'product_cat' );
					?>
					<option value="<?php echo $material->term_id; ?>" <?php echo in_array( $material->term_id, $materials_used ) ? 'selected' : ''; ?>>
						<?php echo $material->name; ?>
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

function _meesdist_save_metaboxes_featuredprojects( $post_ID ) {

	if ( ! isset( $_POST['meesdist_mb_featuredprojects_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['meesdist_mb_featuredprojects_nonce'], __FILE__ ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_page', $post_ID ) ) {
		return;
	}

	$options = array(
		'_materials_used',
	);

	foreach ( $options as $option ) {

		if ( ! isset( $_POST[ $option ] ) || empty( $_POST[ $option ] ) ) {
			delete_post_meta( $post_ID, $option );
		}

		update_post_meta( $post_ID, $option, $_POST[ $option ] );
	}
}