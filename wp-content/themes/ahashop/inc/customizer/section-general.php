<?php
/**
 * Customize: Section General
 *
 * @package Ahashop
 */

/**
 * Register section general settings.
 *
 * @param  WP_Customize $wp_customize WP_Customize object.
 */
function ahashop_customize_register_general( $wp_customize ) {
	$wp_customize->add_section( 'general', array(
		'title'       => esc_html__( 'General', 'ahashop' ),
		'priority'    => 30,
	) );

	$wp_customize->add_setting( 'show_preloader', array(
		'default'           => ahashop_default( 'show_preloader' ),
		'sanitize_callback' => 'absint',
		'transport'         => 'refresh',
	) );

	$wp_customize->add_control( 'show_preloader', array(
		'label'       => esc_html__( 'Show preloader', 'ahashop' ),
		'section'     => 'general',
		'type'        => 'checkbox',
	) );
}
add_action( 'customize_register', 'ahashop_customize_register_general' );
