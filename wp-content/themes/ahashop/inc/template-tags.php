<?php
/**
 * Theme template tags
 *
 * @package Ahashop
 */

if ( ! function_exists( 'ahashop_logo' ) ) {
	/**
	 * Show logo.
	 */
	function ahashop_logo() {
		if ( has_custom_logo() ) :
			the_custom_logo();
		else : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<img class="logo" src="<?php echo esc_url( get_theme_file_uri( 'assets/images/default/logo_dark.png' ) ); ?>" alt="<?php esc_attr_e( 'Logo', 'ahashop' ); ?>">
			</a>
		<?php endif;
	}
}

if ( ! function_exists( 'ahashop_social_follow' ) ) {
	/**
	 * Display social follow icons.
	 */
	function ahashop_social_follow() {
		if ( ! class_exists( 'Ahashop_Social' ) ) {
			return;
		}

		$data = ahashop_option( 'social_follow' );

		if ( ! $data ) {
			return;
		}

		$socials = Ahashop_Social::get_socials();
		?>
		<div class="social-icons">
			<?php foreach ( $data as $name => $url ) :
				if ( ! $url ) {
					continue;
				}

				if ( ! isset( $socials[ $name ] ) ) {
					continue;
				}
				?>
				<a href="<?php echo esc_url( $url ); ?>"><i class="<?php echo esc_attr( $socials[ $name ]['icon'] ); ?>"></i></a>
			<?php endforeach; ?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'ahashop_pagination' ) ) {
	/**
	 * Show posts pagination.
	 */
	function ahashop_pagination() {
		?>
		<!-- Pagination -->
		<div class="text-center">
			<?php the_posts_pagination( array(
				'prev_text' => '<i class="fa fa-angle-left"></i>',
				'next_text' => '<i class="fa fa-angle-right"></i>',
			) ); ?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'ahashop_entry_title' ) ) {
	/**
	 * Display entry title.
	 */
	function ahashop_entry_title() {
		if ( is_singular() && is_main_query() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" title="' . esc_attr( get_the_title() ) . '">', '</a></h2>' );
		}
	}
}

if ( ! function_exists( 'ahashop_post_meta' ) ) {
	/**
	 * Show post meta.
	 */
	function ahashop_post_meta() {
		get_template_part( 'template-parts/post/post-meta' );
	}
}

if ( ! function_exists( 'ahashop_entry_date' ) ) {
	/**
	 * Show entry_date.
	 */
	function ahashop_entry_date() {
		?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			<?php the_time( get_option( 'date_format' ) ); ?>
		</a>
		<?php
	}
}

if ( ! function_exists( 'ahashop_post_categories' ) ) {
	/**
	 * Show post categories list.
	 */
	function ahashop_post_categories() {
		the_category( ', ' );
	}
}

if ( ! function_exists( 'ahashop_post_author' ) ) {
	/**
	 * Show post author.
	 */
	function ahashop_post_author() {
		the_author_posts_link();
	}
}

if ( ! function_exists( 'ahashop_post_comments_link' ) ) {
	/**
	 * Show post comments link.
	 */
	function ahashop_post_comments_link() {
		comments_popup_link( esc_html__( '0 comment', 'ahashop' ), esc_html__( '1 comment', 'ahashop' ), esc_html__( '% comments', 'ahashop' ), '', esc_html__( 'Comments off', 'ahashop' ) );
	}
}

if ( ! function_exists( 'ahashop_entry_content' ) ) {
	/**
	 * Display entry content.
	 */
	function ahashop_entry_content() {
		if ( is_singular() && is_main_query() || ahashop_option( 'content_options' ) === 'full' && ! is_search() || post_password_required() ) {
			the_content( '<span>' . esc_html__( 'Read more', 'ahashop' ) . '</span>' );

			wp_link_pages( array(
				'before' => '<nav class="link-pages">' . __( 'Pages:', 'ahashop' ),
				'after'  => '</nav>',
				'pagelink' => '<span>%</span>',
			) );

			return;
		}

		the_excerpt();

		echo '<p><a href="' . esc_url( get_permalink() ) . '" class="more-link"><span>' . esc_html__( 'Read More', 'ahashop' ) . '</span></a></p>';
	}
}

