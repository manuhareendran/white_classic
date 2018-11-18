<?php
/**
 * Shortcode [ahashop_banner]
 *
 * @package Ahashop
 */

/**
 * Class Ahashop_SC_Banner
 */
class Ahashop_SC_Banner extends Ahashop_Shortcode {

	/**
	 * Class Ahashop_SC_Banner constructor.
	 */
	public function __construct() {
		add_shortcode( $this->get_name(), array( $this, 'render' ) );
		vc_lean_map( $this->get_name(), array( $this, 'map' ) );
	}

	/**
	 * Get shortcode name.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'ahashop_banner';
	}

	/**
	 * Shortcode handler.
	 *
	 * @param  array $atts Shortcode attributes.
	 * @return string      Shortcode output.
	 */
	public function render( $atts ) {
		$atts = vc_map_get_attributes( $this->get_name(), $atts );

		$atts = array_map( 'trim', $atts );

		if ( empty( $atts['image'] ) ) {
			return;
		}

		// Build class.
		$el_class = $this->getExtraClass( $atts['el_class'] );
		$el_class .= vc_shortcode_custom_css_class( $atts['css'], ' ' );

		$link = vc_build_link( $atts['link'] );

		$passed_data = compact( 'atts', 'el_class', 'link' );

		ob_start();

		ahashop_sc_load_template( 'banner.php', $passed_data );

		return ob_get_clean();
	}

	/**
	 * Get shortcode settings.
	 *
	 * @return array
	 * @see vc_lean_map()
	 */
	public function map() {
		$params = array(
			array(
				'type'        => 'attach_image',
				'param_name'  => 'image',
				'heading'     => esc_html__( 'Banner image', 'ahashop' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'text',
				'heading'     => esc_html__( 'Banner text', 'ahashop' ),
				'admin_label' => true,
			),
			array(
				'type'       => 'vc_link',
				'param_name' => 'link',
				'heading'    => esc_html__( 'Banner link', 'ahashop' ),
			),
		);

		$params = array_merge(
			$params,
			ahashop_sc_param_design_options()
		);

		return array(
			'name'        => esc_html__( 'Banner', 'ahashop' ),
			'description' => esc_html__( 'Display Banner.', 'ahashop' ),
			'category'    => $this->get_category(),
			'icon'        => $this->get_icon(),
			'params'      => $params,
		);
	}
}
new Ahashop_SC_Banner();
