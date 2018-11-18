<?php
/**
 * Template for shortcode [ahashop_partners]
 *
 * @package Ahashop
 * @var array  $atts
 * @var array  $partners
 * @var string $el_class
 */

?>
<div class="row <?php echo esc_attr( $el_class ); ?>">

	<div class="owl-partners partners owl-carousel owl-theme">

		<?php foreach ( $partners as $partner ) :
			if ( empty( $partner['image'] ) ) {
				continue;
			}
			?>
			<div class="item">
				<?php if ( ! empty( $partner['url'] ) ) : ?>
					<a href="<?php echo esc_url( $partner['url'] ); ?>">
						<?php echo wp_get_attachment_image( $partner['image'], 'full' ); ?>
					</a>
				<?php else : ?>
					<?php echo wp_get_attachment_image( $partner['image'], 'full' ); ?>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>

	</div> <!-- end carousel -->

</div>
