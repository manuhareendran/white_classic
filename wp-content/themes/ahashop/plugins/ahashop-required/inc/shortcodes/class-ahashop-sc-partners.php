<?php
/**
 * Shortcode [ahashop_partners]
 *
 * @package Ahashop
 */

/**
 * Class Ahashop_SC_Partners
 */
class Ahashop_SC_Partners extends Ahashop_Shortcode {

	/**
	 * Class Ahashop_SC_Partners constructor.
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
		return 'ahashop_partners';
	}

	/**
	 * Shortcode handler.
	 *
	 * @param  array $atts Shortcode attributes.
	 * @return string      Shortcode output.
	 */
	public function render( $atts ) {
		$atts = vc_map_get_attributes( $this->get_name(), $atts );
		$partners = vc_param_group_parse_atts( $atts['partners'] );

		if ( ! $partners ) {
			return;
		}

		// Build class.
		$el_class = $this->getExtraClass( $atts['el_class'] );
		$el_class .= vc_shortcode_custom_css_class( $atts['css'], ' ' );

		$passed_data = compact( 'atts', 'partners', 'el_class' );

		ob_start();

		ahashop_sc_load_template( 'partners.php', $passed_data );

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
				'type'       => 'param_group',
				'param_name' => 'partners',
				'heading'    => esc_html__( 'Partners', 'ahashop' ),
				'params'     => array(
					array(
						'type'        => 'attach_image',
						'param_name'  => 'image',
						'heading'     => esc_html__( 'Partner image', 'ahashop' ),
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'url',
						'heading'     => esc_html__( 'Partner url', 'ahashop' ),
						'admin_label' => true,
					),
				),
			),
		);

		$params = array_merge(
			$params,
			ahashop_sc_param_design_options()
		);

		return array(
			'name'        => esc_html__( 'Partners', 'ahashop' ),
			'description' => esc_html__( 'Display partners carousel.', 'ahashop' ),
			'category'    => $this->get_category(),
			'icon'        => $this->get_icon(),
			'params'      => $params,
		);
	}
}
new Ahashop_SC_Partners();
