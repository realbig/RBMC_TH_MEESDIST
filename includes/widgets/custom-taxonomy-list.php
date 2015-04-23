<?php
/**
 * Widget: Custom Taxonomy List.
 *
 * @since   1.0.0
 * @package MeesDist
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'widgets_init', function () {
	register_widget( 'MeesDist_Widget_CustomTaxonomyList' );
} );

/**
 * Class MeesDist_Widget_CustomTaxonomyList
 *
 * Widget for showing Images.
 *
 * @since 1.0.0
 */
class MeesDist_Widget_CustomTaxonomyList extends WP_Widget {

	public function __construct() {

		// Build the widget
		parent::__construct(
			'meesdist_widget_customtaxonomylist',
			'Custom Taxonomy List',
			array(
				'description' => 'Shows a list of the custom taxonomy.',
			)
		);
	}

	public function widget( $args, $instance ) {

		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

		$tax = ! empty( $instance['tax'] ) ? $instance['tax'] : false;

		if ( $tax ) {
			echo '<ul class="custom-taxonomy-terms-list">';
			wp_list_categories( array(
				'taxonomy' => $tax,
				'hide_empty' => false,
				'title_li' => false,
			));
			echo '</ul>';
		}

		echo $args['after_widget'];
	}

	public function form( $instance ) {

		$tax = ! empty( $instance['tax'] ) ? $instance['tax'] : '';
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'tax' ); ?>">Taxonomy Name (slug):</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'tax' ); ?>"
			       name="<?php echo $this->get_field_name( 'tax' ); ?>" type="text"
			       value="<?php echo esc_attr( $tax ); ?>">
		</p>
	<?php
	}
}