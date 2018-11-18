<?php
/**
 * Custom color feature
 *
 * @package Ahashop
 */

/**
 * Register blog settings.
 *
 * @param  WP_Customize $wp_customize WP_Customize object.
 */
function ahashop_customize_custom_color( $wp_customize ) {
	$wp_customize->add_section( 'custom_color', array(
		'title'       => esc_html__( 'Change Color', 'ahashop' ),
		'priority'    => 120,
	) );

	// Customize background color
	$wp_customize->add_setting( 'background_color', array(
		'sanitize_callback' => 'esc_attr',
		'transport'         => 'refresh',
	) );

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'background_color',
			array(
				'label'      => __( 'Background Color', 'mytheme' ),
				'description' => esc_html__( 'Change what that have background color', 'mytheme' ),
				'section'    => 'custom_color',
				'settings'   => 'background_color',
			)
		)
	);

	// Customize color
	$wp_customize->add_setting( 'color', array(
		'sanitize_callback' => 'esc_attr',
		'transport'         => 'refresh',
	) );

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'color',
			array(
				'label'      => __( 'Color', 'mytheme' ),
				'description' => esc_html__( 'Change everything colour', 'mytheme' ),
				'section'    => 'custom_color',
				'settings'   => 'color',
			)
		)
	);

	// Customize border color
	$wp_customize->add_setting( 'border_color', array(
		'sanitize_callback' => 'esc_attr',
		'transport'         => 'refresh',
	) );

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'border_color',
			array(
				'label'      => __( 'Border Color', 'mytheme' ),
				'description' => esc_html__( 'Change border colour', 'mytheme' ),
				'section'    => 'custom_color',
				'settings'   => 'border_color',
			)
		)
	);
}
add_action( 'customize_register', 'ahashop_customize_custom_color' );

/**
 * Prints custom color css.
 *
 * @param string $css Inline css.
 */
function ahashop_custom_color_css( $css ) {

    /* cutomize background css */
    $bgcolor = ahashop_option( 'background_color' );
    if( !empty($bgcolor) ):
        $bgcolor = '#' . ltrim( $bgcolor, '#' );
        $css .= <<<CSS

/* cutomize background css */
.loader div,
.onsale, .product-img .product-quickview:hover,
.dropcap.style-2,
.highlight,
.nav-cart-remove:hover,
#back-to-top:hover,
#submit-message.btn, p #submit-message.more-link,
input[type='submit'],
.pagination a:hover,
.entry-content p:last-child a:hover,
.link-pages > a:hover,
.tags a:hover, .tags a:focus,
.tagcloud a:hover,
.tagcloud a:focus,
.progress-bar,
.accordion .panel-heading > a > span,
.nav.nav-tabs > li.active:before,
.btn.btn-transparent:hover, p .btn-transparent.more-link:hover,
input[type='submit'].btn-transparent:hover,
.btn.btn-white:hover, p .btn-white.more-link:hover,
input[type='submit'].btn-white:hover,
.btn.btn-stroke:hover, p .btn-stroke.more-link:hover,
input[type='submit'].btn-stroke:hover,
.btn.btn-color, p .btn-color.more-link,
input[type='submit'].btn-color,
.btn.btn-light:hover, p .more-link:hover,
input[type='submit'].btn-light:hover,
p input[type='submit'].more-link:hover,
.product-img .product-quickview:hover ,
.product-img .product-actions a:hover,
.newsletter-submit.btn:hover, p .newsletter-submit.more-link:hover,
.icon-add-to-wishlist a:hover ,
.ui-slider .ui-slider-range,
.form-row.place-order input,
.woocommerce form.cart .single_add_to_cart_button.alt,
.woocommerce .single_add_to_cart_button.alt,
.woocommerce .return-to-shop .button,
.woocommerce a.button,
.woocommerce button.button,
.woocommerce input.button,
.woocommerce #respond input#submit,
.product-description-wrap .yith-wcwl-add-to-wishlist .yith-wcwl-add-button a:hover, .product-description-wrap .yith-wcwl-add-to-wishlist .yith-wcwl-add-button a:focus,
.product-img .yith-wcwl-add-to-wishlist .yith-wcwl-add-button a:hover,
.product-img .yith-wcwl-add-to-wishlist .yith-wcwl-add-button a:focus,
.product-description-wrap .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a,
.product-description-wrap .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a,
.product-img .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a,
.product-img .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a,
.product-description-wrap .compare,
.product-img .compare.added:after,
.woocommerce-message .button,
.bg-color {
	background-color: $bgcolor !important;
}

CSS;
    endif;

    /* cutomize color css */
    $color = ahashop_option( 'color' );
    if( !empty($color) ):
        $color = '#' . ltrim( $color, '#' );
        $css .= <<<CSS

/* cutomize color css */
a,
a:focus,
blockquote > span ,
.product-details .product-title:hover, .product-list-widget a:hover,
.loader,
.hentry.sticky .entry-title:after,
.blockquote-style-1 span,
.dropcap.style-1,
.navbar-nav > .active > a,
.navbar-nav > .open > a,
.navbar-nav > .open > a:focus,
.navbar-nav > .open > a:hover,
.navbar-nav .mobile-links li > a:hover,
.testimonials .testimonial a,
.breadcrumb a,
.entry-title a:hover,
.entry-meta li a:hover ,
.entry .blockquote-style-1 p a:hover,
.widget_archive li a:hover, .widget_archive li a:focus,
.widget_categories li a:hover,
.widget_categories li a:focus,
.widget_pages li a:hover,
.widget_pages li a:focus,
.widget_meta li a:hover,
.widget_meta li a:focus,
.widget_recent_entries li a:hover,
.widget_recent_entries li a:focus,
.widget_nav_menu li a:hover,
.widget_nav_menu li a:focus,
.widget_product_categories li a:hover,
.widget_product_categories li a:focus,
.entry-list ul > li a:hover,
.entry-comments .comment-content .comment-edit-link,
.accordion .panel-default > .panel-heading > a.minus,
.product-details .product-title:hover,
.product-list-widget a:hover,
.product_meta span a:hover,
.table.shop_table .product-name > a:hover,
.woocommerce .woocommerce-breadcrumb a, .breadcrumb a,
.navbar-nav > li > a:hover,
.dropdown-menu > li > a:focus,
.dropdown-menu > li > a:hover,
.megamenu .menu-list > li > a:hover,
.megamenu-wide .menu-list > li > a:hover {
	color: $color;
}
.woocommerce-message:before,
.woocommerce-info:before {
	color: $color !important;
}

CSS;
    endif;

    /* cutomize color css */
    $bd_color = ahashop_option( 'border_color' );
    if( !empty($bd_color) ):
        $bd_color = '#' . ltrim( $bd_color, '#' );
        $css .= <<<CSS
.woocommerce-message,
.woocommerce-info {
	border-color: $bd_color !important;
}


CSS;
    endif;

	return $css;
}
add_action( 'ahashop_inline_css', 'ahashop_custom_color_css' );
