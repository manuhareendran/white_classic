<?php
/**
 * WooCommerce customizations
 *
 * @package Ahashop
 */

/**
 * Remove WooCommerce hooks.
 */
require_once get_template_directory() . '/inc/woocommerce/remove-hooks.php';

/**
 * Add WooCommerce hooks.
 */
require_once get_template_directory() . '/inc/woocommerce/add-hooks.php';

/**
 * Override WooCommerce template tags.
 */
require_once get_template_directory() . '/inc/woocommerce/template-tags.php';

if ( ! class_exists( 'WC_Product_Cat_List_Walker' ) ) {
	include_once( WC()->plugin_path() . '/includes/walkers/class-product-cat-list-walker.php' );
}

/**
 * Class Ahashop_WC_Product_Cat_List_Walker
 */
class Ahashop_WC_Product_Cat_List_Walker extends WC_Product_Cat_List_Walker {

	/**
	 * Start the element output.
	 *
	 * @see Walker::start_el()
	 * @since 2.1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of category in reference to parents.
	 * @param integer $current_object_id
	 */
	public function start_el( &$output, $cat, $depth = 0, $args = array(), $current_object_id = 0 ) {
		$output .= '<li class="cat-item cat-item-' . $cat->term_id;

		if ( $args['current_category'] == $cat->term_id ) {
			$output .= ' current-cat';
		}

		if ( $args['has_children'] && $args['hierarchical'] ) {
			$output .= ' cat-parent';
		}

		if ( $args['current_category_ancestors'] && $args['current_category'] && in_array( $cat->term_id, $args['current_category_ancestors'] ) ) {
			$output .= ' current-cat-parent';
		}

		$output .=  '"><a href="' . get_term_link( (int) $cat->term_id, $this->tree_type ) . '">' . $cat->name;

		if ( $args['show_count'] ) {
			$output .= ' <span class="count">(' . $cat->count . ')</span>';
		}

		$output .= '</a>';
	}
}

/**
 * Filter wc product categories widget args.
 *
 * @param  array $args Product categories widget args.
 * @return array
 */
function ahashop_wc_product_categories_widget_args( $args ) {
	$args['walker'] = new Ahashop_WC_Product_Cat_List_Walker();

	return $args;
}
add_filter( 'woocommerce_product_categories_widget_args', 'ahashop_wc_product_categories_widget_args' );

/**
 * Dequeue WooCommerce styles.
 *
 * @param  array $enqueue_styles Array of WooCommerce styles.
 * @return array
 */
function ahashop_wc_dequeue_styles( $enqueue_styles ) {
	// unset( $enqueue_styles['woocommerce-general'] );
	// unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout.
	// unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation.
	// return $enqueue_styles;
}
// add_filter( 'woocommerce_enqueue_styles', 'ahashop_wc_dequeue_styles' );

/**
 * Enqueue theme WooCommerce style.
 */
// function ahashop_wc_enqueue_styles() {
// 	wp_enqueue_style( 'ahashop-woocommerce', get_theme_file_uri( '/assets/css/woocommerce.css' ) );
// }
// add_action( 'wp_enqueue_scripts', 'ahashop_wc_enqueue_styles' );

/**
 * Filter WooCommerce breadcrumb default args.
 *
 * @param  array $args Breadcrumb args.
 * @return array
 */
function ahashop_wc_breadcrumb_defaults( $args ) {
	$args['delimiter'] = '';
	$args['wrap_before'] = '<ul class="woocommerce-breadcrumb breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>';
	$args['before'] = '<li>';
	$args['after'] = '</li>';

	return $args;
}
add_filter( 'woocommerce_breadcrumb_defaults', 'ahashop_wc_breadcrumb_defaults' );

/**
 * Register customizer settings for WooCommerce.
 *
 * @param  object $wp_customize WP_Customize object.
 */
function ahashop_wc_register_customizer_settings( $wp_customize ) {
	$wp_customize->add_section( 'shop', array(
		'title'       => esc_html__( 'Sidebar Shop', 'ahashop' ),
		'priority'    => 80,
	) );

	// Sidebar layout for shop pages.
	$wp_customize->add_setting( 'sidebar_shop_layout', array(
		'default'              => ahashop_default( 'sidebar_shop_layout' ),
		'transport'            => 'refresh',
		'sanitize_callback'    => 'ahashop_sanitize_sidebar_layout',
	) );
	$wp_customize->add_control( 'sidebar_shop_layout', array(
		'label'       => esc_html__( 'Sidebar layout for shop page', 'ahashop' ),
		'section'     => 'shop',
		'type'        => 'select',
		'choices'     => array(
			'sidebar-right' => esc_html__( 'Sidebar right', 'ahashop' ),
			'sidebar-left'  => esc_html__( 'Sidebar left', 'ahashop' ),
			'no-sidebar'    => esc_html__( 'No sidebar', 'ahashop' ),
		),
	) );

	// Number of columns for shop pages.
//	 $wp_customize->add_setting( 'shop_columns', array(
//	 	'default'              => ahashop_default( 'shop_columns' ),
//	 	'transport'            => 'refresh',
//	 	'sanitize_callback'    => 'absint',
//	 ) );
	// $wp_customize->add_control( 'shop_columns', array(
	// 	'label'       => esc_html__( 'Number of columns in shop page', 'ahashop' ),
	// 	'section'     => 'shop',
	// 	'type'        => 'select',
	// 	'choices'     => array(
	// 		2 => 2,
	// 		3 => 3,
	// 		4 => 4,
	// 	),
	// ) );

	$wp_customize->add_setting( 'sidebar_product_layout', array(
		'default'              => ahashop_default( 'sidebar_product_layout' ),
		'transport'            => 'refresh',
		'sanitize_callback'    => 'ahashop_sanitize_sidebar_layout',
	) );
	$wp_customize->add_control( 'sidebar_product_layout', array(
		'label'       => esc_html__( 'Sidebar layout for product detail', 'ahashop' ),
		'section'     => 'shop',
		'type'        => 'select',
		'choices'     => array(
			'sidebar-right' => esc_html__( 'Sidebar right', 'ahashop' ),
			'sidebar-left'  => esc_html__( 'Sidebar left', 'ahashop' ),
			'no-sidebar'    => esc_html__( 'No sidebar', 'ahashop' ),
		),
	) );

	$wp_customize->add_setting( 'sidebar_product_taxonomy_layout', array(
		'default'              => ahashop_default( 'sidebar_product_taxonomy_layout' ),
		'transport'            => 'refresh',
		'sanitize_callback'    => 'ahashop_sanitize_sidebar_layout',
	) );
	$wp_customize->add_control( 'sidebar_product_taxonomy_layout', array(
		'label'       => esc_html__( 'Sidebar layout for product taxonomy', 'ahashop' ),
		'section'     => 'shop',
		'type'        => 'select',
		'choices'     => array(
			'sidebar-right' => esc_html__( 'Sidebar right', 'ahashop' ),
			'sidebar-left'  => esc_html__( 'Sidebar left', 'ahashop' ),
			'no-sidebar'    => esc_html__( 'No sidebar', 'ahashop' ),
		),
	) );
}
add_action( 'customize_register', 'ahashop_wc_register_customizer_settings' );

