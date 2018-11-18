<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ahashop_WC_Widget_Cart extends WC_Widget {

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->widget_cssclass    = 'woocommerce widget_shopping_cart';
		$this->widget_description =  esc_html__( "Display the user's Cart in the sidebar.", 'zenna' );
		$this->widget_id          = 'woocommerce_widget_cart';
		$this->widget_name        =  esc_html__( 'WooCommerce Cart', 'zenna' );
		$this->settings           = array(
			'title'  => array(
				'type'  => 'text',
				'std'   =>  esc_html__( 'Cart', 'zenna' ),
				'label' =>  esc_html__( 'Title', 'zenna' )
			),
			'hide_if_empty' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' =>  esc_html__( 'Hide if cart is empty', 'zenna' )
			)
		);

		parent::__construct();
	}

	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 *
	 * @param array $zenna_args
	 * @param array $zenna_instance
	 */
	public function widget( $zenna_args, $zenna_instance ) {

//		if ( apply_filters( 'woocommerce_widget_cart_is_hidden', is_cart() || is_checkout() ) ) {
//			return;
//		}

		$zenna_hide_if_empty = empty( $zenna_instance['hide_if_empty'] ) ? 0 : 1;

		$this->widget_start( $zenna_args, $zenna_instance );

		if ( $zenna_hide_if_empty ) {
			echo '<div class="hide_cart_widget_if_empty">';
		}

		// Insert cart widget placeholder - code in woocommerce.js will update this on page load
		echo '<div class="widget_shopping_cart_content"></div>';

		if ( $zenna_hide_if_empty ) {
			echo '</div>';
		}

		$this->widget_end( $zenna_args );
	}
}
