<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;

$attachment_ids = ahashop_get_product_carousel_image_ids();

if ( ! $attachment_ids ) {
	return;
}
?>
<div class="images">
	<div class="flickity flickity-slider-wrap mfp-hover" id="gallery-main">

		<?php foreach ( $attachment_ids as $attachment_id ) : ?>

			<div class="gallery-cell" data-id="<?php echo intval( $attachment_id ) ?>">
				<a href="<?php echo esc_url( wp_get_attachment_image_url( $attachment_id, 'full' ) ); ?>" class="lightbox-img woocommerce-main-image">
					<?php echo wp_get_attachment_image( $attachment_id, 'shop_single' ); ?>
					<i class="icon arrow_expand"></i>
				</a>
			</div>

		<?php endforeach; ?>

	</div> <!-- end gallery main -->

	<?php do_action( 'woocommerce_product_thumbnails' ); ?>
</div>
