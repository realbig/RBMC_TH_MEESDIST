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
	'tax_query' => array(
		array(
			'taxonomy' => 'slide_location',
			'field' => 'slug',
			'terms' => isset( $slide_location ) ? $slide_location : '',
			'include_children' => false
		),
	),
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