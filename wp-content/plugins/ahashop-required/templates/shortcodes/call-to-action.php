<?php
/**
 * Template for shortcode [ahashop_call_to_action]
 *
 * @package Ahashop
 * @var array  $atts
 * @var array  $link
 * @var string $el_class
 */

?>
<div class="call-to-action <?php echo esc_attr( $el_class ); ?>">
	<?php if ( ! empty( $atts['text'] ) ) : ?>
		<h5><?php echo esc_html( $atts['text'] ); ?></h5>
	<?php endif; ?>

	<?php if ( ! empty( $atts['btn_label'] ) ) : ?>

		<?php
		printf(
			'<a href="%1$s" class="btn btn-lg btn-color" title="%2$s"%3$s%4$s><span>%5$s</span></a>',
			$link['url'] ? esc_url( $link['url'] ) : '#',
			esc_attr( $link['title'] ),
			$link['target'] ? ' target="' . esc_attr( trim( $link['target'] ) ) . '"' : '',
			$link['rel'] ? ' rel="' . esc_attr( trim( $link['rel'] ) ) . '"' : '',
			esc_html( $atts['btn_label'] )
		);
		?>

	<?php endif; ?>
</div>
