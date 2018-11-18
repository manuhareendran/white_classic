<?php
/**
 * Handle featured gallery, quote,... for each post format
 *
 * @package Ahashop
 */

if ( ! function_exists( 'ahashop_get_first_gallery' ) ) {
	/**
	 * Get first gallery of string.
	 *
	 * @param string $content Post content of string.
	 * @return string Gallery shortcode.
	 */
	function ahashop_get_first_gallery( $content ) {
		$count = preg_match_all( '/' . get_shortcode_regex( array( 'gallery' ) ) . '/s', $content, $matches, PREG_SET_ORDER );

		if ( $count ) {
			return $matches[0][0];
		}

		return null;
	}
}

if ( ! function_exists( 'ahashop_get_gallery_attachments' ) ) {
	/**
	 * Get gallery attachments.
	 *
	 * @param  array $attr Gallery shortcode attributes.
	 * @return array       Array of attachments.
	 */
	function ahashop_get_gallery_attachments( $attr ) {
		$id = intval( $attr['id'] );

		if ( ! empty( $attr['include'] ) ) {
			$_attachments = get_posts( array( 'include' => $attr['include'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $attr['order'], 'orderby' => $attr['orderby'] ) );

			$attachments = array();
			foreach ( $_attachments as $key => $val ) {
				$attachments[ $val->ID ] = $_attachments[ $key ];
			}
		} elseif ( ! empty( $attr['exclude'] ) ) {
			$attachments = get_children( array( 'post_parent' => $id, 'exclude' => $attr['exclude'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $attr['order'], 'orderby' => $attr['orderby'] ) );
		} else {
			$attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $attr['order'], 'orderby' => $attr['orderby'] ) );
		}

		if ( empty( $attachments ) ) {
			return array();
		}

		return $attachments;
	}
}

/**
 * Featured gallery output.
 *
 * @param string $output   The gallery output. Default empty.
 * @param array  $attr     Attributes of the gallery shortcode.
 * @param int    $instance Unique numeric ID of this gallery shortcode instance.
 * @return string
 */
function ahashop_featured_gallery_shortcode( $output, $attr, $instance ) {
	if ( ! isset( $GLOBALS['featured_gallery'] ) || ! $GLOBALS['featured_gallery'] ) {
		return $output;
	}

	$post = get_post();

	$attr = shortcode_atts( array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post ? $post->ID : 0,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => '',
		'link'       => '',
	), $attr, 'gallery' );

	$attachments = ahashop_get_gallery_attachments( $attr );

	if ( ! $attachments ) {
		return;
	}

	ob_start();
	ahashop_featured_gallery_output( $attachments, $post );
	$output = ob_get_clean();

	$GLOBALS['featured_gallery'] = false;

	return $output;
}
add_filter( 'post_gallery', 'ahashop_featured_gallery_shortcode', 10, 3 );

if ( ! function_exists( 'ahashop_featured_gallery_output' ) ) {
	/**
	 * Display featured gallery from attachments list.
	 *
	 * @param array   $attachments Array of attachments.
	 * @param WP_Post $post        Post which gallery belonged to.
	 */
	function ahashop_featured_gallery_output( $attachments, $post ) {
		?>
		<div class="entry-slider">
			<div class="flexslider featured-gallery">
				<ul class="slides clearfix">
					<?php foreach ( $attachments as $attachment ) : ?>
						<li>
							<a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>">
								<?php echo wp_get_attachment_image( $attachment->ID, 'ahashop-large' ); ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div> <!-- end slider -->
		<?php
	}
}

/**
 * Remove first gallery from content because it is displayed as featured gallery.
 *
 * @param  string $content Post content.
 * @return string
 */
function ahashop_remove_featured_gallery_in_content( $content ) {
	if ( is_single() ) {
		return $content;
	}

	if ( 'gallery' !== get_post_format() ) {
		return $content;
	}

	$gallery = ahashop_get_first_gallery( $content );

	if ( ! $gallery ) {
		return $content;
	}

	$content = str_replace( $gallery, '', $content );

	return $content;
}
add_filter( 'the_content', 'ahashop_remove_featured_gallery_in_content' );

/**
 * Add extra embed types for getting from content.
 *
 * @param  array $types Allowed embed types.
 * @return array
 */
function ahashop_additional_media_embed_types( $types ) {
	$types[] = 'blockquote';

	return $types;
}
/* add_filter( 'media_embedded_in_content_allowed_types', 'ahashop_additional_media_embed_types' ); */

