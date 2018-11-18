<?php
/**
 * Shortcode [ahashop_testimonials]
 *
 * @package Ahashop
 */

/**
 * Class Ahashop_SC_Testimonials
 */
class Ahashop_SC_Testimonials extends Ahashop_Shortcode {

	/**
	 * Class Ahashop_SC_Testimonials constructor.
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
		return 'ahashop_testimonials';
	}

	/**
	 * Shortcode handler.
	 *
	 * @param  array $atts Shortcode attributes.
	 * @return string      Shortcode output.
	 */
	public function render( $atts ) {
		$atts = vc_map_get_attributes( $this->get_name(), $atts );

		$testimonials = vc_param_group_parse_atts( $atts['testimonials'] );

		if ( ! $testimonials ) {
			return;
		}

		// Build class.
		$el_class  = $this->getExtraClass( $atts['el_class'] );
		$el_class .= vc_shortcode_custom_css_class( $atts['css'], ' ' );

		$passed_data = compact( 'atts', 'testimonials', 'el_class' );

		ob_start();

		ahashop_sc_load_template( 'testimonials.php', $passed_data );

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
				'param_name' => 'testimonials',
				'heading'    => esc_html__( 'Testimonials', 'ahashop' ),
				'params'     => array(
					array(
						'type'        => 'textfield',
						'param_name'  => 'name',
						'heading'     => esc_html__( 'Name', 'ahashop' ),
						'admin_label' => true,
					),
					array(
						'type'        => 'textarea',
						'param_name'  => 'content',
						'heading'     => esc_html__( 'Content', 'ahashop' ),
					),
				),
			),
		);

		$params = array_merge(
			$params,
			ahashop_sc_param_design_options()
		);

		return array(
			'name'        => esc_html__( 'Testomonials', 'ahashop' ),
			'description' => esc_html__( 'Display testimonials.', 'ahashop' ),
			'category'    => $this->get_category(),
			'icon'        => $this->get_icon(),
			'params'      => $params,
		);
	}
}
new Ahashop_SC_Testimonials();
