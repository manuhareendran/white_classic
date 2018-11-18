<?php
/**
 * Shortcode [ahashop_button]
 *
 * @package Ahashop
 */

/**
 * Class Ahashop_SC_Button
 */
class Ahashop_SC_Button extends Ahashop_Shortcode {

	/**
	 * Class Ahashop_SC_Button constructor.
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
		return 'ahashop_button';
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

		if ( ! $atts['label'] ) {
			return;
		}

		// Build class.
		$el_class = $this->getExtraClass( $atts['el_class'] );
		$el_class .= vc_shortcode_custom_css_class( $atts['css'], ' ' );

		$el_class .= ' btn-' . $atts['size'];
		$el_class .= ' btn-' . $atts['style'];

		$link = vc_build_link( $atts['link'] );

		$passed_data = compact( 'atts', 'el_class', 'link' );

		ob_start();

		ahashop_sc_load_template( 'button.php', $passed_data );

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
				'param_name'  => 'label',
				'heading'     => esc_html__( 'Button label', 'ahashop' ),
				'std'         => 'Button',
				'admin_label' => true,
			),
			array(
				'type'       => 'vc_link',
				'param_name' => 'link',
				'heading'    => esc_html__( 'Button link', 'ahashop' ),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'size',
				'heading'    => esc_html__( 'Button size', 'ahashop' ),
				'std'        => 'md',
				'value'      => array(
					__( 'Small', 'ahashop' )  => 'sm',
					__( 'Medium', 'ahashop' ) => 'md',
					__( 'Large', 'ahashop' )  => 'lg',
				),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'style',
				'heading'    => esc_html__( 'Button style', 'ahashop' ),
				'std'        => 'light',
				'value'      => array(
					'light',
					'color',
					'dark',
					'stroke',
					'yellow',
					'orange',
					'pink',
					'green',
					'dry-orange',
					'brown',
					'lavander',
					'dry-blue',
				),
			),
		);

		$params = array_merge(
			$params,
			ahashop_sc_param_design_options()
		);

		return array(
			'name'        => esc_html__( 'Button', 'ahashop' ),
			'description' => esc_html__( 'Display Button.', 'ahashop' ),
			'category'    => $this->get_category(),
			'icon'        => $this->get_icon(),
			'params'      => $params,
		);
	}
}
new Ahashop_SC_Button();
