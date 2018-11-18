<?php
/**
 * Sidebar shop template
 *
 * @package Ahashop
 */

if ( Ahashop_Sidebar::is_no_sidebar() ) {
	return;
}

if ( ! is_active_sidebar( 'shop-sidebar' ) ) {
	return;
}
?>
<!-- Sidebar -->
<aside id="secondary" class="widget-area sidebar" role="complementary">
	<?php dynamic_sidebar( 'shop-sidebar' ); ?>
</aside> <!-- end sidebar -->
