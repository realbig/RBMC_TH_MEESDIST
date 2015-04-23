<?php
/**
 * Template Name: Contact
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

global $post;

$_locations = get_posts( array(
	'post_type'   => 'location',
	'numberposts' => - 1,
) );

$locations = array(
	'showrooms'                 => array(),
	'stone-fabrication-centers' => array(),
);

if ( ! empty( $_locations ) ) {

	foreach ( $_locations as $location ) {

		if ( has_term( 'showroom', 'location_type', $location ) ) {
			$locations['showrooms'][] = $location;
		} elseif ( has_term( 'stone-fabrication-center', 'location_type', $location ) ) {
			$locations['stone-fabrication-centers'][] = $location;
		}
	}
}
?>

	<section id="site-content" class="row">

		<h1 class="page-title">
			<span class="text">
				<?php the_title(); ?>
			</span>
		</h1>

		<div class="columns small-12">
			<h2 class="section-title">
				Showroom Locations
			</h2>
		</div>

		<?php if ( ! empty( $locations['showrooms'] ) ) :

			$columns_class = meesdist_get_dynamic_columns( count( $locations['showrooms'] ), false, 3, 3 );

			foreach ( $locations['showrooms'] as $post ) :
				setup_postdata( $post );

				$post_meta = get_post_meta( get_the_ID() );
				?>

				<article id="location-<?php the_ID(); ?>" <?php post_class( array( $columns_class, 'showroom' ) ); ?>>

					<h3 class="location-title"><?php the_title(); ?></h3>

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

		<div class="columns small-12 medium-4">

			<h2 class="section-title">
				Stone Fabrication Centers
			</h2>

			<div class="row collapse">
				<?php if ( ! empty( $locations['stone-fabrication-centers'] ) ) : ?>

					<?php
					foreach ( $locations['stone-fabrication-centers'] as $post ) :
						setup_postdata( $post );

						$post_meta = get_post_meta( get_the_ID() );
						?>

						<article id="location-<?php the_ID(); ?>" <?php post_class( array(
							'columns',
							'small-12',
							'stone-fabrication-center',
						) ); ?>>

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

						</article>

					<?php
					endforeach;
					wp_reset_postdata();
				endif;
				?>
			</div>
		</div>

		<div class="columns small-12 medium-8">

			<h2 class="section-title">
				Email Mees Distributors, Inc.
			</h2>

			<?php
			if ( $form = get_post_meta( get_the_ID(), '_form', true ) ) {
				gravity_form(
					$form,
					$display_title = false,
					$display_description = true,
					$display_inactive = false,
					$field_values = null,
					$ajax = true
				);
			}
			?>
		</div>
	</section>

<?php
get_footer();