<?php
/**
 * Template for shortcode [ahashop_statistic]
 *
 * @package Ahashop
 * @var array  $atts
 * @var string $el_class
 */

?>
<div class="statistic <?php echo esc_attr( $el_class ); ?>">
	<span class="statistic__title"><?php echo esc_html( $atts['title'] ); ?></span>

	<?php if ( $atts['desc'] ) : ?>
		<div class="statistic__desc"><?php echo esc_html( $atts['desc'] ); ?></div>
	<?php endif; ?>
</div>
