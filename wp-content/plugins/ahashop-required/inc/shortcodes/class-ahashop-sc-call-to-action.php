<?php
/**
 * Shortcode [ahashop_call_to_action]
 *
 * @package Ahashop
 */

/**
 * Class Ahashop_SC_Call_To_Action
 */
class Ahashop_SC_Call_To_Action extends Ahashop_Shortcode {

	/**
	 * Class Ahashop_SC_Call_To_Action constructor.
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
		return 'ahashop_call_to_action';
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

		// Build class.
		$el_class = $this->getExtraClass( $atts['el_class'] );
		$el_class .= vc_shortcode_custom_css_class( $atts['css'], ' ' );

		$link = vc_build_link( $atts['btn_link'] );

		$passed_data = compact( 'atts', 'el_class', 'link' );

		ob_start();

		ahashop_sc_load_template( 'call-to-action.php', $passed_data );

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
				'type'        => 'textfield',
				'param_name'  => 'text',
				'heading'     => esc_html__( 'Text', 'ahashop' ),
				'std'         => 'YOU WANT TO GET THIS THEME NOW?',
				'admin_label' => true,
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'btn_label',
				'heading'    => esc_html__( 'Button label', 'ahashop' ),
				'std'        => 'BUY IT NOW',
			),
			array(
				'type'       => 'vc_link',
				'param_name' => 'btn_link',
				'heading'    => esc_html__( 'Button link', 'ahashop' ),
			),
		);

		$params = array_merge(
			$params,
			ahashop_sc_param_design_options()
		);

		return array(
			'name'        => esc_html__( 'Call to action', 'ahashop' ),
			'description' => esc_html__( 'Display Call to action box.', 'ahashop' ),
			'category'    => $this->get_category(),
			'icon'        => $this->get_icon(),
			'params'      => $params,
		);
	}
}
new Ahashop_SC_Call_To_Action();
