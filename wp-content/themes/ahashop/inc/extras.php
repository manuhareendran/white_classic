<?php
/**
 * Extra functions
 *
 * @package Ahashop
 */

/**
 * Get content classes.
 *
 * @return string
 */
function ahashop_get_content_classes() {
	$classes = array();

	if ( is_page_template( 'templates/page-builder.php' ) ) {
		$classes = array( 'section-wrap', 'nopadding' );
	} elseif ( is_single() || is_page() ) {
		$classes = array( 'section-wrap', 'post-single', 'pb-50' );
	} elseif ( is_home() || is_archive() || is_category() || is_tag() || is_search() ) {
		$classes = array( 'section-wrap', 'blog-standard', 'pb-50' );
	}

	return implode( ' ', apply_filters( 'ahashop_content_classes', $classes ) );
}

/**
 * Show preloader.
 */
function ahashop_preloader() {
	if ( ! ahashop_option( 'show_preloader' ) ) {
		return;
	}
	?>
	<!-- Preloader -->
	<div class="loader-mask">
		<div class="loader">
			<div></div>
			<div></div>
		</div>
	</div>
	<?php
}
add_action( 'ahashop_site_wrapper_begin', 'ahashop_preloader' );

/**
 * Add custom class to <body> tag.
 *
 * @param  array $classes Body classes.
 * @return array
 */
function ahashop_body_class( $classes ) {
	// $classes[] = 'relative';

	return $classes;
}
add_filter( 'body_class', 'ahashop_body_class' );

if ( ! function_exists( 'ahashop_breadcrumb' ) ) {
	/**
	 * Show breadcrumb.
	 */
	function ahashop_breadcrumb() {
		if ( is_front_page() ) {
			return;
		}

		if ( function_exists( 'woocommerce_breadcrumb' ) && is_woocommerce() ) {
			?>
			<div class="container">
				<?php woocommerce_breadcrumb(); ?>
			</div>
			<?php
		} elseif ( function_exists( 'breadcrumb_trail' ) ) {
			?>
			<div class="container">
				<?php breadcrumb_trail( array(
					'show_browse' => false,
				) ); ?>
			</div>
			<?php
		}
	}
}
add_action( 'ahashop_after_header', 'ahashop_breadcrumb' );

/**
 * Filter breadcrumb trail output.
 *
 * @param  string $html Breadcrumb html.
 * @return string
 */
function ahashop_breadcrumb_trail( $html ) {
	$html = str_replace( array( 'trail-items', 'trail-end' ), array( 'trail-items breadcrumb', 'trail-end active' ), $html );

	return $html;
}
add_filter( 'breadcrumb_trail', 'ahashop_breadcrumb_trail' );

/**
 * Show back to top button.
 */
function ahashop_back_to_top() {
	?>
	<div id="back-to-top">
		<a href="#top"><i class="fa fa-angle-up"></i></a>
	</div>
	<?php
}
add_action( 'ahashop_site_wrapper_end', 'ahashop_back_to_top' );

/**
 * Show content in the bottom of post detail.
 */
function ahashop_after_single() {
	if ( is_single() ) {
		get_template_part( 'template-parts/post/post-footer' );

		if ( ahashop_option( 'author_bio' ) && get_the_author_meta( 'description' ) ) {
			get_template_part( 'template-parts/post/author-box' );
		}

		if ( ahashop_option( 'related_posts' ) ) {
			ahashop_related_posts();
		}
	}

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
}
add_action( 'ahashop_after_single', 'ahashop_after_single' );

/**
 * Get related posts query.
 *
 * @return WP_Query
 */
function ahashop_get_related_posts_query() {
	$cats = get_the_category();
	$cat_ids = wp_list_pluck( $cats, 'term_id' );

	$args = array(
		'post__not_in' => array( get_the_ID() ),
		'ignore_sticky_posts' => true,
		'posts_per_page' => 3,
		'category__in' => $cat_ids,
	);

	return new WP_Query( apply_filters( 'ahashop_related_posts_query', $args ) );
}

