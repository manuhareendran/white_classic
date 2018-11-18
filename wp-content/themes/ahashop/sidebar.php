<?php
/**
 * Sidebar template
 *
 * @package Ahashop
 */

if ( Ahashop_Sidebar::is_no_sidebar() ) {
	return;
}

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<!-- Sidebar -->
<aside id="secondary" class="widget-area sidebar" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside> <!-- end sidebar -->
