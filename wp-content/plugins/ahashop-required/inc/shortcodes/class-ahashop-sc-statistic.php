<?php
/**
 * Shortcode [ahashop_statistic]
 *
 * @package Ahashop
 */

/**
 * Class Ahashop_SC_Statistic
 */
class Ahashop_SC_Statistic extends Ahashop_Shortcode {

	/**
	 * Class Ahashop_SC_Statistic constructor.
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
		return 'ahashop_statistic';
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

		if ( ! $atts['title'] ) {
			return '';
		}

		// Build class.
		$el_class = $this->getExtraClass( $atts['el_class'] );
		$el_class .= vc_shortcode_custom_css_class( $atts['css'], ' ' );

		$passed_data = compact( 'atts', 'el_class' );

		ob_start();

		ahashop_sc_load_template( 'statistic.php', $passed_data );

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
				'type'        => 'textfield',
				'param_name'  => 'desc',
				'heading'     => esc_html__( 'Description', 'ahashop' ),
			),
		);

		$params = array_merge(
			$params,
			ahashop_sc_param_design_options()
		);

		return array(
			'name'        => esc_html__( 'Statistic', 'ahashop' ),
			'description' => esc_html__( 'Display statistic information.', 'ahashop' ),
			'category'    => $this->get_category(),
			'icon'        => $this->get_icon(),
			'params'      => $params,
		);
	}
}
new Ahashop_SC_Statistic();
