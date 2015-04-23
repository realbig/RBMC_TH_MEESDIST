<?php
/**
 * Gallery post type archive.
 *
 * @since   0.1.0
 * @package MeesDist
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

get_header();

// TODO Sidebar
?>

	<section id="site-content" class="row">

		<h1 class="page-title">
			<span class="text">
				Gallery
			</span>
		</h1>

		<div class="columns small-12">
			<?php if ( have_posts() ) : ?>
				<ul class="gallery-list small-block-grid-1 medium-block-grid-2 large-block-grid-4">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<li>
						<?php
						if ( has_post_thumbnail() ) {
							$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
							echo '<a href="' . $large_image_url[0] . '" title="' . the_title_attribute( 'echo=0' ) . '">';
							the_post_thumbnail( 'thumbnail' );
							echo '</a>';
						}
						?>
					</li>
				<?php endwhile; ?>
				</ul>
			<?php endif; ?>
		</div>

<!--		<aside class="columns small-3 show-for-medium-up">-->
<!--			--><?php //dynamic_sidebar( 'gallery' ); ?>
<!--		</aside>-->
	</section>

<?php
get_footer();