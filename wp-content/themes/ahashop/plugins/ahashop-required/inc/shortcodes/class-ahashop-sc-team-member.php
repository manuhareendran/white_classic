<?php
/**
 * Shortcode [ahashop_team_member]
 *
 * @package Ahashop
 */

/**
 * Class Ahashop_SC_Team_Member
 */
class Ahashop_SC_Team_Member extends Ahashop_Shortcode {

	/**
	 * Class Ahashop_SC_Team_Member constructor.
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
		return 'ahashop_team_member';
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

		if ( ! $atts['name'] ) {
			return '';
		}

		$socials = vc_param_group_parse_atts( $atts['socials'] );

		// Build class.
		$el_class = $this->getExtraClass( $atts['el_class'] );
		$el_class .= vc_shortcode_custom_css_class( $atts['css'], ' ' );

		$passed_data = compact( 'atts', 'el_class', 'socials' );

		ob_start();

		ahashop_sc_load_template( 'team-member.php', $passed_data );

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
				'param_name'  => 'name',
				'heading'     => esc_html__( 'Name', 'ahashop' ),
				'admin_label' => true,
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'position',
				'heading'     => esc_html__( 'Position', 'ahashop' ),
			),
			array(
				'type'        => 'textarea',
				'param_name'  => 'desc',
				'heading'     => esc_html__( 'Description', 'ahashop' ),
			),
			array(
				'type'        => 'attach_image',
				'param_name'  => 'avatar',
				'heading'     => esc_html__( 'Avatar', 'ahashop' ),
			),
			array(
				'type'        => 'param_group',
				'param_name'  => 'socials',
				'heading'     => esc_html__( 'Socials', 'ahashop' ),
				'params'      => array(
					array(
						'type' => 'iconpicker',
						'param_name' => 'icon',
						'heading'    => __( 'Icon', 'ahashop' ),
					),
					array(
						'type' => 'textfield',
						'param_name' => 'url',
						'heading'    => __( 'Url', 'ahashop' ),
					),
				),
			),
		);

		$params = array_merge(
			$params,
			ahashop_sc_param_design_options()
		);

		return array(
			'name'        => esc_html__( 'Team member', 'ahashop' ),
			'description' => esc_html__( 'Display team member information.', 'ahashop' ),
			'category'    => $this->get_category(),
			'icon'        => $this->get_icon(),
			'params'      => $params,
		);
	}
}
new Ahashop_SC_Team_Member();
