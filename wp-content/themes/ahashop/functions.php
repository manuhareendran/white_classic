<?php
/**
 * Theme functions
 *
 * @package Ahashop
 */

/**
 * Theme only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ahashop_setup() {
	/*
	 * Make theme available for translation.
	 */
	load_theme_textdomain( 'ahashop', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'ahashop-large', 840, 420, true );
	add_image_size( 'ahashop-product', 300, 375, true );

	// Set the default content width.
	$GLOBALS['content_width'] = apply_filters( 'ahashop_content_width', 850 );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'top-menu' => esc_html__( 'Top Menu', 'ahashop' ),
		'primary'  => esc_html__( 'Primary Menu', 'ahashop' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'gallery',
		'link',
		'image',
		'quote',
		'status',
		'video',
		'audio',
		'chat',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'height'      => 40,
		'flex-width'  => true,
		'flex-height' => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	add_theme_support( 'breadcrumb-trail' );

	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'ahashop_setup' );

/**
 * Register custom fonts.
 */
function ahashop_fonts_url() {
	$fonts_url = '';
	$font_families = array();

	/**
	 * Translators: If there are characters in your language that are not
	 * supported by Maven Pro, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$font = _x( 'on', 'Maven Pro font: on or off', 'ahashop' );
	if ( 'off' !== $font ) {
		$font_families[] = 'Maven Pro:400,700';
	}

	/**
	 * Translators: If there are characters in your language that are not
	 * supported by Raleway, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$font = _x( 'on', 'Raleway font: on or off', 'ahashop' );
	if ( 'off' !== $font ) {
		$font_families[] = 'Raleway:300,400,700';
	}

	/**
	 * Translators: If there are characters in your language that are not
	 * supported by Playfair Display, translate this to 'off'. Do not translate
	 * into your own language.
	*/

	$font = _x( 'on', 'Playfair Display font: on or off', 'ahashop' );
	if ( 'off' !== $font ) {
		$font_families[] = 'Playfair Display:700';
	}


	$query_args = array(
		'family' => urlencode( implode( '|', $font_families ) ),
		'subset' => urlencode( 'latin,latin-ext' ),
	);

	$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function ahashop_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'ahashop-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'ahashop_resource_hints', 10, 2 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ahashop_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ahashop' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'ahashop' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title heading uppercase">',
		'after_title'   => '</h2>',
	) );

	if ( class_exists( 'WooCommerce' ) ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Shop Sidebar', 'ahashop' ),
			'id'            => 'shop-sidebar',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar on shop page.', 'ahashop' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title heading uppercase">',
			'after_title'   => '</h2>',
		) );
	}

	register_sidebars( 6, array(
		'name'          => esc_html__( 'Footer column %d', 'ahashop' ),
		'id'            => 'footer-column',
		'description'   => esc_html__( 'Add widgets here to appear in footer columns if it is shown.', 'ahashop' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title uppercase">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'ahashop_widgets_init' );

/**
 * Get default option value.
 *
 * @param  string $name Option name.
 * @return mixed
 */
function ahashop_default( $name ) {
	$defaults = apply_filters( 'ahashop_default_options', array(
		// General.
		'show_preloader'     => true,

		// Header.
		'header_scroll_fixed' => true,

		// Footer.
		'footer_columns_number' => 5,

		// Sidebar.
		'sidebar_layout'         => 'sidebar-right',
		'sidebar_archive_layout' => 'sidebar-right',
		'sidebar_single_layout'  => 'sidebar-right',
		'sidebar_page_layout'    => 'sidebar-right',

		// Blog.
		'content_options'    => 'full',
		'author_bio'         => true,
		'related_posts'      => true,
		'sharing'            => false,

		// Footer.
		'copyright'          => '&copy; 2017 AhaShop. Made with love by <a href="https://minwp.com/" title="" target="_blank">MinwpTeam</a>',

		// Shop.
		'sidebar_shop_layout'             => 'no-sidebar',
		'sidebar_product_layout'          => 'no-sidebar',
		'sidebar_product_taxonomy_layout' => 'no-sidebar',
	) );

	if ( ! isset( $defaults[ $name ] ) ) {
		return null;
	}

	return $defaults[ $name ];
}

/**
 * Get option.
 *
 * @param  string $name    Option name.
 * @return mixed
 */
function ahashop_option( $name ) {
	$default = ahashop_default( $name );

	$value = get_theme_mod( $name, $default );

	$value = apply_filters( 'ahashop_option', $value, $name );
	$value = apply_filters( 'ahashop_option_' . $name, $value );

	return $value;
}

/**
 * Enqueue scripts and styles.
 */
function ahashop_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'ahashop-fonts', ahashop_fonts_url(), array(), null );

	/* CSS files */
	wp_enqueue_style( 'bootstrap', get_theme_file_uri( 'assets/css/bootstrap.min.css' ), array(), '3.3.7' );

	wp_enqueue_style( 'magnific-popup', get_theme_file_uri( 'assets/css/magnific-popup.css' ), array(), '1.1.0' );

	wp_enqueue_style( 'font-awesome', get_theme_file_uri( 'assets/css/font-awesome.min.css' ), array(), '4.7.0' );

	wp_enqueue_style( 'elegant-icons', get_theme_file_uri( 'assets/css/elegant-icons.css' ) );

	wp_enqueue_style( 'owl-carousel', get_theme_file_uri( 'assets/css/owl-carousel.min.css' ), array(), '1.3.3' );

	wp_enqueue_style( 'flickity', get_theme_file_uri( 'assets/css/flickity.min.css' ), array(), '2.0.5' );

	wp_enqueue_style( 'flexslider', get_theme_file_uri( 'assets/css/flexslider.min.css' ), array(), '2.4.0' );

	wp_enqueue_style( 'animate', get_theme_file_uri( 'assets/css/animate.min.css' ) );

	wp_enqueue_style( 'ahashop-main', get_theme_file_uri( 'assets/css/style.css' ), array(), '1.4.3' );


	// Theme stylesheet.
	wp_enqueue_style( 'ahashop-style', get_stylesheet_uri() );

	/* Javascript files */
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), '3.3.7', true );

	wp_enqueue_script( 'jquery-easing', get_template_directory_uri() . '/assets/js/jquery.easing.1.3.min.js', array( 'jquery' ), '1.3', true );

	wp_enqueue_script( 'jquery-appear', get_template_directory_uri() . '/assets/js/jquery.appear.js', array( 'jquery' ), '0.3.6', true );

	wp_enqueue_script( 'jquery-fitvids', get_template_directory_uri() . '/assets/js/jquery.fitvids.js', array( 'jquery' ), '1.1', true );

	wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/assets/js/jquery.flexslider-min.js', array( 'jquery' ), '2.6.3', true );

	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), '1.3.3', true );

	wp_enqueue_script( 'smoothscroll', get_template_directory_uri() . '/assets/js/SmoothScroll.js', array(), '1.4.6', true );

	wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array( 'jquery' ), '1.1.0', true );

	wp_enqueue_script( 'flickity', get_template_directory_uri() . '/assets/js/flickity.pkgd.min.js', array(), '2.0.5', true );

	wp_enqueue_script( 'scrollreveal', get_template_directory_uri() . '/assets/js/scrollreveal.min.js', array(), '3.3.2', true );

	wp_enqueue_script( 'wc-add-to-cart-variation' );

	wp_enqueue_script( 'ahashop-main', get_theme_file_uri( 'assets/js/scripts.js' ), array( 'jquery' ), '1.0.0', true );

	wp_add_inline_style( 'ahashop-main', apply_filters( 'ahashop_inline_css', '' ) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ahashop_scripts' );

/**
 * Enqueues backend scripts.
 */
function ahashop_admin_scripts() {
	wp_enqueue_script( 'ahashop-loco-translate', get_template_directory_uri() . '/assets/js/loco-translate.js', array( 'jquery' ), '1.1.2', true );
}
add_action( 'admin_enqueue_scripts', 'ahashop_admin_scripts' );

/**
 * Registers required plugins for full features.
 */
require_once get_template_directory() . '/inc/required-plugins.php';
require_once get_template_directory() . '/inc/class-ahashop-primary-menu-walker.php';
require_once get_template_directory() . '/inc/extras.php';
require_once get_template_directory() . '/inc/post-formats.php';
require_once get_template_directory() . '/inc/template-tags.php';
require_once get_template_directory() . '/inc/customizer/customizer.php';
require_once get_template_directory() . '/inc/class-ahashop-sidebar.php';
require_once get_template_directory() . '/inc/custom-color.php';

if ( class_exists( 'WooCommerce' ) ) {
	/**
	 * Requires WooCommerce customization functions.
	 */
	require_once get_template_directory() . '/inc/woocommerce/woocommerce.php';
}
