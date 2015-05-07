<?php
/**
 * Template Name: Catalog Categories
 *
 * @since   0.1.0
 * @package MeesDist
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

get_header();

the_post();

$material_types = get_terms( 'product_cat', array(
	'hide_empty' => false,
) );
?>

	<section id="site-content" class="row">

		<?php if ( ! empty( $material_types ) ) : ?>

			<?php
			foreach ( $material_types as $material_type ) :

				$materials = get_terms( 'product_cat', array(
					'parent' => $material_type->term_id,
					'hide_empty' => false,
				));

				if (  empty( $materials ) ) {
					continue;
				}
				?>

				<h2 class="material-title">
					<span class="text">
						<?php echo $material_type->name; ?>
					</span>
				</h2>

				<ul class="material-list small-block-grid-2 medium-block-grid-4">
					<?php foreach ( $materials as $material ) : ?>
						<li>
							<?php
							$thumbnail_id = get_woocommerce_term_meta( $material->term_id, 'thumbnail_id', true );
							$image = wp_get_attachment_image( $thumbnail_id, 'gallery' );
							if ( $image ) {
								echo '<a href="' . get_term_link( $material ) . '">';
								echo $image . '<br/>';
								echo $material->name;
								echo '</a>';
							}
							?>
						</li>
					<?php endforeach; ?>
				</ul>

			<?php endforeach; ?>

		<?php endif; ?>

	</section>

<?php
get_footer();