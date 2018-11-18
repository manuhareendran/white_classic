<?php
/**
 * Template for shortcode [ahashop_banner]
 *
 * @package Ahashop
 * @var array  $atts
 * @var array  $link
 * @var string $el_class
 */

printf(
	'<a href="%1$s" class="collection-item %2$s" title="%3$s"%4$s%5$s>',
	$link['url'] ? esc_url( $link['url'] ) : '#',
	esc_attr( $el_class ),
	esc_attr( $link['title'] ),
	$link['target'] ? ' target="' . esc_attr( trim( $link['target'] ) ) . '"' : '',
	$link['rel'] ? ' rel="' . esc_attr( trim( $link['rel'] ) ) . '"' : ''
);
?>

	<?php echo wp_get_attachment_image( $atts['image'], 'full' ); ?>

	<div class="overlay"><h2><?php echo esc_html( $atts['text'] ); ?></h2></div>
</a>
