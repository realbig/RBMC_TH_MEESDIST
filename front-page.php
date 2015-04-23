<?php
/**
 * The theme's front-page file use for displaying the home page.
 *
 * @since   0.1.0
 * @package MeesDist
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

get_header();
?>

	<section class="home-slides row collapse">
		<div class="columns small-12">
			<?php
			$slide_location = 'home';
			include __DIR__ . '/includes/partials/slides.php';
			?>
		</div>
	</section>

	<section class="page-content row collapse">

		<div class="columns small-12">
			<?php the_content(); ?>
		</div>

	</section>

	<section class="home-banner row collapse">
		<div class="columns small-12 medium-6 show-for-medium-up">
			<?php dynamic_sidebar( 'home-left' ); ?>
		</div>

		<div class="columns small-12 medium-6 small-only-text-center">
			<?php dynamic_sidebar( 'home-right' ); ?>
		</div>
	</section>
<?php
get_footer();