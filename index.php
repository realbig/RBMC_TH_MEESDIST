<?php
/**
 * The theme's index file used for displaying an archive of blog posts.
 *
 * @since   0.1.0
 * @package MeesDist
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

get_header();
?>

	<section id="site-content" class="row collapse">

		<h1 class="page-title">
		<span class="text">
			Blog
		</span>
		</h1>

		<?php if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'columns', 'small-12' ) ); ?>>

					<a href="<?php the_permalink(); ?>">
						<h1 class="post-title">
							<?php the_title(); ?>

							<span class="post-date">
								<?php echo get_the_date(); ?>
							</span>
						</h1>
					</a>

					<div class="post-thumbnail">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'full' ); ?>
						</a>
					</div>

					<div class="post-excerpt">
						<?php the_excerpt(); ?>
					</div>

					<a href="<?php the_permalink(); ?>" class="read-more-link">
						Read more...
					</a>
				</article>

			<?php
			endwhile;
			the_posts_pagination( array(
				'prev_text' => '&laquo; Older',
				'next_text' => 'Newer &raquo;',
			) );
		endif;
		?>
	</section>

<?php
get_footer();