<?php
/**
 * Abstract class shortcode
 *
 * @package Ahashop
 */

/**
 * Class Ahashop_Shortcode
 *
 * @abstract
 */
abstract class Ahashop_Shortcode extends WPBakeryShortCode {

	/**
	 * Get shortcode name.
	 *
	 * @return string
	 * @abstract
	 */
	abstract public function get_name();

	/**
	 * Get shortcode icon url.
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'icon-element';
	}

	/**
	 * Get shortcode category.
	 *
	 * @return string Category name.
	 */
	public function get_category() {
		return esc_html__( 'Ahashop', 'ahashop' );
	}
}
