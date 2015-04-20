<?php
/**
 * Widget: Text Icon.
 *
 * @since   1.0.0
 * @package MeesDist
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'widgets_init', function () {
	register_widget( 'MeesDist_Widget_TextIcon' );
} );

/**
 * Class MeesDist_Widget_TextIcon
 *
 * Widget for showing Text boxes with an Icon in the title.
 *
 * @since 1.0.0
 */
class MeesDist_Widget_TextIcon extends WP_Widget {

	public function __construct() {

		// Build the widget
		parent::__construct(
			'meesdist_texticon',
			'Text with Icon',
			array(
				'description' => 'For use in the sidebar. Shows text with an icon in the title.',
			)
		);
	}

	public function widget( $args, $instance ) {

		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {

			echo $args['before_title'];

			if ( ! empty( $instance['icon'] ) ) {
				?>
				<span class="meesdist-widget-icon icon-effect-small-light">
					<span class="flaticon-<?php echo $instance['icon']; ?>"></span>
				</span>
				<?php
			}

			echo apply_filters( 'widget_title', $instance['title'] );

			echo $args['after_title'];
		}

		if ( ! empty( $instance['text'] ) ) {
			?>
			<div class="meesdist-widget-text">
				<?php echo wpautop( do_shortcode( $instance['text'] ) ); ?>
			</div>
			<?php
		}

		echo $args['after_widget'];
	}

	public function form( $instance ) {

		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$icon = ! empty( $instance['icon'] ) ? $instance['icon'] : '';
		$text = ! empty( $instance['text'] ) ? $instance['text'] : '';
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
			       name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
			       value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'icon' ); ?>"><?php _e( 'Icon:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'icon' ); ?>"
			       name="<?php echo $this->get_field_name( 'icon' ); ?>" type="text"
			       value="<?php echo esc_attr( $icon ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text:' ); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" rows="10"
			       name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo esc_attr( $text ); ?></textarea>
		</p>
	<?php
	}
}