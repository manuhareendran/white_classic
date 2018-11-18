<?php
/**
 * Customize: Section Logo
 *
 * @package Ahashop
 */

/**
 * Register section logo settings.
 *
 * @param  WP_Customize $wp_customize WP_Customize object.
 */
function ahashop_customize_register_logo( $wp_customize ) {
	$wp_customize->add_section( 'logo', array(
		'title'       => esc_html__( 'Logo', 'ahashop' ),
		'priority'    => 25,
	) );

	$wp_customize->get_control( 'custom_logo' )->section = 'logo';

	$wp_customize->add_setting( 'desktop_logo_width', array(
		'default'           => ahashop_default( 'desktop_logo_width' ),
		'sanitize_callback' => 'esc_attr',
		'transport'         => 'refresh',
	) );

	$wp_customize->add_control( 'desktop_logo_width', array(
		'label'       => esc_html__( 'Desktop logo width', 'ahashop' ),
		'section'     => 'logo',
		'type'        => 'text',
	) );

	$wp_customize->add_setting( 'desktop_header_padding', array(
		'default'           => ahashop_default( 'desktop_header_padding' ),
		'sanitize_callback' => 'esc_attr',
		'transport'         => 'refresh',
	) );

	$wp_customize->add_control( 'desktop_header_padding', array(
		'label'       => esc_html__( 'Desktop header height', 'ahashop' ),
		'section'     => 'logo',
		'type'        => 'text',
	) );

	$wp_customize->add_setting( 'tablet_logo_width', array(
		'default'           => ahashop_default( 'tablet_logo_width' ),
		'sanitize_callback' => 'esc_attr',
		'transport'         => 'refresh',
	) );

	$wp_customize->add_control( 'tablet_logo_width', array(
		'label'       => esc_html__( 'Ipad / Tablet logo width', 'ahashop' ),
		'section'     => 'logo',
		'type'        => 'text',
	) );

	$wp_customize->add_setting( 'tablet_header_padding', array(
		'default'           => ahashop_default( 'tablet_header_padding' ),
		'sanitize_callback' => 'esc_attr',
		'transport'         => 'refresh',
	) );

	$wp_customize->add_control( 'tablet_header_padding', array(
		'label'       => esc_html__( 'Ipad / Tablet header height', 'ahashop' ),
		'section'     => 'logo',
		'type'        => 'text',
	) );

	$wp_customize->add_setting( 'mobile_logo_width', array(
		'default'           => ahashop_default( 'mobile_logo_width' ),
		'sanitize_callback' => 'esc_attr',
		'transport'         => 'refresh',
	) );

	$wp_customize->add_control( 'mobile_logo_width', array(
		'label'       => esc_html__( 'Mobile logo width', 'ahashop' ),
		'section'     => 'logo',
		'type'        => 'text',
	) );

	$wp_customize->add_setting( 'mobile_header_padding', array(
		'default'           => ahashop_default( 'mobile_header_padding' ),
		'sanitize_callback' => 'esc_attr',
		'transport'         => 'refresh',
	) );

	$wp_customize->add_control( 'mobile_header_padding', array(
		'label'       => esc_html__( 'Mobile header height', 'ahashop' ),
		'section'     => 'logo',
		'type'        => 'text',
	) );
}
add_action( 'customize_register', 'ahashop_customize_register_logo' );


/**
 * Adds custom css for this section.
 *
 * @param  string $css Custom CSS.
 * @return string
 */
function ahashop_logo_customize_css( $css ) {

	/* Custom logo on mobile */
	$value = trim( ahashop_option( 'mobile_logo_width' ) );
	if ( $value ) {
		$css .= ".logo, .logo-dark { width: {$value}; }";
	}

	$value = trim( ahashop_option( 'mobile_header_padding' ) );
	if ( $value ) {
		$css .= ".logo-wrap, .navbar-header { height: {$value}; }";
	}


	/* Custom logo on Ipad/Tablet */
	$css .= '@media (min-width: 768px) {';
	$value = trim( ahashop_option( 'tablet_logo_width' ) );
	if ( $value ) {
		$css .= ".logo, .logo-dark { width: {$value}; }";
	}

	$value = trim( ahashop_option( 'tablet_header_padding' ) );
	if ( $value ) {
		$css .= ".logo-wrap, .navbar-header { height: {$value}; }";
	}
	$css .= '}';


	/* Custom logo on PC */
	$css .= '@media (min-width: 991px) {';
	$value = trim( ahashop_option( 'desktop_logo_width' ) );
	if ( $value ) {
		$css .= ".logo, .logo-dark { width: {$value}; }";
	}

	$value = trim( ahashop_option( 'desktop_header_padding' ) );
	if ( $value ) {
		$css .= ".logo-wrap, .navbar-header { height: {$value}; }";
		$css .= ".navbar { min-height: calc({$value} + 47px); }";
	}
	$css .= '}';

	return $css;
}
add_filter( 'ahashop_inline_css', 'ahashop_logo_customize_css' );
