<?php

function vc_extras_gmaps_config() {
	$params = array(
		array(
			'type'        => 'el_id',
			'param_name'  => 'id',
			'heading'     => esc_html__( 'Map ID', 'ahashop' ),
			'std'         => uniqid( 'map-' ),
			'holder'      => 'div',
			'class'       => 'bold',
			'description' => sprintf( __( 'Enter map ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'ahashop' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
		),

		array(
			'type'        => 'textfield',
			'param_name'  => 'width',
			'heading'     => esc_html__( 'Width', 'ahashop' ),
			'value'       => '100%',
			'edit_field_class' => 'vc_col-xs-6',
		),
		array(
			'type'        => 'textfield',
			'param_name'  => 'height',
			'heading'     => esc_html__( 'Height (px)', 'ahashop' ),
			'value'       => '350px',
			'edit_field_class' => 'vc_col-xs-6',
		),

		array(
			'type'        => 'textfield',
			'param_name'  => 'lat',
			'heading'     => esc_html__( 'Latitude', 'ahashop' ),
			'std'         => '21.030686',
			'admin_label' => true,
			'edit_field_class' => 'vc_col-xs-6',
		),
		array(
			'type'        => 'textfield',
			'param_name'  => 'lng',
			'heading'     => esc_html__( 'Longitude', 'ahashop' ),
			'value'       => '105.852403',
			'admin_label' => true,
			'edit_field_class' => 'vc_col-xs-6',
		),

		array(
			'type'       => 'dropdown',
			'param_name' => 'zoom',
			'heading'    => esc_html__( 'Map Zoom', 'ahashop' ),
			'std'        => 15,
			'value'      => range( 1, 21 ),
		),

		// Map markers.
		array(
			'type'        => 'param_group',
			'param_name'  => 'markers',
			'heading'     => esc_html__( 'Markers', 'ahashop' ),
			'group'       => esc_html__( 'Marker', 'ahashop' ),
			'params'      => array(
				array(
					'type'        => 'textfield',
					'param_name'  => 'label',
					'heading'     => esc_html__( 'Label', 'ahashop' ),
					'description' => esc_html__( 'A single textual character that appears inside a marker.', 'ahashop' ),
					'admin_label' => true,
				),
				array(
					'type'        => 'textfield',
					'param_name'  => 'lat',
					'heading'     => esc_html__( 'Latitude', 'ahashop' ),
					'admin_label' => true,
					'edit_field_class' => 'vc_col-xs-6',
				),
				array(
					'type'        => 'textfield',
					'param_name'  => 'lng',
					'heading'     => esc_html__( 'Longitude', 'ahashop' ),
					'admin_label' => true,
					'edit_field_class' => 'vc_col-xs-6',
				),
				array(
					'type'        => 'textarea',
					'param_name'  => 'content',
					'heading'     => esc_html__( 'Info Window', 'ahashop' ),
				),
				array(
					'type'        => 'attach_image',
					'param_name'  => 'icon',
					'heading'     => esc_html__( 'Custom marker icon', 'ahashop' ),
					'description' => esc_html__( 'Using a custom image as a marker instead of the default of Google Maps.', 'ahashop' ),
				),
			),
		),

		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Map Type', 'ahashop' ),
			'param_name'  => 'map_type',
			'std'         => 'roadmap',
			'value'       => array(
				esc_html__( 'Roadmap', 'ahashop' )   => 'roadmap',
				esc_html__( 'Satellite', 'ahashop' ) => 'satellite',
				esc_html__( 'Hybrid', 'ahashop' )    => 'hybrid',
				esc_html__( 'Terrain', 'ahashop' )   => 'terrain',
			),
			'group'       => esc_html__( 'Advanced', 'ahashop' ),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Map Styled', 'ahashop' ),
			'param_name'  => 'map_style',
			'value'       => array(
				esc_html__( 'None', 'ahashop' )             => 'none',
				esc_html__( 'Grayscale', 'ahashop' )        => 'grayscale',
				esc_html__( 'Ultra Light', 'ahashop' )      => 'ultra-light',
				esc_html__( 'Shades of Grey', 'ahashop' )   => 'shades-of-grey',
				esc_html__( 'Blue Water', 'ahashop' )       => 'blue-water',
				esc_html__( 'Pale Dawn', 'ahashop' )        => 'pale-dawn',
				esc_html__( 'Light Monochrome', 'ahashop' ) => 'light-monochrome',
				esc_html__( 'Custom', 'ahashop' )           => 'custom',
			),
			'group'       => esc_html__( 'Advanced', 'ahashop' ),
		),
		array(
			'type'         => 'textarea_raw_html',
			'param_name'   => 'custom_map_style',
			'heading'      => esc_html__( 'Google Styled Map JSON','ahashop' ),
			'description'  => wp_kses_post( __( sprintf( '<a href="%s" target="_blank">Click here</a> to build the style JSON code for styling your map, or you can easy get beautiful styles at <a href="%s" target="_blank">snazzymaps.com</a>', esc_url( 'http://googlemaps.github.io/js-samples/styledmaps/wizard' ), esc_url( 'https://snazzymaps.com' ) ), 'ahashop' ) ),
			'group'        => esc_html__( 'Custom Styled', 'ahashop' ),
			'dependency'   => array( 'element' => 'map_style', 'value' => array( 'custom' ) ),
		),
		array(
			'type'        => 'checkbox',
			'param_name'  => 'scrollwheel',
			'value'       => array( esc_html__( 'Disable map zoom on mouse wheel scroll', 'ahashop' ) => 'false' ),
			'group'       => esc_html__( 'Advanced', 'ahashop' ),
		),
		array(
			'type'        => 'checkbox',
			'param_name'  => 'draggable',
			'value'       => array( esc_html__( 'Disable map dragging', 'ahashop' ) => 'false' ),
			'group'       => esc_html__( 'Advanced', 'ahashop' ),
		),
		array(
			'type'        => 'checkbox',
			'param_name'  => 'zoom_control',
			'value'       => array( esc_html__( 'Disable zoom control', 'ahashop' ) => 'false' ),
			'group'       => esc_html__( 'Advanced', 'ahashop' ),
		),
		array(
			'type'        => 'checkbox',
			'param_name'  => 'map_type_control',
			'value'       => array( esc_html__( 'Disable map type control', 'ahashop' ) => 'false' ),
			'group'       => esc_html__( 'Advanced', 'ahashop' ),
		),
		array(
			'type'        => 'checkbox',
			'param_name'  => 'street_view_control',
			'value'       => array( esc_html__( 'Enable street view control', 'ahashop' ) => 'true' ),
			'group'       => esc_html__( 'Advanced', 'ahashop' ),
		),
		array(
			'type'        => 'checkbox',
			'param_name'  => 'fullscreen_control',
			'value'       => array( esc_html__( 'Enable fullscreen control', 'ahashop' ) => 'true' ),
			'group'       => esc_html__( 'Advanced', 'ahashop' ),
		),

		array(
			'type'        => 'textfield',
			'param_name'  => 'googleapis_key',
			'heading'     => esc_html__( 'Google Maps API Key', 'ahashop' ),
			'value'       => '[default]',
			'group'       => esc_html__( 'Advanced', 'ahashop' ),
			'description'  => wp_kses_post( __( sprintf( 'You can use the default API key we provide or click <a href="%s" target="_blank">here</a> to get a Google API Key.', esc_url( 'https://developers.google.com/maps/documentation/javascript/get-api-key' ) ), 'ahashop' ) ),
		),

		// Map CSS
		array(
			'type'        => 'textfield',
			'param_name'  => 'el_class',
			'heading'     => esc_html__( 'Extra class name', 'ahashop' ),
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'ahashop' ),
		),
		array(
			'type'       => 'css_editor',
			'param_name' => 'css',
			'heading'    => esc_html__( 'CSS box', 'ahashop' ),
			'group'      => esc_html__( 'Design Options', 'ahashop' ),
		),
	);

	return array(
		'name'        => esc_html__( 'Google Maps', 'ahashop' ),
		'icon'        => vc_extras_shortcode_icon( 'maps' ),
		'category'    => esc_html__( 'Minwp', 'ahashop' ),
		'description' => esc_html__( 'Powerful Google Maps', 'ahashop' ),
		'params'      => $params,
	);
}
vc_lean_map( 'minwp_gmaps', 'vc_extras_gmaps_config' );

