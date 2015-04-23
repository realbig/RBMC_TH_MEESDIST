<?php
/**
 * Template Name: Gallery
 *
 * Displays a gallery below the content.
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
?>

	<section id="site-content" class="row">

		<h1 class="page-title">
			<span class="text">
				<?php the_title(); ?>
			</span>
		</h1>

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="columns small-12 medium-8">
				<?php the_post_thumbnail( 'full' ); ?>
			</div>
		<?php endif; ?>

		<article id="page-<?php the_ID(); ?>" <?php post_class( array( 'columns', 'small-12', 'medium-4' ) ); ?>>
			<div class="page-content">
				<?php the_content(); ?>
			</div>
		</article>
	</section>

<?php
if ( $gallery = get_post_meta( get_the_ID(), '_gallery', true ) ) :
	?>
	<section class="gallery-section row collapse">
		<div class="columns small-12">
			<?php echo apply_filters( 'the_content', $gallery ); ?>
		</div>
	</section>
<?php
endif;

get_footer();