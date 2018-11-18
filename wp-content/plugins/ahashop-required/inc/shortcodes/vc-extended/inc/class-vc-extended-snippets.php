<?php
/**
 * Visual Composer Extended Snippets Params.
 *
 * @package VCExtended
 * @subpackage VC-Extended
 */

/**
 * The VC_Extended_Snippets class.
 */
class VC_Extended_Snippets {

	/**
	 * Slick params snippets.
	 *
	 * @see Extras_Composer_Utils::parse_slick_atts()
	 *
	 * @param  array|string $breakpoints Default breakpoints responsive.
	 * @return array
	 */
	public static function slick_params( $breakpoints = null ) {
		$params = array(
			array(
				'type'        => 'checkbox',
				'param_name'  => '_slick_arrows',
				'value'       => array( esc_html__( 'Show prev/next arrows?', 'sydneywp' ) => true ),
				'group'       => esc_html__( 'Slider Settings', 'sydneywp' ),
				'std'         => true,
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => '_slick_dots',
				'value'       => array( esc_html__( 'Show dot indicators?', 'sydneywp' ) => true ),
				'group'       => esc_html__( 'Slider Settings', 'sydneywp' ),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => '_slick_autoplay',
				'value'       => array( esc_html__( 'Enables autoplay?', 'sydneywp' ) => true ),
				'group'       => esc_html__( 'Slider Settings', 'sydneywp' ),
			),
			array(
				'type'        => 'vce_textaddon',
				'param_name'  => '_slick_autoplay_speed',
				'heading'     => esc_html__( 'Autoplay speed', 'sydneywp' ),
				'description' => esc_html__( 'Autoplay speed in milliseconds, default: 3000 ms.', 'sydneywp' ),
				'group'       => esc_html__( 'Slider Settings', 'sydneywp' ),
				'std'         => '3000',
				'addon_text'  => 'ms',
				'dependency'  => array( 'element' => '_slick_autoplay', 'value' => array( true ) ),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => '_slick_draggable',
				'value'       => array( esc_html__( 'Enable mouse dragging?', 'sydneywp' ) => true ),
				'group'       => esc_html__( 'Slider Settings', 'sydneywp' ),
				'std'         => true,
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => '_slick_infinite',
				'value'       => array( esc_html__( 'Infinite loop sliding?', 'sydneywp' ) => true ),
				'group'       => esc_html__( 'Slider Settings', 'sydneywp' ),
			),
			array(
				'type'        => 'vce_responsive',
				'param_name'  => '_slick_breakpoints',
				'heading'     => esc_html__( 'Responsive Breakpoints', 'sydneywp' ),
				'group'       => esc_html__( 'Slider Settings', 'sydneywp' ),
				'default'     => $breakpoints,
			),
		);

		return apply_filters( 'vc_extended_snippets_slick_params', $params );
	}

	/**
	 * Extra class name and desgin option tabs.
	 *
	 * @return array
	 */
	public static function design_options() {
		return array(
			array(
				'type'        => 'textfield',
				'param_name'  => 'el_class',
				'heading'     => esc_html__( 'Extra class name', 'sydneywp' ),
			),
			array(
				'type'        => 'css_editor',
				'param_name'  => 'css',
				'heading'     => esc_html__( 'CSS box', 'sydneywp' ),
				'group'       => esc_html__( 'Design Options', 'sydneywp' ),
			),
		);
	}
}