if ( ! function_exists( 'ahashop_related_posts' ) ) {
	/**
	 * Show related posts.
	 */
	function ahashop_related_posts() {
		$query = ahashop_get_related_posts_query();

		if ( ! $query->have_posts() ) {
			return;
		}
		?>
		<!-- related posts -->
		<div class="related-posts mt-60">
			<h4 class="heading uppercase mb-30"><?php esc_html_e( 'Related posts', 'ahashop' ); ?></h4>

			<div class="row">
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<div class="col-sm-4">
						<?php get_template_part( 'template-parts/loop/content', 'related' ) ?>
					</div>
				<?php endwhile;
				wp_reset_postdata(); ?>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'ahashop_comments_callback' ) ) {
	/**
	 * Display list comment item.
	 *
	 * @param  object $comment Comment object.
	 * @param  array  $args    Comment list args.
	 * @param  int    $depth   Depth.
	 */
	function ahashop_comments_callback( $comment, $args, $depth ) {
		?>
		<li <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
			<div class="comment-body">
				<?php if ( 0 != $args['avatar_size'] ) : ?>
					<div class="comment-avatar"><?php echo get_avatar( $comment, $args['avatar_size'] ); ?></div>
				<?php endif; ?>

				<!--<img src="img/blog/comment_1.jpg" class="comment-avatar" alt="">-->
				<div class="comment-content">
					<span class="comment-author"><?php comment_author_link() ?></span>

					<span>
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
							<?php
							/* translators: 1: date, 2: time */
							printf( esc_html__( '%1$s at %2$s', 'ahashop' ), get_comment_date(),  get_comment_time() ); ?>
						</a>

						<?php edit_comment_link( esc_html__( '(Edit)', 'ahashop' ), '  ', '' ); ?>
					</span>

					<?php if ( '0' == $comment->comment_approved ) : ?>
						<p><em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'ahashop' ); ?></em></p>
					<?php endif; ?>

					<?php comment_text(); ?>

					<?php
					comment_reply_link( array_merge( $args, array(
						'add_below'  => 'comment',
						'depth'      => $depth,
						'max_depth'  => $args['max_depth'],
						'reply_text' => '<i class="icon fa fa-reply"></i> ' . esc_html__( 'reply', 'ahashop' ),
					) ) );
					?>
				</div>
			</div>
		<?php
	}
} // End if().

if ( ! function_exists( 'ahashop_comment_field_author' ) ) {
	/**
	 * Get comment author field HTML.
	 *
	 * @param  array   $commenter Commenter data.
	 * @param  boolean $req       Requird name and email.
	 * @return string
	 */
	function ahashop_comment_field_author( $commenter, $req ) {
		$aria_req = ( $req ? " aria-required='true'" : '' );

		$label = esc_html__( 'Name', 'ahashop' ) . ( $req ? '<span class="required">*</span>' : '' );
		$placeholder = $req ? esc_html__( 'Name *', 'ahashop' ) : esc_html__( 'Name', 'ahashop' );

		$field = '<div class="comment-form-author">';
			$field .= '<label for="author" class="sr-only">' . $label . '</label>';
			$field .= sprintf(
				'<input id="author" name="author" type="text" value="%1$s" placeholder="%2$s"%3$s>',
				esc_attr( $commenter['comment_author'] ),
				esc_attr( $placeholder ),
				$aria_req
			);
		$field .= '</div>';

		return apply_filters( 'ahashop_comment_field_author', $field, $commenter, $req );
	}
}

if ( ! function_exists( 'ahashop_comment_field_email' ) ) {
	/**
	 * Get comment email field HTML.
	 *
	 * @param  array   $commenter Commenter data.
	 * @param  boolean $req       Requird name and email.
	 * @return string
	 */
	function ahashop_comment_field_email( $commenter, $req ) {
		$aria_req = ( $req ? " aria-required='true'" : '' );

		$label = esc_html__( 'Email', 'ahashop' ) . ( $req ? '<span class="required">*</span>' : '' );
		$placeholder = $req ? esc_html__( 'Email *', 'ahashop' ) : esc_html__( 'Email', 'ahashop' );

		$field = '<div class="comment-form-email">';
			$field .= '<label for="email" class="sr-only">' . $label . '</label>';
			$field .= sprintf(
				'<input id="email" name="email" type="email" value="%1$s" placeholder="%2$s"%3$s>',
				esc_attr( $commenter['comment_author_email'] ),
				esc_attr( $placeholder ),
				$aria_req
			);
		$field .= '</div>';

		return apply_filters( 'ahashop_comment_field_email', $field, $commenter, $req );
	}
}

if ( ! function_exists( 'ahashop_comment_field_url' ) ) {
	/**
	 * Get comment url field HTML.
	 *
	 * @param  array $commenter Commenter data.
	 * @return string
	 */
	function ahashop_comment_field_url( $commenter ) {
		$label = esc_html__( 'Website', 'ahashop' );
		$placeholder = esc_html__( 'Website', 'ahashop' );

		$field = '<div class="comment-form-url">';
			$field .= '<label for="url" class="sr-only">' . $label . '</label>';
			$field .= sprintf(
				'<input id="url" name="url" type="url" value="%1$s" placeholder="%2$s">',
				esc_attr( $commenter['comment_author_url'] ),
				esc_attr( $placeholder )
			);
		$field .= '</div>';

		return apply_filters( 'ahashop_comment_field_url', $field, $commenter );
	}
}

