<?php
/**
 * Template for shortcode [ahashop_newsletter]
 *
 * @package Ahashop
 * @var array  $atts
 * @var string $el_class
 */

?>
<div class="newsletter-box <?php echo esc_attr( $el_class ); ?>">
	<?php if ( $atts['title'] ) : ?>
		<h5><?php echo esc_html( $atts['title'] ); ?></h5>
	<?php endif; ?>

	<?php echo do_shortcode( $atts['form_sc'] ); // WPCS: xss ok. ?>
</div>
