<?php
/**
 * Shortcode [ahashop_accordion]
 *
 * @package Ahashop
 */

/**
 * Class Ahashop_SC_Accordion
 */
class Ahashop_SC_Accordion extends Ahashop_Shortcode {

	/**
	 * Class Ahashop_SC_Accordion constructor.
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
		return 'ahashop_accordion';
	}

	/**
	 * Shortcode handler.
	 *
	 * @param  array $atts Shortcode attributes.
	 * @return string      Shortcode output.
	 */
	public function render( $atts ) {
		$atts = vc_map_get_attributes( $this->get_name(), $atts );

		$items = vc_param_group_parse_atts( $atts['items'] );

		if ( ! $items ) {
			return;
		}

		// Build class.
		$el_class  = $this->getExtraClass( $atts['el_class'] );
		$el_class .= vc_shortcode_custom_css_class( $atts['css'], ' ' );
		// $el_class .= ' style-' . $atts['style'];

		// Accordion id.
		$unique_id = mt_rand( 100, 999 );

		$passed_data = compact( 'atts', 'items', 'el_class', 'unique_id' );

		ob_start();

		ahashop_sc_load_template( 'accordion.php', $passed_data );

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
				'param_name' => 'items',
				'heading'    => esc_html__( 'Items', 'ahashop' ),
				'params'     => array(
					array(
						'type'        => 'textfield',
						'param_name'  => 'title',
						'heading'     => esc_html__( 'Title', 'ahashop' ),
						'admin_label' => true,
					),
					array(
						'type'        => 'textarea',
						'param_name'  => 'content',
						'heading'     => esc_html__( 'Content', 'ahashop' ),
					),
				),
			),
			/*array(
				'type'        => 'dropdown',
				'param_name'  => 'style',
				'heading'     => esc_html__( 'Style', 'ahashop' ),
				'std'         => 'default',
				'value'       => array(
					__( 'Default', 'ahashop' )  => 'default',
					__( 'Bordered', 'ahashop' ) => 'bordered',
				),
			),*/
		);

		$params = array_merge(
			$params,
			ahashop_sc_param_design_options()
		);

		return array(
			'name'        => esc_html__( 'Accordion', 'ahashop' ),
			'description' => esc_html__( 'Display accordion.', 'ahashop' ),
			'category'    => $this->get_category(),
			'icon'        => $this->get_icon(),
			'params'      => $params,
		);
	}
}
new Ahashop_SC_Accordion();