if ( ! function_exists( 'ahashop_comment_field_comment' ) ) {
	/**
	 * Get comment field HTML.
	 *
	 * @return string
	 */
	function ahashop_comment_field_comment() {
		$label = esc_html__( 'Comment', 'ahashop' );
		$placeholder = esc_html__( 'Comment *', 'ahashop' );

		$field = '<div class="comment-form-comment">';
			$field .= '<label for="comment" class="sr-only">' . $label . '</label>';
			$field .= sprintf(
				'<textarea id="comment" name="comment" aria-required="true" placeholder="%s" rows="8"></textarea>',
				esc_attr( $placeholder )
			);
		$field .= '</div>';

		return apply_filters( 'ahashop_comment_field_comment', $field );
	}
}

if ( ! function_exists( 'ahashop_comment_form' ) ) {
	/**
	 * Display comment form.
	 */
	function ahashop_comment_form() {
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );

		$fields = apply_filters( 'ahashop_comment_form_fields', array(
			'author' => '<div class="col-md-4">' . ahashop_comment_field_author( $commenter, $req ) . '</div>',
			'email'  => '<div class="col-md-4">' . ahashop_comment_field_email( $commenter, $req ) . '</div>',
			'url'    => '<div class="col-md-4">' . ahashop_comment_field_url( $commenter ) . '</div>',
		) );

		$args = apply_filters( 'ahashop_comment_form_args', array(
			'fields'        => $fields,
			'comment_field' => '<div class="col-md-12">' . ahashop_comment_field_comment() . '</div>',
			'class_submit'  => 'submit btn btn-lg btn-color',
			'submit_button' => '<button name="%1$s" type="submit" id="%2$s" class="%3$s"><span>%4$s</span></button>',
		) );

		comment_form( $args );
	}
}

/**
 * Print open tag of comment row.
 */
function ahashop_comment_form_top() {
	echo '<div class="row comment-form-row">';
}
add_action( 'comment_form_top', 'ahashop_comment_form_top' );

/**
 * Print close tag of comment row.
 */
function ahashop_comment_form_bottom() {
	echo '</div><!-- End .comment-form-row -->';
}
add_action( 'comment_form', 'ahashop_comment_form_bottom' );

/**
 * Add class to menu `<li>` tag.
 *
 * @param array    $classes The CSS classes that are applied to the menu item's `<li>` element.
 * @param WP_Post  $item    The current menu item.
 * @param stdClass $args    An object of wp_nav_menu() arguments.
 *
 * @return array
 */
function ahashop_nav_menu_css_class( $classes, $item, $args ) {
    if ( intval( $item->enable_mega_menu ) && $item->mega_menu_post ) {
        $classes[] = 'dropdown';
    }
	if ( 'primary' === $args->theme_location && ! empty( $args->walker->has_children ) ) {
		$classes[] = 'dropdown';
	}

	return $classes;
}
add_filter( 'nav_menu_css_class', 'ahashop_nav_menu_css_class', 10, 3 );

/**
 * Filters a menu item's starting output.
 *
 * @param string   $output The menu item's starting HTML output.
 * @param WP_Post  $item   Menu item data object.
 * @param int      $depth  Depth of menu item. Used for padding.
 * @param stdClass $args   An object of wp_nav_menu() arguments.
 *
 * @return string
 */
function ahashop_walker_primary_menu_start_el( $output, $item, $depth, $args ) {
    if ( intval( $item->enable_mega_menu ) && $item->mega_menu_post ) {
        $output .= '<i class="fa fa-angle-down dropdown-toggle" data-toggle="dropdown"></i>';
    }
	if ( 'primary' === $args->theme_location && ! empty( $args->walker->has_children ) ) {
		$output .= '<i class="fa fa-angle-down dropdown-toggle" data-toggle="dropdown"></i>';
	}

	return $output;
}
add_filter( 'walker_nav_menu_start_el', 'ahashop_walker_primary_menu_start_el', 10, 4 );

if ( ! function_exists( 'ahashop_primary_menu_items_wrap' ) ) {
	/**
	 * Get primary menu items_wrap parameter.
	 *
	 * @return string
	 */
	function ahashop_primary_menu_items_wrap() {
        if ( class_exists( 'WooCommerce' ) ) {
            $search = '<li id="mobile-search" class="hidden-lg hidden-md">' . get_product_search_form( false ) . '</li>';
        }else{
            $search = '<li id="mobile-search" class="hidden-lg hidden-md">' . get_search_form( false ) . '</li>';
        }

		return '<ul id="%1$s" class="%2$s">' . $search . '%3$s</ul>';
	}
}

