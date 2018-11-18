<?php
/**
 * Template for shortcode [ahashop_slider]
 *
 * @package Ahashop
 * @var array  $atts
 * @var array  $slides
 * @var string $el_class
 */

?>
<div class="entry-slider <?php echo esc_attr( $el_class ); ?>">
	<div class="flexslider flexslider-hero">
		<ul class="slides clearfix">
			<?php foreach ( $slides as $slide ) :
				if ( empty( $slide['image'] ) ) {
					continue;
				}

				$title_size = ! empty( $slide['title_size'] ) ? 'style="font-size: ' . $slide['title_size'] . 'px;"' : '';

				if ( ! empty( $slide['btn'] ) ) {
					$btn = vc_build_link( $slide['btn'] );
				}
				?>
				<li>
					<?php echo wp_get_attachment_image( $slide['image'], 'full' ); ?>
					<div class="img-holder" style="background-image: url(<?php echo esc_url( wp_get_attachment_image_url( $slide['image'], 'full' ) ); ?>);"></div>

					<div class="hero-holder text-<?php echo esc_attr( $slide['text_align'] ); ?> <?php echo esc_attr( $slide['position'] ); ?>-align">
						<div class="hero-lines">
							<?php if ( ! empty( $slide['title'] ) ) : ?>
								<h1 class="hero-heading white" <?php print $title_size; // WPCS: xss ok. ?>><?php echo esc_html( $slide['title'] ); ?></h1>
							<?php endif; ?>

							<?php if ( ! empty( $slide['subtitle'] ) ) : ?>
								<h4 class="hero-subheading white"><?php echo esc_html( $slide['subtitle'] ); ?></h4>
							<?php endif; ?>

							<?php if ( ! empty( $slide['desc'] ) ) : ?>
								<div class="hero-desc white">
									<?php echo wp_kses_post( wpautop( $slide['desc'] ) ); ?>
								</div>
							<?php endif; ?>
						</div>

						<?php
						if ( ! empty( $btn['title'] ) ) {
							printf(
								'<a href="%1$s" class="btn btn-lg btn-white"%2$s%3$s><span>%4$s</span></a>',
								esc_url( $btn['url'] ),
								$btn['rel'] ? ' rel="' . esc_attr( trim( $btn['rel'] ) ) . '"' : '',
								$btn['target'] ? ' target="' . esc_attr( trim( $btn['target'] ) ) . '"' : '',
								esc_html( $btn['title'] )
							);
						}
						?>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div> <!-- end slider -->
