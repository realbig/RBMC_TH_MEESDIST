<?php
/**
 * Search results
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
			Search
		</span>
		</h1>

		<p class="search-results-title">
			Results for <span class="search-query"><?php the_search_query(); ?></span>
		</p>

		<?php if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'search-result', 'columns', 'small-12' ) ); ?>>

					<h1 class="post-title section-title">
						<?php the_title(); ?>
					</h1>

					<div class="post-excerpt">
						<?php the_excerpt(); ?>
					</div>

					<a href="<?php the_permalink(); ?>" class="read-more-link button">
						View
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