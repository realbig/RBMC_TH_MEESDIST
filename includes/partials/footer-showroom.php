<?php
/**
 * Displays a showroom in the footer.
 *
 * @since   1.0.0
 * @package MeesDist
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}
?>
<div class="<?php meesdist_dynamic_columns( 1 + count( $showrooms ) ); ?>">
	<h3>
		<?php the_title(); ?> Showroom
	</h3>

	<p>
		<?php echo get_post_meta( get_the_ID(), '_address_line_1', true ); ?>
		<?php echo get_post_meta( get_the_ID(), '_address_line_2', true ); ?>

		<br/>

		<?php if ( $phone = get_post_meta( get_the_ID(), '_phone', true ) ): ?>
			Phone: <?php echo $phone; ?>

			<?php if ( $fax = get_post_meta( get_the_ID(), '_fax', true ) ) : ?>
				Fax: // <?php echo $fax; ?>
			<?php endif; ?>

		<?php endif; ?>

		<br/>

		<?php if ( $email = get_post_meta( get_the_ID(), '_email', true ) ): ?>
			Email: <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
		<?php endif; ?>

		<br/>

		<?php if ( $hours = get_post_meta( get_the_ID(), '_hours', true ) ): ?>
			Hours: <?php echo wptexturize( $hours ); ?>
		<?php endif; ?>
	</p>
</div>