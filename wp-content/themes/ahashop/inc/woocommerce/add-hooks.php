<?php
/**
 * WooCommerce add hooks
 *
 * @package Ahashop
 */

/* Archive product */
add_action( 'woocommerce_archive_description', 'ahashop_wc_product_category_banner', 10 );

add_action( 'woocommerce_after_shop_loop', 'ahashop_wc_archive_product_pagination_wrap_open', 6 );

add_action( 'woocommerce_after_shop_loop', 'woocommerce_result_count', 8 );

add_action( 'woocommerce_after_shop_loop', 'ahashop_wc_archive_product_pagination_wrap_close', 12 );

/* Content product */
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 5 );

add_action( 'woocommerce_before_shop_loop_item_title', 'ahashop_wc_template_loop_second_product_thumbnail', 10 );

add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 20 );

add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 30 );

add_action( 'woocommerce_before_shop_loop_item_title', 'ahashop_wc_template_loop_product_stock', 30 );

add_action( 'woocommerce_before_shop_loop_item_title', 'ahashop_wc_template_loop_product_actions', 40 );

add_action( 'woocommerce_share', 'ahashop_entry_sharing' );
