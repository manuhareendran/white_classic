<?php
/**
 * Shortcode [ahashop_newsletter]
 *
 * @package Ahashop
 */

/**
 * Class Ahashop_SC_Newsletter
 */
class Ahashop_SC_Newsletter extends Ahashop_Shortcode {

	/**
	 * Class Ahashop_SC_Newsletter constructor.
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
		return 'ahashop_newsletter';
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

		if ( ! $atts['form_sc'] ) {
			return '';
		}

		// Build class.
		$el_class = $this->getExtraClass( $atts['el_class'] );
		$el_class .= vc_shortcode_custom_css_class( $atts['css'], ' ' );

		// Replace `{`, `}`, `` with [, ], ".
		$atts['form_sc'] = str_replace( array( '`{`', '`}`', '``' ), array( '[', ']', '"' ), $atts['form_sc'] );

		$passed_data = compact( 'atts', 'el_class' );

		ob_start();

		ahashop_sc_load_template( 'newsletter.php', $passed_data );

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
				'type'       => 'textfield',
				'param_name' => 'title',
				'heading'    => esc_html__( 'Title', 'ahashop' ),
				'std'        => __( 'SUBSCRIBE TO RECEIVE OUR UPDATES', 'ahashop' ),
				'admin_label' => true,
			),
			array(
				'type'       => 'textarea',
				'param_name' => 'form_sc',
				'heading'    => esc_html__( 'Form shortcode', 'ahashop' ),
			),
		);

		$params = array_merge(
			$params,
			ahashop_sc_param_design_options()
		);

		return array(
			'name'        => esc_html__( 'Newsletter', 'ahashop' ),
			'description' => esc_html__( 'Display newsletter form.', 'ahashop' ),
			'category'    => $this->get_category(),
			'icon'        => $this->get_icon(),
			'params'      => $params,
		);
	}
}
new Ahashop_SC_Newsletter();