/**
 * Filter sidebar layout setting value for WooCommerce pages.
 *
 * @param  string $layout Sidebar layout value.
 * @return string
 */
function ahashop_wc_sidebar_layout( $layout ) {
	if ( is_shop() ) {
		$layout = ahashop_option( 'sidebar_shop_layout' );

		return $layout;
	}

	if ( is_product() ) {
		$layout = ahashop_option( 'sidebar_product_layout' );

		return $layout;
	}

	if ( is_product_taxonomy() ) {
		$layout = ahashop_option( 'sidebar_product_taxonomy_layout' );

		return $layout;
	}

	return $layout;
}
add_filter( 'ahashop_sidebar_layout', 'ahashop_wc_sidebar_layout' );

/**
 * Filter product review form arguments.
 *
 * @param  array $args Comment form args.
 * @return array
 */
function ahashop_wc_product_review_comment_form_args( $args ) {
	$args['class_submit'] = 'btn btn-md btn-color';
	$args['submit_button'] = '<button name="%1$s" type="submit" id="%2$s" class="%3$s"><span>%4$s</span></button>';

	return $args;
}
add_filter( 'woocommerce_product_review_comment_form_args', 'ahashop_wc_product_review_comment_form_args' );

if ( ! function_exists( 'ahashop_get_product_carousel_image_ids' ) ) {
	/**
	 * Get product carousel image ids.
	 *
	 * @return array
	 * @global object $product
	 */
	function ahashop_get_product_carousel_image_ids() {
		global $product;

		$attachment_ids = ahashop_wc_get_gallery_image_ids();

		if ( 'WC_Product_Variable' === get_class( $product ) ) {
			// Add variation images.
			$variations = $product->get_available_variations();

			foreach ( $variations as $variation ) {
				if ( ! empty( $variation['image_id'] ) ) {
					array_unshift( $attachment_ids, $variation['image_id'] );
				}
			}
		}

		if ( has_post_thumbnail() ) {
			array_unshift( $attachment_ids, get_post_thumbnail_id() );
		}

		$attachment_ids = array_unique( $attachment_ids );

		return apply_filters( 'ahashop_get_product_carousel_image_ids', $attachment_ids );
	}
}

/**
 * Filter single product gallery image html.
 *
 * @param  string $html          Image html.
 * @param  int    $attachment_id Attachment id.
 * @param  int    $product_id    Product id.
 * @param  string $image_class   Image classes.
 * @return string
 */
function ahashop_wc_single_product_image_thumbnail_html( $html, $attachment_id, $product_id, $image_class ) {
	$props = wc_get_product_attachment_props( $attachment_id );

	$html = sprintf(
		'<div class="gallery-cell">%s</div>',
		wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), 0, $props )
	);

	return $html;
}
add_filter( 'woocommerce_single_product_image_thumbnail_html', 'ahashop_wc_single_product_image_thumbnail_html', 10, 4 );

/**
 * Print clearfix element in the bottom of add to cart form.
 */
function ahashop_clearfix_after_add_to_cart() {
	echo '<div class="clear"></div>';
}
add_action( 'woocommerce_after_add_to_cart', 'ahashop_clearfix_after_add_to_cart', 99 );

/**
 * Hide product category title.
 *
 * @param  boolean $show Show category title.
 * @return boolean
 */
function ahashop_hide_category_title( $show ) {
	if ( is_product_category() ) {
		return false;
	}

	return $show;
}
add_filter( 'woocommerce_show_page_title', 'ahashop_hide_category_title' );


/* Override widget woocommerce cart */

function ahashop_override_woocommerce_widgets() {
    if ( class_exists( 'WC_Widget_Cart' ) ) {
        unregister_widget( 'WC_Widget_Cart' );
        include_once('widget/ahashop-widget-cart.php' );
        register_widget( 'ahashop_WC_Widget_Cart' );
    }
}
add_action( 'widgets_init', 'ahashop_override_woocommerce_widgets', 15 );