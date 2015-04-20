<?php
/**
 * The theme's header file that appears on EVERY page.
 *
 * @since   0.1.0
 * @package MeesDist
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/vendor/js/nomin/html5.js"></script>
	<![endif]-->

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="wrapper">

	<header id="site-header">

		<div class="top-nav">

			<div class="row">

				<div class="columns small-12">

					<div class="left">
						<?php get_search_form(); ?>

						<ul class="top-nav">
							<li class="top-nav-item">
								<span class="fa fa-home"></span> Home
							</li>
							<li class="top-nav-item">
								<span class="fa fa-location-arrow"></span> Locations
							</li>
							<li class="top-nav-item">
								<span class="fa fa-download"></span> Trade
							</li>
						</ul>
					</div>

					<div class="right">
						<a href="/blog/">Blog</a>
						<?php dynamic_sidebar( 'header' ); ?>
					</div>

				</div>

			</div>

		</div>

		<div class="site-logo text-center">
			<div class="container">
				<h1 class="site-title"><?php bloginfo( 'title' ); ?></h1>
				<p class="site-description"><?php bloginfo( 'description' ); ?></p>
			</div>
		</div>

		<nav class="site-nav row">
			<div class="columns small-12">
				<?php
				global $_meesdist_primary_nav_count;
				$primary_nav             = wp_get_nav_menu_object( 'primary' );
				$_meesdist_primary_nav_count = $primary_nav->count;

				require_once __DIR__ . '/includes/primary-nav-walker.php';

				wp_nav_menu( array(
					'theme_location' => 'primary',
					'container'      => false,
					'walker'         => new MeesDist_Walker_PrimaryNav,
				) );
				?>
			</div>
		</nav>

	</header>