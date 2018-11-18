<?php
/**
 * Ahashop customizer
 *
 * @package Ahashop
 */

/**
 * Require settings.
 */
require_once get_parent_theme_file_path( 'inc/customizer/section-general.php' );
require_once get_parent_theme_file_path( 'inc/customizer/section-header.php' );
require_once get_parent_theme_file_path( 'inc/customizer/section-footer.php' );
require_once get_parent_theme_file_path( 'inc/customizer/section-blog.php' );
require_once get_parent_theme_file_path( 'inc/customizer/section-logo.php' );


/**
 * Bind JS handlers to instantly live-preview changes.
 */
function ahashop_customize_preview_js() {
	wp_enqueue_script( 'ahashop-customize-preview', get_theme_file_uri( '/assets/js/customize-preview.js' ), array( 'customize-preview' ), '1.0.0', true );
}
add_action( 'customize_preview_init', 'ahashop_customize_preview_js' );

/**
 * Load dynamic logic for the customizer controls area.
 */
function ahashop_customize_panels_js() {
	wp_enqueue_script( 'ahashop-customize-controls', get_theme_file_uri( '/assets/js/customize-controls.js' ), array(), '1.0.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'ahashop_customize_panels_js' );

/**
 * Sanitize content option value.
 *
 * @param  mixed $value Customize value.
 * @return mixed
 */
function ahashop_sanitize_content_options( $value ) {
	if ( ! in_array( $value, array( 'full', 'excerpt' ) ) ) {
		$value = ahashop_default( 'content_options' );
	}

	return $value;
}

function ahashop_sanitize_sidebar_layout( $value ) {
	if ( ! in_array( $value, array( 'sidebar-right', 'sidebar-left', 'no-sidebar' ) ) ) {
		$value = ahashop_default( 'sidebar_layout' );
	}

	return $value;
}
