<?php
/**
 * Template for shortcode [ahashop_icon_box]
 *
 * @package Ahashop
 * @var array  $atts
 * @var string $el_class
 */

?>
<div class="service-item-box <?php echo esc_attr( $el_class ); ?>">
	<?php if ( ! empty( $atts['icon'] ) ) : ?>
		<div class="icon-holder">
			<i class="<?php echo esc_attr( $atts['icon'] ); ?>"></i>
		</div>
	<?php endif; ?>

	<div class="service-text">
		<?php if ( ! empty( $atts['title'] ) ) : ?>
			<h3><?php echo esc_html( $atts['title'] ); ?></h3>
		<?php endif; ?>

		<?php if ( ! empty( $atts['desc'] ) ) : ?>
			<p><?php echo esc_html( $atts['desc'] ); ?></p>
		<?php endif; ?>
	</div>
</div>
