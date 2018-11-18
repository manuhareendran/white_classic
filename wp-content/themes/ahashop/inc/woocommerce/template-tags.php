<?php
/**
 * WooCommerce template tags
 *
 * @package Ahashop
 */

/**
 * Show the product title in the product loop. By default this is an H3.
 */
function woocommerce_template_loop_product_title() {
	?>
	<h3><a class="product-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	<?php
}

if ( ! function_exists( 'ahashop_wc_template_loop_product_actions' ) ) {
	/**
	 * Show product actions.
	 */
	function ahashop_wc_template_loop_product_actions() {
		global $yith_woocompare;
		?>
		<div class="product-actions">
			<?php if ( class_exists( 'YITH_Woocompare' ) ) : ?>
				<a href="<?php echo esc_url( add_query_arg( array( 'iframe' => 'true' ), $yith_woocompare->obj->view_table_url() ) ); ?>" class="product-add-to-compare compare" data-toggle="tooltip" data-placement="bottom" data-product_id="<?php the_ID(); ?>"><i class="fa fa-exchange"></i></a>
			<?php endif; ?>

			<?php if ( class_exists( 'YITH_WCWL' ) ) : ?>
				<?php echo do_shortcode( '[yith_wcwl_add_to_wishlist icon="fa fa-heart"]' ); ?>
			<?php endif; ?>
		</div>

		<a href="<?php the_permalink(); ?>" class="product-quickview"><?php esc_html_e( 'Quick View', 'ahashop' ); ?></a>
		<?php
	}
}

if ( ! function_exists( 'ahashop_wc_template_loop_product_stock' ) ) {
	/**
	 * Print out of stock.
	 */
	function ahashop_wc_template_loop_product_stock() {
		global $product;

		if ( ! $product->managing_stock() && ! $product->is_in_stock() ) {
			?>
			<span class="sold-out valign"><?php esc_html_e( 'out of stock', 'ahashop' ); ?></span>
			<?php
		}
	}
}

if ( ! function_exists( 'ahashop_wc_get_gallery_image_ids' ) ) {
	/**
	 * Get gallery image ids.
	 *
	 * @return array
	 */
	function ahashop_wc_get_gallery_image_ids() {
		global $product;

		if ( method_exists( $product, 'get_gallery_image_ids' ) ) {
			return $product->get_gallery_image_ids();
		}

		return $product->get_gallery_attachment_ids();
	}
}

/**
 * Display the second thumbnail.
 */
function ahashop_wc_template_loop_second_product_thumbnail() {
	$attachment_ids = ahashop_wc_get_gallery_image_ids();

	if ( ! $attachment_ids ) {
		return;
	}

	$image_size = apply_filters( 'single_product_archive_thumbnail_size', 'ahashop-product' );

	$secondary_image_id = apply_filters( 'ahashop_wc_product_reveal_last_img', false ) ? end( $attachment_ids ) : reset( $attachment_ids );
	$classes = 'back-img';
	// echo wp_get_attachment_image( $secondary_image_id, $image_size, '', array( 'class' => $classes ) );
}

/**
 * Print archive product pagination wrap open tag.
 */
function ahashop_wc_archive_product_pagination_wrap_open() {
	echo '<div class="pagination-wrap clearfix">';
}

/**
 * Print archive product pagination wrap close tag.
 */
function ahashop_wc_archive_product_pagination_wrap_close() {
	echo '</div>';
}

/**
 * Output the product image before the single product summary.
 *
 * @subpackage	Product
 */
function woocommerce_show_product_images() {
	/* wc_get_template( 'single-product/product-image.php' ); */
	wc_get_template( 'single-product/product-image-carousel.php' );
}

if ( ! function_exists( 'ahashop_wc_product_category_banner' ) ) {
	/**
	 * Display product category banner.
	 */
	function ahashop_wc_product_category_banner() {
		if ( ! is_product_category() ) {
			return;
		}

		$cat = get_queried_object();
		$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
		$image = wp_get_attachment_url( $thumbnail_id );
		?>
		<!-- Banner -->
		<div class="banner-wrap relative">
			<?php
			if ( $image ) {
				echo '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( $cat->name ) . '" />';
			}
			?>
			<div class="hero-holder text-center right-align">
				<div class="hero-lines mb-0">
					<h1 class="hero-heading"><?php echo esc_html( $cat->name ); ?></h1>
					<h4 class="hero-subheading"><?php echo esc_html( $cat->description ); ?></h4>
				</div>
			</div>
			<div class="show-mobile" style="background-image: url(<?php echo esc_url( esc_url( $image ) ); ?>);"></div>
		</div>
		<?php
	}
}