/**
 * Get post media element tags.
 *
 * @param  string $format Post format.
 * @return string
 */
function ahashop_get_post_format_media_tags( $format ) {
	$tags = array();

	switch ( $format ) {
		case 'quote':
			$tags = array( 'blockquote' );
			break;

		case 'video':
			$tags = array( 'video', 'object', 'embed', 'iframe' );
			break;

		case 'audio':
			$tags = array( 'audio', 'object', 'embed', 'iframe' );
			break;
	}

	return $tags;
}

/**
 * Get first media in post.
 *
 * @param  string $content     Post content.
 * @param  string $post_format Post format.
 * @param  int    $post_id     Post id.
 * @return string
 */
function ahashop_get_first_media_in_post( $content = null, $post_format = null, $post_id = null ) {
	if ( ! $content ) {
		remove_filter( 'the_content', 'ahashop_remove_featured_gallery_in_content' );

		$content = apply_filters( 'the_content', get_the_content() );

		add_filter( 'the_content', 'ahashop_remove_featured_gallery_in_content' );
	}

	if ( ! $post_format ) {
		$post_format = get_post_format();
	}

	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$types = ahashop_get_post_format_media_tags( $post_format );

	$media = get_transient( 'ahashop_post_media_' . $post_id );

	if ( false === $media ) {
		$embeds = get_media_embedded_in_content( $content, $types );

		if ( ! empty( $embeds[0] ) ) {
			$media = $embeds[0];

			set_transient( 'ahashop_post_media_' . $post_id, $media, WEEK_IN_SECONDS );
		}
	}

	return $media;
}

/**
 * Remove post media html cache.
 *
 * @param  int $post_id Post id.
 */
function ahashop_delete_post_media_transient( $post_id ) {
	delete_transient( 'ahashop_post_media_' . $post_id );
}
add_action( 'save_post', 'ahashop_delete_post_media_transient' );

/**
 * Remove first gallery from post content.
 *
 * @param  string $content Post content.
 * @return string
 */
function ahashop_remove_first_gallery_from_content( $content ) {
	if ( is_singular() ) {
		return $content;
	}

	if ( 'standard' != ahashop_option( 'blog_layout' ) ) {
		return $content;
	}

	if ( 'gallery' != get_post_format() ) {
		return $content;
	}

	$count = preg_match_all( '/' . get_shortcode_regex( array( 'gallery' ) ) . '/s', get_the_content(), $matches, PREG_SET_ORDER );

	if ( ! $count ) {
		return $content;
	}

	$content = str_replace( $matches[0][0], '', $content );

	return $content;
}
add_filter( 'the_content', 'ahashop_remove_first_gallery_from_content' );

/**
 * Parse quote data.
 *
 * @param  string $content Post content.
 * @return array
 */
function ahashop_parse_quote_data( $content ) {
	if ( ! preg_match( '/<blockquote.*?>((.|\n)*?)<\/blockquote>/', $content, $matches ) ) {
		return;
	}

	$shortcode = $matches[0];
	$cite = '';

	if ( preg_match( '/cite=["|\'](.*)["|\']/', $shortcode, $cites ) ||
		preg_match( '/<(cite|small|span).*?>(.*)<\/(cite|small|span)>/', $shortcode, $cites ) ) {
		$cite = strip_tags( $cites[2] );
	}

	$quote = strip_tags( $matches[1] );
	$quote = str_replace( $cite, '', $quote );
	$quote = trim( $quote );

	return array(
		'quote' => $quote,
		'cite'  => $cite,
		'html'  => $shortcode,
	);
}

/**
 * Remove first media from post content.
 *
 * @param  string $content Post content.
 * @return string
 */
function ahashop_remove_first_embed_from_content( $content ) {
	if ( is_singular() ) {
		return $content;
	}

	$post_id = get_the_ID();
	$format = get_post_format();

	if ( ! in_array( $format, array( 'quote', 'audio', 'video' ) ) ) {
		return $content;
	}

	/* $content = do_shortcode( $content ); */
	$media = ahashop_get_first_media_in_post( $content, $post_id );

	if ( ! empty( $media ) ) {
		$content = str_replace( $media, '', $content );
	}

	return $content;
}
add_filter( 'the_content', 'ahashop_remove_first_embed_from_content' );
