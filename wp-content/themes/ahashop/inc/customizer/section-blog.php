<?php
/**
 * Customize: Section Blog
 *
 * @package Ahashop
 */

/**
 * Register blog settings.
 *
 * @param  WP_Customize $wp_customize WP_Customize object.
 */
function ahashop_customize_register_blog( $wp_customize ) {
	$wp_customize->selective_refresh->add_partial( 'related_posts', array(
		'selector'        => '#related-posts',
		'render_callback' => 'ahashop_related_posts',
	) );

	$wp_customize->selective_refresh->add_partial( 'pagination_type', array(
		'selector'        => '#posts-navigation',
		'render_callback' => 'ahashop_posts_navigation',
	) );

	$wp_customize->add_section( 'blog', array(
		'title'       => esc_html__( 'Blog', 'ahashop' ),
		'priority'    => 70,
	) );

	$wp_customize->add_setting( 'content_options', array(
		'default'           => ahashop_default( 'content_options' ),
		'sanitize_callback' => 'ahashop_sanitize_content_options',
		'transport'         => 'refresh',
	) );

	$wp_customize->add_control( 'content_options', array(
		'label'       => esc_html__( 'Content options', 'ahashop' ),
		'section'     => 'blog',
		'type'        => 'radio',
		'choices'     => array(
			'full'    => esc_html__( 'Full post', 'ahashop' ),
			'excerpt' => esc_html__( 'Post excerpt', 'ahashop' ),
		),
	) );

	$wp_customize->add_setting( 'author_bio', array(
		'default'           => ahashop_default( 'author_bio' ),
		'sanitize_callback' => 'absint',
		'transport'         => 'refresh',
	) );

	$wp_customize->add_control( 'author_bio', array(
		'label'       => esc_html__( 'Show author bio', 'ahashop' ),
		'section'     => 'blog',
		'type'        => 'checkbox',
	) );

	$wp_customize->add_setting( 'related_posts', array(
		'default'           => ahashop_default( 'related_posts' ),
		'sanitize_callback' => 'absint',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'related_posts', array(
		'label'       => esc_html__( 'Show related posts', 'ahashop' ),
		'section'     => 'blog',
		'type'        => 'checkbox',
	) );

	$wp_customize->add_setting( 'sharing', array(
		'default'           => ahashop_default( 'sharing' ),
		'sanitize_callback' => 'absint',
		'transport'         => 'refresh',
	) );

	$wp_customize->add_control( 'sharing', array(
		'label'       => esc_html__( 'Show social sharing', 'ahashop' ),
		'section'     => 'blog',
		'type'        => 'checkbox',
	) );
}
add_action( 'customize_register', 'ahashop_customize_register_blog' );
