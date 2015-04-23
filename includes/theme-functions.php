<?php
/**
 * Adds theme functions.
 *
 * @since   0.1.0
 * @package MeesDist
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_filter( 'post_gallery', '_meesdist_gallery_output', 10, 2 );
add_action( 'pre_get_posts', '_meesdist_modify_query' );
add_filter("the_content", "meesdist_strip_br_shortcode");

/**
 * Modifies the default WP Gallery to make it foundation compatible.
 *
 * @since 0.1.0
 *
 * @param $output string The gallery HTML.
 * @param $attr   array The shortcode attributes.
 *
 * @return mixed|string|void The gallery HTML.
 */
function _meesdist_gallery_output( $output, $attr ) {

	$post = get_post();

	static $instance = 0;
	$instance ++;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) ) {
			$attr['orderby'] = 'post__in';
		}
		$attr['include'] = $attr['ids'];
	}

	$html5 = current_theme_supports( 'html5', 'gallery' );

	$atts = shortcode_atts( array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post ? $post->ID : 0,
		'itemtag'    => 'li',
		'icontag'    => $html5 ? 'div' : 'dt',
		'titletag'   => 'h3',
		'captiontag' => $html5 ? 'figcaption' : 'dd',
		'size'       => 'gallery',
		'include'    => '',
		'exclude'    => '',
		'link'       => ''
	), $attr, 'gallery' );

	$id = intval( $atts['id'] );

	if ( ! empty( $atts['include'] ) ) {
		$_attachments = get_posts(
			array(
				'include'        => $atts['include'],
				'post_status'    => 'inherit',
				'post_type'      => 'attachment',
				'post_mime_type' => 'image',
				'order'          => $atts['order'],
				'orderby'        => $atts['orderby']
			)
		);

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[ $val->ID ] = $_attachments[ $key ];
		}
	} elseif ( ! empty( $atts['exclude'] ) ) {
		$attachments = get_children(
			array(
				'post_parent'    => $id,
				'exclude'        => $atts['exclude'],
				'post_status'    => 'inherit',
				'post_type'      => 'attachment',
				'post_mime_type' => 'image',
				'order'          => $atts['order'],
				'orderby'        => $atts['orderby']
			)
		);
	} else {
		$attachments = get_children(
			array(
				'post_parent'    => $id,
				'post_status'    => 'inherit',
				'post_type'      => 'attachment',
				'post_mime_type' => 'image',
				'order'          => $atts['order'],
				'orderby'        => $atts['orderby']
			)
		);
	}

	if ( empty( $attachments ) ) {
		return '';
	}

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment ) {
			$output .= wp_get_attachment_link( $att_id, $atts['size'], true ) . "\n";
		}

		return $output;
	}

	$itemtag    = tag_escape( $atts['itemtag'] );
	$titletag   = tag_escape( $atts['titletag'] );
	$captiontag = tag_escape( $atts['captiontag'] );
	$icontag    = tag_escape( $atts['icontag'] );
	$valid_tags = wp_kses_allowed_html( 'post' );
	if ( ! isset( $valid_tags[ $itemtag ] ) ) {
		$itemtag = 'dl';
	}
	if ( ! isset( $valid_tags[ $titletag ] ) ) {
		$titletag = 'dd';
	}
	if ( ! isset( $valid_tags[ $icontag ] ) ) {
		$icontag = 'dt';
	}


	$selector = "gallery-{$instance}";

	$columns = count( $attachments );
	if ( $columns > 5 ) {
		$columns = 5;
	}

	$gridclass = 'small-block-grid-1';

	if ( $columns <= 3 && $columns > 1 ) {

		$gridclass .= " medium-block-grid-$columns";

	} elseif ( $columns > 3 ) {

		$gridclass .= " medium-block-grid-3 large-block-grid-$columns";

	}

	$gallery_style = '';
	$size_class    = sanitize_html_class( $atts['size'] );
	$gallery_div   = "<div id='$selector' class='gallery galleryid-{$id} {$gridclass} gallery-size-{$size_class}'>";

	/**
	 * Filter the default gallery shortcode CSS styles.
	 *
	 * @since 2.5.0
	 *
	 * @param string $gallery_style Default CSS styles and opening HTML div container
	 *                              for the gallery shortcode output.
	 */
	$output = apply_filters( 'gallery_style', $gallery_style . $gallery_div );

	$i = 0;
	foreach ( $attachments as $id => $attachment ) {

		$attr = ( trim( $attachment->post_excerpt ) ) ? array( 'aria-describedby' => "$selector-$id" ) : '';
		if ( ! empty( $atts['link'] ) && 'file' === $atts['link'] ) {
			$image_output = wp_get_attachment_link( $id, $atts['size'], false, false, false, $attr );
		} elseif ( ! empty( $atts['link'] ) && 'none' === $atts['link'] ) {
			$image_output = wp_get_attachment_image( $id, $atts['size'], false, $attr );
		} else {
			$image_output = wp_get_attachment_link( $id, $atts['size'], true, false, false, $attr );
		}
		$image_meta = wp_get_attachment_metadata( $id );

		$orientation = '';
		if ( isset( $image_meta['height'], $image_meta['width'] ) ) {
			$orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
		}
		$output .= "<{$itemtag} class='gallery-item'>";

		if ( $titletag && trim( $attachment->post_excerpt ) ) {
			$output .= "
				<{$titletag} class='gallery-title' id='$selector-$id'>
				" . wptexturize( $attachment->post_excerpt ) . "
				</{$titletag}>";
		}

		$output .= "
			<{$icontag} class='gallery-icon {$orientation}'>
				$image_output
			</{$icontag}>";

		if ( $captiontag && trim( $attachment->post_content ) ) {
			$output .= "
				<{$captiontag} class='gallery-description'>
				" . wptexturize( $attachment->post_content ) . "
				</{$captiontag}>";
		}

		$output .= "</{$itemtag}>";

		if ( ! $html5 && $columns > 0 && ++ $i % $columns == 0 ) {
			$output .= '<br style="clear: both" />';
		}
	}

	$output .= "
		</div>\n";

	return $output;
}

