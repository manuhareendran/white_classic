<?php
/**
 * Customize: Section Footer
 *
 * @package Ahashop
 */

/**
 * Register section footer settings.
 *
 * @param  WP_Customize $wp_customize WP_Customize object.
 */
function ahashop_customize_register_footer( $wp_customize ) {
	$wp_customize->selective_refresh->add_partial( 'copyright', array(
		'selector'        => '.copyright',
		'render_callback' => 'ahashop_copyright',
	) );

	$wp_customize->selective_refresh->add_partial( 'footer_text_right', array(
		'selector'        => '.footer-text-right',
		'render_callback' => 'ahashop_footer_text_right',
	) );

	$wp_customize->selective_refresh->add_partial( 'footer_columns', array(
		'selector'        => '.footer-columns-container',
		'render_callback' => 'ahashop_footer_columns',
	) );

	$wp_customize->selective_refresh->add_partial( 'footer_columns_number', array(
		'selector'        => '.footer-columns-container',
		'render_callback' => 'ahashop_footer_columns',
	) );

	$wp_customize->add_section( 'footer', array(
		'title'       => esc_html__( 'Footer', 'ahashop' ),
		'priority'    => 50,
	) );

	$wp_customize->add_setting( 'footer_columns', array(
		'default'           => ahashop_default( 'footer_columns' ),
		'sanitize_callback' => 'absint',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'footer_columns', array(
		'label'       => esc_html__( 'Show footer columns', 'ahashop' ),
		'section'     => 'footer',
		'type'        => 'checkbox',
	) );

	$wp_customize->add_setting( 'footer_columns_number', array(
		'default'           => ahashop_default( 'footer_columns_number' ),
		'sanitize_callback' => 'absint',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'footer_columns_number', array(
		'label'       => esc_html__( 'Number of columns', 'ahashop' ),
		'section'     => 'footer',
		'type'        => 'select',
		'choices'     => array(
			1 => esc_html__( '1 Column', 'ahashop' ),
			2 => esc_html__( '2 Columns', 'ahashop' ),
			3 => esc_html__( '3 Columns', 'ahashop' ),
			4 => esc_html__( '4 Columns', 'ahashop' ),
			5 => esc_html__( '5 Columns', 'ahashop' ),
			6 => esc_html__( '6 Columns', 'ahashop' ),
		),
		'active_callback' => 'ahashop_is_shown_footer_columns',
	) );

	$wp_customize->add_setting( 'copyright', array(
		'default'           => ahashop_default( 'copyright' ),
		'sanitize_callback' => 'wp_kses_post',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'copyright', array(
		'label'       => esc_html__( 'Copyright', 'ahashop' ),
		'section'     => 'footer',
		'type'        => 'textarea',
	) );

	$wp_customize->add_setting( 'footer_text_right', array(
		'default'           => ahashop_default( 'footer_text_right' ),
		'sanitize_callback' => 'wp_kses_post',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'footer_text_right', array(
		'label'       => esc_html__( 'Footer text right', 'ahashop' ),
		'description' => esc_html__( 'Content in the right of copyright', 'ahashop' ),
		'section'     => 'footer',
		'type'        => 'textarea',
	) );
}
add_action( 'customize_register', 'ahashop_customize_register_footer' );

/**
 * Check if footer columns is shown.
 *
 * @return boolean
 */
function ahashop_is_shown_footer_columns() {
	return (bool) ahashop_option( 'footer_columns' );
}
