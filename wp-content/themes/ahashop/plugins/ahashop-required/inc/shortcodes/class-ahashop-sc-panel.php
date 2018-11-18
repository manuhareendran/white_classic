<?php
/**
 * Shortcode [ahashop_panel]
 *
 * @package Ahashop
 */

/**
 * Class Ahashop_SC_Panel
 */
class Ahashop_SC_Panel extends Ahashop_Shortcode {

	/**
	 * Class Ahashop_SC_Panel constructor.
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
		return 'ahashop_panel';
	}

	/**
	 * Shortcode handler.
	 *
	 * @param  array  $atts    Shortcode attributes.
	 * @param  string $content Shortcode content.
	 * @return string      Shortcode output.
	 */
	public function render( $atts, $content = '' ) {
		$atts = vc_map_get_attributes( $this->get_name(), $atts );

		$atts = array_map( 'trim', $atts );

		if ( empty( $atts['title'] ) ) {
			return;
		}

		// Build class.
		$el_class  = $this->getExtraClass( $atts['el_class'] );
		$el_class .= vc_shortcode_custom_css_class( $atts['css'], ' ' );
		// $el_class .= ' style-' . $atts['style'];

		$passed_data = compact( 'atts', 'el_class', 'content' );

		ob_start();

		ahashop_sc_load_template( 'panel.php', $passed_data );

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
				'param_name'  => 'title',
				'heading'     => esc_html__( 'Title', 'ahashop' ),
				'admin_label' => true,
			),
			array(
				'type'        => 'textarea_html',
				'param_name'  => 'content',
				'heading'     => esc_html__( 'Content', 'ahashop' ),
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
			'name'        => esc_html__( 'Panel', 'ahashop' ),
			'description' => esc_html__( 'Display panel.', 'ahashop' ),
			'category'    => $this->get_category(),
			'icon'        => $this->get_icon(),
			'params'      => $params,
		);
	}
}
new Ahashop_SC_Panel();
