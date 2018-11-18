<?php
/**
 * Template for shortcode [ahashop_accordion]
 *
 * @package Ahashop
 * @var array  $atts
 * @var array  $items
 * @var string $el_class
 * @var int    $unique_id
 */

?>
<div class="panel-group accordion <?php echo esc_attr( $el_class ); ?>" id="accordion-<?php echo esc_attr( $unique_id ); ?>">
	<?php
	$index = 0;
	foreach ( $items as $item ) :
		if ( $index ) {
			$button = 'plus';
			$panel_class = '';
		} else {
			$button = 'minus';
			$panel_class = 'in';
		}

		$index++;
		?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<a data-toggle="collapse" data-parent="#accordion-<?php echo esc_attr( $unique_id ); ?>" href="#accordion-collapse-<?php echo esc_attr( $unique_id ); ?>-<?php echo intval( $index ) ?>" class="<?php echo esc_attr( $button ); ?>"><?php echo esc_html( $item['title'] ); ?><span>&nbsp;</span>
				</a>
			</div>

			<div id="accordion-collapse-<?php echo esc_attr( $unique_id ); ?>-<?php echo intval( $index ) ?>" class="panel-collapse collapse <?php echo esc_attr( $panel_class ); ?>">
				<div class="panel-body">
					<?php echo wp_kses_post( $item['content'] ); ?>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>
