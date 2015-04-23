<?php
/**
 * Location post type archive.
 *
 * @since   0.1.0
 * @package MeesDist
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

get_header();

$locations = array(
	'showrooms' => array(),
	'stone-fabrication-centers' => array(),
);

if ( have_posts() ) {
	global $post;
	while ( have_posts() ) {
		the_post();

		if ( has_term( 'showroom', 'location_type' ) ) {
			$locations['showrooms'][] = $post;
		} elseif ( has_term( 'stone-fabrication-center', 'location_type' ) ) {
			$locations['stone-fabrication-centers'][] = $post;
		}
	}
}
?>

	<section id="site-content" class="row">

		<h1 class="page-title">
			<span class="text">
				Locations
			</span>
		</h1>

		<?php if ( ! empty( $locations['showrooms'] ) ) :

			$columns_class = meesdist_get_dynamic_columns( count( $locations['showrooms'] ), false, 3, 3 );

			foreach ( $locations['showrooms'] as $post ) :
				setup_postdata( $post );

				$post_meta = get_post_meta( get_the_ID() );
				?>

				<article id="location-<?php the_ID(); ?>" <?php post_class( array( $columns_class, 'showroom' ) ); ?>>

					<div class="location-thumbnail">
						<h3 class="location-title"><?php the_title(); ?> Showroom</h3>
						<?php the_post_thumbnail( 'full' ); ?>
					</div>

					<?php if ( isset( $post_meta['_address_line_1'][0] ) && ! empty( $post_meta['_address_line_1'][0] ) ) : ?>
						<p class="location-address">
							<?php echo $post_meta['_address_line_1'][0]; ?>

							<?php if ( isset( $post_meta['_address_line_2'][0] ) && ! empty( $post_meta['_address_line_2'][0] ) ) : ?>
								<br/><?php echo $post_meta['_address_line_2'][0]; ?>
							<?php endif; ?>
						</p>
					<?php endif; ?>

					<?php if ( isset( $post_meta['_phone'][0] ) && ! empty( $post_meta['_phone'][0] ) ) : ?>
						<p class="location-phone">
							<strong>Phone:</strong> <?php echo $post_meta['_phone'][0]; ?>

							<?php if ( isset( $post_meta['_fax'][0] ) && ! empty( $post_meta['_fax'][0] ) ) : ?>
								<br/><strong>Fax:</strong> <?php echo $post_meta['_fax'][0]; ?>
							<?php endif; ?>
						</p>
					<?php endif; ?>

					<?php if ( isset( $post_meta['_email'][0] ) && ! empty( $post_meta['_email'][0] ) ) : ?>
						<p class="location-email">
							<strong>Email:</strong> <a href="<?php echo $post_meta['_email'][0]; ?>">
								<?php echo $post_meta['_email'][0]; ?>
							</a>
						</p>
					<?php endif; ?>

					<?php if ( isset( $post_meta['_hours'][0] ) && ! empty( $post_meta['_hours'][0] ) ) : ?>
						<div class="location-hours">
							<strong>Hours:</strong> <?php echo wpautop( $post_meta['_hours'][0] ); ?>
						</div>
					<?php endif; ?>

				</article>

			<?php
			endforeach;
			wp_reset_postdata();
		endif;
		?>

		<div class="clear"></div>

		<?php if ( ! empty( $locations['stone-fabrication-centers'] ) ) : ?>

			<h2 class="stone-fabrication-centers-title">
				Stone Fabrication Centers
			</h2>

			<?php
			$columns_class = meesdist_get_dynamic_columns( count( $locations['stone-fabrication-centers'] ), false, 3, 3 );

			foreach ( $locations['stone-fabrication-centers'] as $post ) :
				setup_postdata( $post );

				$post_meta = get_post_meta( get_the_ID() );
				?>

				<article id="location-<?php the_ID(); ?>" <?php post_class( array( $columns_class, 'stone-fabrication-center' ) ); ?>>

					<div class="row">

						<div class="location-thumbnail columns small-12 medium-8">
							<?php the_post_thumbnail( 'full' ); ?>
						</div>

						<div class="location-content columns small-12 medium-4">

							<h3 class="location-title">
								<?php the_title(); ?>
							</h3>

							<?php if ( isset( $post_meta['_address_line_1'][0] ) && ! empty( $post_meta['_address_line_1'][0] ) ) : ?>
								<p class="location-address">
									<?php echo $post_meta['_address_line_1'][0]; ?>

									<?php if ( isset( $post_meta['_address_line_2'][0] ) && ! empty( $post_meta['_address_line_2'][0] ) ) : ?>
										<br/><?php echo $post_meta['_address_line_2'][0]; ?>
									<?php endif; ?>
								</p>
							<?php endif; ?>

							<?php if ( isset( $post_meta['_phone'][0] ) && ! empty( $post_meta['_phone'][0] ) ) : ?>
								<p class="location-phone">
									<strong>Phone:</strong> <?php echo $post_meta['_phone'][0]; ?>

									<?php if ( isset( $post_meta['_fax'][0] ) && ! empty( $post_meta['_fax'][0] ) ) : ?>
										<br/><strong>Fax:</strong> <?php echo $post_meta['_fax'][0]; ?>
									<?php endif; ?>
								</p>
							<?php endif; ?>

							<?php if ( isset( $post_meta['_email'][0] ) && ! empty( $post_meta['_email'][0] ) ) : ?>
								<p class="location-email">
									<strong>Email:</strong> <a href="<?php echo $post_meta['_email'][0]; ?>">
										<?php echo $post_meta['_email'][0]; ?>
									</a>
								</p>
							<?php endif; ?>

							<?php if ( isset( $post_meta['_hours'][0] ) && ! empty( $post_meta['_hours'][0] ) ) : ?>
								<div class="location-hours">
									<strong>Hours:</strong> <?php echo wpautop( $post_meta['_hours'][0] ); ?>
								</div>
							<?php endif; ?>
						</div>


					</div>

				</article>

			<?php
			endforeach;
			wp_reset_postdata();
		endif;
		?>
	</section>

<?php
get_footer();