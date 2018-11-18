<?php
/**
 * Template for shortcode [ahashop_testimonials]
 *
 * @package Ahashop
 * @var array  $atts
 * @var array  $testimonials
 * @var string $el_class
 */

?>
<div class="owl-testimonials testimonials owl-carousel owl-theme owl-dark-dots text-center <?php echo esc_attr( $el_class ); ?>">

	<?php foreach ( $testimonials as $testi ) :
		if ( empty( $testi['content'] ) ) {
			continue;
		}
		?>
		<div class="item">
			<div class="testimonial">
				<div class="testimonial-text"><?php echo wp_kses_post( $testi['content'] ); ?></div>

				<?php if ( ! empty( $testi['name'] ) ) : ?>
					<span><?php echo esc_html( $testi['name'] ); ?></span>
				<?php endif; ?>
			</div>
		</div>
	<?php endforeach; ?>

</div>
