<?php
/**
 * Template part for header cart icon on mobile
 *
 * @package Ahashop
 */

?>
<!-- Mobile cart -->
<div class="nav-cart mobile-cart hidden-lg hidden-md">
	<div class="nav-cart-outer">
		<div class="nav-cart-inner">
			<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="nav-cart-icon"><?php echo absint( WC()->cart->get_cart_contents_count() ); ?></a>
		</div>
	</div>
</div>
