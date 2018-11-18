<?php
/**
 * Template for shortcode [ahashop_button]
 *
 * @package Ahashop
 * @var array  $atts
 * @var array  $link
 * @var string $el_class
 */

printf(
	'<a href="%1$s" class="btn %2$s" title="%3$s"%4$s%5$s>',
	$link['url'] ? esc_url( $link['url'] ) : '#',
	esc_attr( $el_class ),
	esc_attr( $link['title'] ),
	$link['target'] ? ' target="' . esc_attr( trim( $link['target'] ) ) . '"' : '',
	$link['rel'] ? ' rel="' . esc_attr( trim( $link['rel'] ) ) . '"' : ''
);
?>
	<span><?php echo esc_html( $atts['label'] ); ?></span>
</a>
