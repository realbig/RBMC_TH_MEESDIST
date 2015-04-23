<?php
/**
 * Basic page content.
 *
 * @since   1.0.0
 * @package MeesDist
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

$post_class = array(
	'columns',
	'small-12',
);

if ( has_post_thumbnail() ) {
	$post_class[] = 'medium-4';
}
?>
<section id="site-content" class="row">

	<?php if ( $title = get_the_title() ) : ?>
		<h1 class="page-title row">
			<span class="text">
				<?php echo $title; ?>
			</span>
		</h1>
	<?php endif; ?>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-thumbnail columns small-12 medium-8">
			<?php the_post_thumbnail( 'full' ); ?>
		</div>
	<?php endif; ?>

	<article id="page-<?php the_ID(); ?>" <?php post_class( $post_class ); ?>>
		<div class="page-content">
			<?php the_content(); ?>
		</div>
	</article>
</section>