<?php
/**
 * Widget: Image.
 *
 * @since   1.0.0
 * @package MeesDist
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'widgets_init', function () {
	register_widget( 'MeesDist_Widget_Image' );
} );

/**
 * Class MeesDist_Widget_Image
 *
 * Widget for showing Images.
 *
 * @since 1.0.0
 */
class MeesDist_Widget_Image extends WP_Widget {

	public function __construct() {

		// Build the widget
		parent::__construct(
			'meesdist_widget_image',
			'Parallax Image',
			array(
				'description' => 'Shows an image with a parallax effect.',
			)
		);
	}

	public function widget( $args, $instance ) {

		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

		$image_ID = isset( $instance['image'] ) && ! empty( $instance['image'] ) ? (int) $instance['image'] : false;
		$link = isset( $instance['link'] ) && ! empty( $instance['link'] ) ? $instance['link'] : false;

		if ( $image_ID !== false ) {
			?>
			<div class="img-holder" data-image="<?php $image = wp_get_attachment_image_src( $image_ID, 'full' ); echo $image[0]; ?>"
			     data-cover-ratio="0.4"></div>
			<?php
		}

		echo $args['after_widget'];
	}

	public function form( $instance ) {

		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$image = ! empty( $instance['image'] ) ? $instance['image'] : false;
		$link = ! empty( $instance['link'] ) ? $instance['link'] : false;

		$image_preview = $image !== false ? wp_get_attachment_image_src( $image, 'full' ) : false;
		$image_preview = $image_preview !== false ? $image_preview[0] : '';
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
			       name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
			       value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'image' ); ?>">Image:</label>
			<br/>
			<img src="<?php echo $image_preview; ?>" class="image-preview" style="max-width: 100%; height: auto;" />
			<br/>
			<input type="button" class="button image-button" value="Choose / Upload Image" />

			<input class="image-id" id="<?php echo $this->get_field_id( 'image' ); ?>"
			       name="<?php echo $this->get_field_name( 'image' ); ?>" type="hidden"
			       value="<?php echo esc_attr( $image ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'link' ); ?>">Link:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>"
			       name="<?php echo $this->get_field_name( 'link' ); ?>" type="text"
			       value="<?php echo esc_attr( $link ); ?>">
		</p>
	<?php
	}
}