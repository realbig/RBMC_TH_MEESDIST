<?php
/**
 * The theme's 404 page for showing not found pages.
 *
 * @since 0.1.0
 * @package MeesDist
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

get_header();

$contact_page = get_page_by_path( 'contact' );
$contact_link = $contact_page ? get_permalink( $contact_page->ID ) : false;
?>

	<section id="site-content" class="row collapse">


		<h1 class="page-title row">
			<span class="text">
				404 - Not Found
			</span>
		</h1>

		<div class="columns small-12">

			<div class="page-content">
				Sorry, but there doesn't seem to be anything here!

				Perhaps one of these pages could be helpful:
				<?php
				wp_nav_menu( array(
					'theme_location' => 'error-404',
					'container' => false,
				));
				?>

				<?php if ( $contact_link ) : ?>
					If you're still lost, you can always <a href="<?php echo $contact_link; ?>">contact us</a>.
				<?php endif; ?>
			</div>

		</div>

	</section>

<?php
get_footer();