<?php
/**
 * Sydney shortcodes
 *
 * @package Sydney
 */

/**
 * Check if Visual Composer is activated.
 *
 * @return boolean
 */
function ahashop_is_vc_activated() {
	return class_exists( 'Vc_Manager' );
}

/**
 * Load shortcodes.
 */
function ahashop_sc_includes() {
	if ( ahashop_is_vc_activated() ) {
        require_once AHASHOP_REQUIRED_PATH . 'inc/shortcodes/class-ahashop-shortcode.php';
        require_once AHASHOP_REQUIRED_PATH . 'inc/shortcodes/min_icon_element.php';

		require_once AHASHOP_REQUIRED_PATH . 'inc/shortcodes/class-ahashop-sc-accordion.php';
		require_once AHASHOP_REQUIRED_PATH . 'inc/shortcodes/class-ahashop-sc-banner.php';
		require_once AHASHOP_REQUIRED_PATH . 'inc/shortcodes/class-ahashop-sc-button.php';
		require_once AHASHOP_REQUIRED_PATH . 'inc/shortcodes/class-ahashop-sc-call-to-action.php';
		require_once AHASHOP_REQUIRED_PATH . 'inc/shortcodes/class-ahashop-sc-icon-box.php';
		require_once AHASHOP_REQUIRED_PATH . 'inc/shortcodes/class-ahashop-sc-icon-box-carousel.php';
		require_once AHASHOP_REQUIRED_PATH . 'inc/shortcodes/class-ahashop-sc-newsletter.php';
		require_once AHASHOP_REQUIRED_PATH . 'inc/shortcodes/class-ahashop-sc-panel.php';
		require_once AHASHOP_REQUIRED_PATH . 'inc/shortcodes/class-ahashop-sc-partners.php';
		require_once AHASHOP_REQUIRED_PATH . 'inc/shortcodes/class-ahashop-sc-progress-bar.php';
		require_once AHASHOP_REQUIRED_PATH . 'inc/shortcodes/class-ahashop-sc-slider.php';
		require_once AHASHOP_REQUIRED_PATH . 'inc/shortcodes/class-ahashop-sc-statistic.php';
		require_once AHASHOP_REQUIRED_PATH . 'inc/shortcodes/class-ahashop-sc-team-member.php';
		require_once AHASHOP_REQUIRED_PATH . 'inc/shortcodes/class-ahashop-sc-testimonials.php';
	}
}

add_action('init', 'ahashop_sc_includes', 10);

function ahashop_extended_includes() {
    require_once AHASHOP_REQUIRED_PATH . 'inc/shortcodes/vc-extended/init.php';
}
add_action( 'plugins_loaded', 'ahashop_extended_includes' );

function ahashop_load_vc_shortcode() {

}

/**
 * Get template path.
 *
 * @param  string $filename Filename with extension.
 * @return string           Template path.
 */
function ahashop_sc_locate_template( $filename ) {
	$theme_dir = apply_filters( 'ahashop_shortcode_template_theme_dir', 'shortcodes/' );
	$plugin_path = AHASHOP_REQUIRED_PATH . 'templates/shortcodes/';

	$path = '';

	if ( locate_template( $theme_dir . $filename ) ) {
		$path = locate_template( $theme_dir . $filename );
	} elseif ( file_exists( $plugin_path . $filename ) ) {
		$path = $plugin_path . $filename;
	}

	return apply_filters( 'ahashop_shortcode_locate_template', $path, $filename );
}

/**
 * Load template.
 *
 * @param  string $filename Filename with extension.
 * @param  array  $data     Passed data.
 */
function ahashop_sc_load_template( $filename, $data = array() ) {
	$path = ahashop_sc_locate_template( $filename );

	if ( ! $path ) {
		return;
	}

	extract( $data );

	include $path;
}


/**
 * Extra class name and desgin option tabs.
 *
 * @return array
 */
function ahashop_sc_param_design_options() {
	return array(
		array(
			'type'        => 'textfield',
			'param_name'  => 'el_class',
			'heading'     => esc_html__( 'Extra class name', 'ahashop' ),
		),
		array(
			'type'        => 'css_editor',
			'param_name'  => 'css',
			'heading'     => esc_html__( 'CSS box', 'ahashop' ),
			'group'       => esc_html__( 'Design Options', 'ahashop' ),
		),
	);
}

/**
 * Align option values.
 *
 * @return array
 */
function ahashop_sc_param_align() {
	return array(
		__( 'Left', 'ahashop' )   => 'left',
		__( 'Center', 'ahashop' ) => 'center',
		__( 'Right', 'ahashop' )  => 'right',
	);
}
