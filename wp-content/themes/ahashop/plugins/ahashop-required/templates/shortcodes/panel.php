<?php
/**
 * Template for shortcode [ahashop_panel]
 *
 * @package Ahashop
 * @var array  $atts
 * @var string $content
 * @var string $el_class
 */

?>
<div class="toggle <?php echo esc_attr( $el_class ); ?>">
	<div class="acc-panel">
		<a href="#"><?php echo esc_html( $atts['title'] ); ?></a>
	</div>

	<div class="panel-content">
		<?php echo wp_kses_post( $content ); ?>
	</div>
</div>
