<?php
/**
 * Template part for search form
 *
 * @package Ahashop
 */

?>
<form class="relative" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" name="s" class="searchbox mb-0" placeholder="<?php esc_attr_e( 'Search', 'ahashop' ); ?>" value="<?php the_search_query(); ?>">
	<button type="submit" class="search-button"><i class="icon icon_search"></i></button>
</form>
