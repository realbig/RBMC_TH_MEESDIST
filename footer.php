<?php
/**
 * The theme's footer file that appears on EVERY page.
 *
 * @since 0.1.0
 * @package MeesDist
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

$showrooms = get_posts( array(
	'post_type' => 'location',
	'tax_query' => array(
		array(
			'taxonomy' => 'location_type',
			'field' => 'name',
			'terms' => 'showroom',
			'include_children' => false
		),
	),
));
?>

<footer id="site-footer">

	<div class="row collapse">
		<div class="footer-widget <?php meesdist_dynamic_columns( 1 + count( $showrooms ) ); ?>">
			<?php dynamic_sidebar( 'footer' ); ?>
		</div>

		<?php
		if ( ! empty( $showrooms ) ) :
			foreach ( $showrooms as $post ) :
				setup_postdata( $post );
				include __DIR__ . '/includes/partials/footer-showroom.php';
				wp_reset_postdata();
			endforeach;
		endif;
		?>
	</div>

</footer>

<a class="exit-off-canvas"></a>

<?php // .inner-wrap ?>
</div>

<?php // #wrapper ?>
</div>

<?php wp_footer(); ?>

</body>
</html>