if ( ! function_exists( 'ahashop_entry_sharing' ) ) {
	/**
	 * Display entry sharing.
	 */
	function ahashop_entry_sharing() {
		if ( ! class_exists( 'Ahashop_Social' ) ) {
			return;
		}

		if ( ! apply_filters( 'ahashop_enable_sharing', ahashop_option( 'sharing' ) ) ) {
			return;
		}

		$socials = Ahashop_Social::get_socials();
		$sharings = (array) ahashop_option( 'social_sharing' );
		?>
		<div class="socials-share clearfix">
			<span><?php esc_html_e( 'Share:', 'ahashop' ); ?></span>

			<div class="social-icons rounded">
				<?php foreach ( $sharings as $name => $enabled ) :
					if ( ! $enabled ) {
						continue;
					}

					if ( ! isset( $socials[ $name ] ) ) {
						continue;
					}

					if ( ! is_callable( 'ahashop_get_sharing_url_' . $name ) ) {
						continue;
					}

					$url = call_user_func( 'ahashop_get_sharing_url_' . $name, get_permalink(), get_the_title(), get_the_post_thumbnail_url() );
					?>
					<a href="<?php echo esc_url( $url ); ?>" target="_blank" class="social-<?php echo esc_attr( $name ); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr( $socials[ $name ]['name'] ); ?>" data-original-title="<?php echo esc_attr( $socials[ $name ]['name'] ); ?>"><i class="<?php echo esc_attr( $socials[ $name ]['icon'] ); ?>"></i></a>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'ahashop_featured_image' ) ) {
	/**
	 * Display featured image.
	 */
	function ahashop_featured_image() {
		if ( ! has_post_thumbnail() ) {
			return;
		}
		?>
		<div class="entry-img">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail( 'ahashop-large' ); ?>
			</a>
		</div>
		<?php
	}
}

if ( ! function_exists( 'ahashop_featured_gallery' ) ) {
	/**
	 * Display featured gallery.
	 */
	function ahashop_featured_gallery() {
		if ( ! function_exists( 'ahashop_get_first_gallery' ) ) {
			ahashop_featured_image();

			return;
		}

		$gallery = ahashop_get_first_gallery( get_the_content() );

		if ( ! $gallery ) {
			return;
		}

		$GLOBALS['featured_gallery'] = true;
		echo do_shortcode( $gallery ); // WPCS: xss ok.
	}
}

if ( ! function_exists( 'ahashop_featured_video' ) ) {
	/**
	 * Display featured video.
	 */
	function ahashop_featured_video() {
		if ( ! function_exists( 'ahashop_get_first_media_in_post' ) ) {
			ahashop_featured_image();

			return;
		}

		$video = ahashop_get_first_media_in_post();

		if ( ! $video ) {
			return;
		}
		?>
		<div class="entry-video video-wrap">
			<?php print $video; // WPCS: xss ok. ?>;
		</div>
		<?php
	}
}

if ( ! function_exists( 'ahashop_featured_audio' ) ) {
	/**
	 * Display featured audio.
	 */
	function ahashop_featured_audio() {
		if ( ! function_exists( 'ahashop_get_first_media_in_post' ) ) {
			ahashop_featured_image();

			return;
		}

		$audio = ahashop_get_first_media_in_post();

		if ( ! $audio ) {
			return;
		}
		?>
		<div class="entry-video video-wrap">
			<?php print $audio; // WPCS: xss ok. ?>;
		</div>
		<?php
	}
}

if ( ! function_exists( 'ahashop_featured_quote' ) ) {
	/**
	 * Display quote as featured image.
	 */
	function ahashop_featured_quote() {
		if ( ! function_exists( 'ahashop_parse_quote_data' ) ) {
			ahashop_featured_image();

			return;
		}

		$content = get_the_content();

		$quote_data = ahashop_parse_quote_data( $content );

		if ( ! $quote_data ) {
			return;
		}
		?>
		<blockquote class="blockquote-style-1">
			<?php ahashop_post_meta(); ?>

			<p>
				<a href="<?php the_permalink(); ?>"><?php echo esc_html( $quote_data['quote'] ); ?></a>
			</p>
			<span><?php echo esc_html( $quote_data['cite'] ); ?></span>
		</blockquote>
		<?php
	}
}
