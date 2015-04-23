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

<div id="wrapper" class="off-canvas-wrap" data-offcanvas>
	<div class="inner-wrap">

		<aside class="left-off-canvas-menu">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
			) );
			?>
		</aside>

		<header id="site-header">

			<div class="top-nav">

				<div class="row collapse">

					<div class="columns small-12">

						<div class="left">

							<a class="left-off-canvas-toggle show-for-small-only fa fa-bars" href="#" ></a>

							<?php get_search_form(); ?>

							<div class="right show-for-small-only">
								<a href="/locations/">
									<span class="fa fa-location-arrow"></span> Locations
								</a>
							</div>

							<ul class="top-nav show-for-medium-up">
								<li class="top-nav-item">
									<a href="/">
										<span class="fa fa-home"></span> Home
									</a>
								</li>
								<li class="top-nav-item">
									<a href="/locations/">
										<span class="fa fa-location-arrow"></span> Locations
									</a>
								</li>
								<li class="top-nav-item">
									<a href="/trade/">
										<span class="fa fa-download"></span> Trade
									</a>
								</li>
							</ul>
						</div>

						<div class="right show-for-medium-up">
							<a href="/blog/">Blog</a>
							<?php dynamic_sidebar( 'header' ); ?>
						</div>

					</div>

				</div>

			</div>

			<div class="site-logo text-center">
				<a href="<?php bloginfo( 'url' ); ?>">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="mees distributors inc" />
				</a>
			</div>

			<nav class="site-nav row show-for-medium-up">
				<div class="columns small-12">
					<?php
					global $_meesdist_primary_nav_count;
					$primary_nav                 = wp_get_nav_menu_object( 'primary' );
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