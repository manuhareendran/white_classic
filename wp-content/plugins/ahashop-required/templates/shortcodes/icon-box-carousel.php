<?php
/**
 * Template for shortcode [ahashop_icon_box_carousel]
 *
 * @package Ahashop
 * @var array  $atts
 * @var array  $slides
 * @var string $el_class
 */

?>
<div class="icon-box-carousel <?php echo esc_attr( $el_class ); ?>">
	<ul class="slides clearfix">
		<?php foreach ( $slides as $slide ) :
			if ( empty( $slide['icon'] ) ) {
				continue;
			}
			$icon_class = 'service-item-box';
			if ( 'vertical' === $slide['layout'] ) {
				$icon_class .= ' style-2';
			}
			?>
			<li>
				<div class="<?php echo esc_attr( $icon_class ); ?>">
					<div class="icon-holder">
						<i class="<?php echo esc_attr( $slide['icon'] ); ?>"></i>
					</div>

					<div class="service-text">
						<?php if ( ! empty( $slide['title'] ) ) : ?>
							<h3><?php echo esc_html( $slide['title'] ); ?></h3>
						<?php endif; ?>

						<?php if ( ! empty( $slide['desc'] ) ) : ?>
							<p><?php echo esc_html( $slide['desc'] ); ?></p>
						<?php endif; ?>
					</div>
				</div>
			</li>
		<?php endforeach; ?>
	</ul>
</div> <!-- end slider -->
