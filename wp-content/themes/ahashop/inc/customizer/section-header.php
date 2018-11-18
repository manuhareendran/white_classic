<?php
/**
 * Customize: Section Header
 *
 * @package Ahashop
 */

/**
 * Register section header settings.
 *
 * @param  WP_Customize $wp_customize WP_Customize object.
 */
function ahashop_customize_register_header( $wp_customize ) {
	// Register selective refresh partials.
	$wp_customize->selective_refresh->add_partial( 'show_top_bar', array(
		'selector'        => '.top-bar',
		'render_callback' => 'ahashop_top_bar',
	) );

	$wp_customize->selective_refresh->add_partial( 'show_search_form', array(
		'selector'        => '.nav-search',
		'render_callback' => 'ahashop_header_search',
	) );

	// Register section.
	$wp_customize->add_section( 'header', array(
		'title'       => esc_html__( 'Header', 'ahashop' ),
		'priority'    => 40,
	) );

	$wp_customize->add_setting( 'header_scroll_fixed', array(
		'default'           => ahashop_default( 'header_scroll_fixed' ),
		'sanitize_callback' => 'absint',
		'transport'         => 'refresh',
	) );

	$wp_customize->add_control( 'header_scroll_fixed', array(
		'label'       => esc_html__( 'Header scroll fixed', 'ahashop' ),
		'section'     => 'header',
		'type'        => 'checkbox',
	) );

	$wp_customize->add_setting( 'show_top_bar', array(
		'sanitize_callback' => 'absint',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'show_top_bar', array(
		'label'       => esc_html__( 'Show top bar', 'ahashop' ),
		'section'     => 'header',
		'type'        => 'checkbox',
	) );

	$wp_customize->add_setting( 'show_search_form', array(
		'sanitize_callback' => 'absint',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'show_search_form', array(
		'label'       => esc_html__( 'Show search form', 'ahashop' ),
		'section'     => 'header',
		'type'        => 'checkbox',
	) );
}
add_action( 'customize_register', 'ahashop_customize_register_header' );
