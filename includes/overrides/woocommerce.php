<?php
/**
 * Filters and hooks for WooCommerce.
 *
 * @since   1.0.0
 * @package MeesDist
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

// Remove some default WooCommerce actions
add_filter( 'woocommerce_show_page_title', '__return_false' );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price' );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating' );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs' );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price' );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination' );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper' );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end' );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar' );

// Add new actions
add_action( 'woocommerce_before_main_content', '_meesdist_wc_page_start' );
add_action( 'woocommerce_after_main_content', '_meesdist_wc_page_end' );
add_action( 'woocommerce_single_product_summary', '_meedist_wc_add_sku' );

function _meesdist_wc_page_start() {

	if ( is_post_type_archive( 'product' ) ||
	     is_tax( 'product_cat' ) ||
	     is_tax( 'product_tag' ) ||
	     is_tax( 'product_attribute' )
	) : ?>
		<div class="woocommerce-actions row collapse">
			<div class="columns small-12">
				<?php woocommerce_pagination(); ?>
				<?php woocommerce_catalog_ordering(); ?>
			</div>
		</div>

		<h1 class="page-title row collapse">
			<span class="text">
				<?php woocommerce_page_title(); ?>
			</span>
		</h1>
	<?php endif; ?>

	<section id="site-content" class="row">
	<div class="columns small-12 medium-9 medium-push-3">
<?php
}

function _meesdist_wc_page_end() {
	?>

	</div>

	<aside class="sidebar sidebar-catalog columns small-3 show-for-medium-up medium-pull-9">
		<?php dynamic_sidebar( 'catalog' ); ?>
	</aside>

	<?php
	add_filter( 'woocommerce_output_related_products_args', function ( $args ) {
		$args['posts_per_page'] = 4;

		return $args;
	} );
	woocommerce_output_related_products();
	?>

	</section>

	<?php
	woocommerce_pagination();
}

function _meedist_wc_add_sku() {

	global $product;

	if ( $product->get_sku() ) :
		?>
		<p class="product-sku">
			#<?php echo $product->get_sku(); ?>
		</p>
	<?php endif; ?>

	<h3 class="product-details-title">Details:</h3>
<?php
}