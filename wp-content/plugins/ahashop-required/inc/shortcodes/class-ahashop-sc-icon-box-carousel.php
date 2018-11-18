<?php
/**
 * Shortcode [ahashop_icon_box_carousel]
 *
 * @package Ahashop
 */

/**
 * Class Ahashop_SC_Icon_Box_Carousel
 */
class Ahashop_SC_Icon_Box_Carousel extends Ahashop_Shortcode {

	/**
	 * Class Ahashop_SC_Icon_Box_Carousel constructor.
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
		return 'ahashop_icon_box_carousel';
	}

	/**
	 * Shortcode handler.
	 *
	 * @param  array $atts Shortcode attributes.
	 * @return string      Shortcode output.
	 */
	public function render( $atts ) {
		$atts = vc_map_get_attributes( $this->get_name(), $atts );

		$slides = vc_param_group_parse_atts( $atts['slides'] );

		if ( ! $slides ) {
			return;
		}

		// Build class.
		$el_class  = $this->getExtraClass( $atts['el_class'] );
		$el_class .= vc_shortcode_custom_css_class( $atts['css'], ' ' );

		$passed_data = compact( 'atts', 'slides', 'el_class' );

		ob_start();

		ahashop_sc_load_template( 'icon-box-carousel.php', $passed_data );

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
				'param_name' => 'slides',
				'heading'    => esc_html__( 'Slides', 'ahashop' ),
				'params'     => array(
					array(
						'type'       => 'iconpicker',
						'param_name' => 'icon',
						'heading'    => esc_html__( 'Icon', 'ahashop' ),
						'std'        => 'fa fa-envelope-o',
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'title',
						'heading'     => esc_html__( 'Title', 'ahashop' ),
						'std'         => 'Icon box title',
						'admin_label' => true,
					),
					array(
						'type'       => 'textfield',
						'param_name' => 'desc',
						'heading'    => esc_html__( 'Description', 'ahashop' ),
						'std'        => 'Icon box description',
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'layout',
						'heading'    => esc_html__( 'Layout', 'ahashop' ),
						'value'      => array(
							__( 'Horizontal', 'ahashop' ) => 'horizontal',
							__( 'Vertical', 'ahashop' )   => 'vertical',
						),
						'std'        => 'horizontal',
					),
				),
			),
		);

		$params = array_merge(
			$params,
			ahashop_sc_param_design_options()
		);

		return array(
			'name'        => esc_html__( 'Icon box carousel', 'ahashop' ),
			'description' => esc_html__( 'Display icon box carousel.', 'ahashop' ),
			'category'    => $this->get_category(),
			'icon'        => $this->get_icon(),
			'params'      => $params,
		);
	}
}
new Ahashop_SC_Icon_Box_Carousel();
