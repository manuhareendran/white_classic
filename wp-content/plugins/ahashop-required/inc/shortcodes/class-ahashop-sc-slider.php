<?php
/**
 * Shortcode [ahashop_slider]
 *
 * @package Ahashop
 */

/**
 * Class Ahashop_SC_Slider
 */
class Ahashop_SC_Slider extends Ahashop_Shortcode {

	/**
	 * Class Ahashop_SC_Slider constructor.
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
		return 'ahashop_slider';
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

		ahashop_sc_load_template( 'slider.php', $passed_data );

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
						'type'        => 'attach_image',
						'param_name'  => 'image',
						'heading'     => esc_html__( 'Image', 'ahashop' ),
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'title',
						'heading'     => esc_html__( 'Title', 'ahashop' ),
						'admin_label' => true,
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'title_size',
						'heading'     => esc_html__( 'Title font size in pixel', 'ahashop' ),
						'description' => esc_html__( "Leave empty for default. Don't include 'px'.", 'ahashop' ),
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'subtitle',
						'heading'     => esc_html__( 'Subtitle', 'ahashop' ),
					),
					array(
						'type'        => 'textarea',
						'param_name'  => 'desc',
						'heading'     => esc_html__( 'Description', 'ahashop' ),
					),
					array(
						'type'        => 'vc_link',
						'param_name'  => 'btn',
						'heading'     => esc_html__( 'Button', 'ahashop' ),
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'position',
						'heading'     => __( 'Content position', 'ahashop' ),
						'value'       => array(
							__( 'Left', 'ahashop' )   => 'left',
							__( 'Center', 'ahashop' ) => 'center',
							__( 'Right', 'ahashop' )  => 'right',
						),
						'std'         => 'left',
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'text_align',
						'heading'     => __( 'Content text align', 'ahashop' ),
						'value'       => array(
							__( 'Left', 'ahashop' )   => 'left',
							__( 'Center', 'ahashop' ) => 'center',
							__( 'Right', 'ahashop' )  => 'right',
						),
						'std'         => 'left',
					),
				),
			),
		);

		$params = array_merge(
			$params,
			ahashop_sc_param_design_options()
		);

		return array(
			'name'        => esc_html__( 'Slider', 'ahashop' ),
			'description' => esc_html__( 'Display slider.', 'ahashop' ),
			'category'    => $this->get_category(),
			'icon'        => $this->get_icon(),
			'params'      => $params,
		);
	}
}
new Ahashop_SC_Slider();
