<?php
/**
 * Template Name: New Arrivals
 *
 * Shows new products
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

$products = get_posts( array(
	'post_type'   => 'product',
	'numberposts' => 16,
) );

global $post;
?>

	<section id="site-content" class="row collapse">

		<h1 class="page-title">
			<span class="text">
				<?php the_title(); ?>
			</span>
		</h1>

		<?php if ( ! empty ( $products ) ) : ?>
			<ul class="product-list new-arrivals small-block-grid-1 medium-block-grid-2 large-block-grid-4">
			<?php
			foreach ( $products as $post ) :
				setup_postdata( $post );
				?>
				<li>
					<?php the_post_thumbnail(); ?>
					<h3 class="product-title">
						<?php the_title(); ?>
					</h3>
				</li>
				<?php
				wp_reset_postdata();
			endforeach;

			the_posts_pagination( array(
				'prev_text' => '&laquo; Older',
				'next_text' => 'Newer &raquo;',
			) );
			?>
			</ul>
		<?php endif; ?>
	</section>

<?php
get_footer();