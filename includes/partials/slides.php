<?php
/**
 * Slide show.
 *
 * @since   1.0.0
 * @package MeesDist
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

$slides = get_posts( array(
	'post_type'   => 'slide',
	'numberposts' => - 1,
) );

global $post;

if ( ! empty( $slides ) ) {
	?>
	<div class="slick-slider">
			<?php
			foreach ( $slides as $post ) {
				setup_postdata( $post );
				?>
				<div>
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'slide' );
					}
					?>
				</div>
				<?php
				wp_reset_postdata();
			}
			?>
	</div>
<?php
}