class WPBakeryShortCode_Minwp_Gmaps extends WPBakeryShortCode_Extended {

	/**
	 * Register JS and CSS for render page.
	 */
	public function registerScripts() {
		wp_register_script( 'gmaps-js', VC_EXTENDED_URL . 'js/gmaps.min.js' , array( 'googleapis-maps' ), '0.4.24', true );
		wp_register_script( 'gmaps-init', VC_EXTENDED_URL . 'js/gmaps-init.js' , array( 'gmaps-js' ), '06222016', true );
	}

	/**
	 * Enqueue JS and CSS for render page.
	 */
	public function enqueueScripts( $atts ) {
		wp_register_script( 'googleapis-maps', '//maps.googleapis.com/maps/api/js' . $this->get_googleapis_key( $atts ), array(), null, false );

		wp_enqueue_script( 'gmaps-js' );
		wp_enqueue_script( 'gmaps-init' );
	}

	/**
	 * Get googleapis.
	 */
	protected function get_googleapis_key( $atts ) {
		$atts = shortcode_atts( array( 'googleapis_key' => '[default]' ), $atts );

		if ( '[default]' === $atts['googleapis_key'] ) {
			$googleapis_key = defined( 'EXTRAS_VC_GOOGLE_API_KEY' ) ? EXTRAS_VC_GOOGLE_API_KEY : 'AIzaSyC_bxayREAUpY0zDTNhZslXWgagXsFrbGA';
		} else {
			$googleapis_key = trim( $atts['googleapis_key'] );
		}

		return $googleapis_key ? '?key='.$googleapis_key : '';
	}
}
