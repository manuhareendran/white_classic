<?php
/**
 * Template part for header mini cart
 *
 * @package Ahashop
 */

?>
<div class="nav-cart-hover">
	<div class="nav-cart right">
		<div class="nav-cart-outer">
			<div class="nav-cart-inner">
				<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="nav-cart-icon"><?php echo absint( WC()->cart->get_cart_contents_count() ); ?></a>
			</div>
		</div>

		<div class="nav-cart-container">
			<?php //woocommerce_mini_cart(); ?>
            <?php if (class_exists('ahashop_WC_Widget_Cart')) {
                the_widget('ahashop_WC_Widget_Cart');
            } ?>
		</div>
	</div>
	<div class="menu-cart-amount right">
		<a href="<?php echo esc_url( wc_get_cart_url() ); ?>">
			<span>
				<?php
				printf(
					/* translators: cart total */
					esc_html__( 'Cart / %s', 'ahashop' ),
					wp_kses( WC()->cart->get_cart_total(), array() )
				);
				?>
			</span>
		</a>
	</div>
</div>