/**
 * Wrap `<span class="count"></span>` to posts count in archive posts list.
 *
 * @param  string $link_html Link html.
 * @param  string $url       Url.
 * @param  string $text      Text.
 * @param  string $format    Format.
 * @param  string $before    Content before.
 * @param  string $after     Content after.
 * @return string
 */
function ahashop_archive_link_wrap_count( $link_html, $url, $text, $format, $before, $after ) {
	if ( 'html' == $format && ! empty( $after ) ) {
		$link_html = str_replace( '</a>&nbsp;(', '&nbsp;<span class="count">(', $link_html );
		$link_html = str_replace( ')', ')</span></a>', $link_html );
	}

	return $link_html;
}
add_filter( 'get_archives_link', 'ahashop_archive_link_wrap_count', 10, 6 );

/**
 * Wrap `<span class="count"></span>` to posts count in category posts list.
 *
 * @param  string $link_html Link html.
 * @return string
 */
function ahashop_categories_link_wrap_count( $link_html ) {
	$link_html = str_replace( '</a> (', ' <span class="count">(', $link_html );
	$link_html = str_replace( ')', ')</span></a>', $link_html );

	return $link_html;
}
add_filter( 'wp_list_categories', 'ahashop_categories_link_wrap_count' );

if ( ! function_exists( 'ahashop_footer_columns' ) ) {
	/**
	 * Show footer columns.
	 */
	function ahashop_footer_columns() {
		if ( ! ahashop_option( 'footer_columns' ) ) {
			return;
		}

		/* TODO: Style widgets */
		get_template_part( 'template-parts/footer/footer-columns', ahashop_option( 'footer_columns_number' ) );
	}
}
add_action( 'ahashop_footer_top', 'ahashop_footer_columns' );

if ( ! function_exists( 'ahashop_copyright' ) ) {
	/**
	 * Show footer text right.
	 */
	function ahashop_copyright() {
		if ( ! ahashop_option( 'copyright' ) ) {
			return;
		}

		echo wp_kses_post( nl2br( ahashop_option( 'copyright' ) ) );
	}
}

if ( ! function_exists( 'ahashop_footer_text_right' ) ) {
	/**
	 * Show footer text right.
	 */
	function ahashop_footer_text_right() {
		if ( ! ahashop_option( 'footer_text_right' ) ) {
			return;
		}

		echo wp_kses_post( ahashop_option( 'footer_text_right' ) );
	}
}
add_action( 'ahashop_footer_text_right', 'ahashop_footer_text_right' );

if ( ! function_exists( 'ahashop_top_bar' ) ) {
	/**
	 * Show top bar.
	 */
	function ahashop_top_bar() {
		if ( ! ahashop_option( 'show_top_bar' ) ) {
			return;
		}

		get_template_part( 'template-parts/header/topbar' );
	}
}

if ( ! function_exists( 'ahashop_mobile_cart_icon' ) ) {
	/**
	 * Show top bar.
	 */
	function ahashop_mobile_cart_icon() {
		if ( ! class_exists( 'WooCommerce' ) ) {
			return;
		}

		get_template_part( 'template-parts/header/mobile-cart-icon' );
	}
}
add_action( 'ahashop_navbar_button', 'ahashop_mobile_cart_icon' );

if ( ! function_exists( 'ahashop_header_search' ) ) {
	/**
	 * Show header search form.
	 */
	function ahashop_header_search() {
		?>
		<div class="nav-search hidden-sm hidden-xs">
			<?php
			if ( ahashop_option( 'show_search_form' ) ) {
//				get_search_form();
                if ( class_exists( 'WooCommerce' ) ) {
                    get_product_search_form( true );
                }else{
                    get_search_form();
                }
			}
			?>
		</div>
		<?php
	}
}
add_action( 'ahashop_before_navbar_logo', 'ahashop_header_search' );

if ( ! function_exists( 'ahashop_header_mini_cart' ) ) {
	/**
	 * Show header mini cart.
	 */
	function ahashop_header_mini_cart() {
		?>
		<!-- Cart -->
		<div class="nav-cart-wrap hidden-sm hidden-xs">
			<?php if ( class_exists( 'WooCommerce' ) ) : ?>
				<?php get_template_part( 'template-parts/header/mini-cart' ); ?>
			<?php endif; ?>
		</div> <!-- end cart -->
		<?php
	}
}
add_action( 'ahashop_after_navbar_logo', 'ahashop_header_mini_cart' );
