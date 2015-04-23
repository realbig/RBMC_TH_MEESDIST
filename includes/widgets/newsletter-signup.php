<?php
/**
 * Widget: Newsletter Signup.
 *
 * @since   1.0.0
 * @package MeesDist
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'widgets_init', function () {
	register_widget( 'MeesDist_Widget_NewsletterSignup' );
} );

/**
 * Class MeesDist_Widget_NewsletterSignup
 *
 * Widget for showing Images.
 *
 * @since 1.0.0
 */
class MeesDist_Widget_NewsletterSignup extends WP_Widget {

	public function __construct() {

		// Build the widget
		parent::__construct(
			'meesdist_widget_newslettersignup',
			'Newsletter Signup',
			array(
				'description' => 'Shows a newsletter signup form.',
			)
		);
	}

	public function widget( $args, $instance ) {

		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		?>
		<div class="row collapse">
			<div class="columns small-12 medium-6">
				<?php echo $instance['description']; ?>
			</div>

			<div class="columns small-12 medium-6">
				<div class="row collapse">
					<div class="columns small-10">
						<input type="text" placeholder="EMAIL">
					</div>
					<div class="columns small-2">
						<button type="submit" class="button postfix"><span class="fa fa-arrow-right"></span></button>
					</div>
				</div>
			</div>
		</div>
		<?php
		echo $args['after_widget'];
	}

	public function form( $instance ) {

		$title       = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$description = ! empty( $instance['description'] ) ? $instance['description'] : false;
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
			       name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
			       value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'description' ); ?>">Description:</label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>"
			          name="<?php echo $this->get_field_name( 'description' ); ?>"
				><?php echo esc_attr( $description ); ?></textarea>
		</p>
	<?php
	}
}