function _meesdist_modify_query( $query ) {

	if ( ! $query->is_main_query() ) {
		return;
	}

	if ( is_post_type_archive( 'location' ) ) {
		$query->set( 'posts_per_page', 50 );
	}

	if ( is_post_type_archive( 'product' ) ) {
		$query->set( 'posts_per_page', 16 );
	}

	if ( is_post_type_archive( 'gallery_item' ) ) {
		$query->set( 'posts_per_page', 16 );
	}
}

function meesdist_partial( $name ) {
	include __DIR__ . "/partials/$name.php";
}

function meesdist_dynamic_columns( $count, $block_grid = false, $medium_max = 4, $large_max = 5 ) {
	echo meesdist_get_dynamic_columns( $count, $block_grid, $medium_max, $large_max );
}

function meesdist_get_dynamic_columns( $count, $block_grid = false, $medium_max = 4, $large_max = 5 ) {

	$output      = '';
	$small_name  = 'small';
	$medium_name = 'medium';
	$large_name  = 'large';

	$small_size  = 1;
	$medium_size = min( $medium_max, $count );
	$large_size  = min( $large_max, $count );

	if ( ! $block_grid ) {

		$small_size  = 12 / $small_size;
		$medium_size = 12 / $medium_size;
		$large_size  = 12 / $large_size;
		$output .= 'columns ';
	} else {

		$small_name .= '-block-grid';
		$medium_name .= '-block-grid';
		$large_name .= '-block-grid';
	}

	$output .= "$small_name-$small_size";
	$output .= $count === 1 ? '' : " $medium_name-$medium_size";
	$output .= $count <= $medium_max ? '' : " $large_name-$large_size";

	return $output;
}

function meesdist_strip_br_shortcode($content) {
	$block = join("|",array("timeline_wrapper", "timeline_item"));
	$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
	$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);
	return $rep;
}