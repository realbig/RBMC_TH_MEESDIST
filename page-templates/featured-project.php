<?php
/**
 * Template Name: Featured Project
 *
 * The theme's page file use for displaying pages.
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

// Grab title then disable (so it doesn't show in page content)
global $post;
$title = $post->post_title;
$post->post_title = false;
?>

	<h1 class="page-title row collapse">
		<span class="text">
			<?php echo $title; ?>
		</span>
	</h1>

	<section class="featured-project-slides row collapse">
		<div class="columns small-12">
			<?php
			$slide_location = 'featured-projects';
			include get_template_directory() . '/includes/partials/slides.php';
			?>
		</div>
	</section>

<?php
meesdist_partial( 'page-content' );

if ( $materials = get_post_meta( get_the_ID(), '_materials_used', true ) ) :
	?>

	<section class="featured-project-materials-used row collapse">
		<div class="columns small-12">

			<h2 class="materials-used-title">Materials Used</h2>

			<ul class="materials-used-list <?php meesdist_dynamic_columns( count( $materials ), true, 4, 6 ); ?>">
				<?php
				global $post;
				foreach ( $materials as $term_ID ) :
					$material = get_term_by( 'id', $term_ID, 'product_cat' );
					?>

					<li>
						<?php
						$thumbnail_id = get_woocommerce_term_meta( $term_ID, 'thumbnail_id', true );
						$image        = wp_get_attachment_image_src( $thumbnail_id );
						if ( $image ) {
							echo '<img src="' . $image[0] . '" alt="" />';
						}
						?>
						<h4 class="material-used-title">
							<?php echo $material->name; ?>
						</h4>
					</li>

				<?php
				endforeach;
				wp_reset_postdata();
				?>
			</ul>

		</div>
	</section>

<?php
endif;

wp_reset_postdata();

get_footer();