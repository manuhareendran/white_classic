<?php
/**
 * Ahashop back compat functionality
 *
 * Prevents Ahashop from running on WordPress versions prior to 4.7,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.7.
 *
 * @package Ahashop
 * @since Ahashop 1.0.0
 */

/**
 * Prevent switching to Ahashop on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since Ahashop 1.0.0
 */
function ahashop_switch_theme() {
	switch_theme( WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'ahashop_upgrade_notice' );
}
add_action( 'after_switch_theme', 'ahashop_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Ahashop on WordPress versions prior to 4.7.
 *
 * @since Ahashop 1.0.0
 *
 * @global string $wp_version WordPress version.
 */
function ahashop_upgrade_notice() {
	$message = sprintf( esc_html__( 'Ahashop requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'ahashop' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', esc_html( $message ) );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.7.
 *
 * @since Ahashop 1.0.0
 *
 * @global string $wp_version WordPress version.
 */
function ahashop_customize() {
	wp_die( sprintf( esc_html__( 'Ahashop requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'ahashop' ), esc_html( $GLOBALS['wp_version'] ) ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'ahashop_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.7.
 *
 * @since Ahashop 1.0.0
 *
 * @global string $wp_version WordPress version.
 */
function ahashop_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( esc_html__( 'Ahashop requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'ahashop' ), esc_html( $GLOBALS['wp_version'] ) ) );
	}
}
add_action( 'template_redirect', 'ahashop_preview' );
