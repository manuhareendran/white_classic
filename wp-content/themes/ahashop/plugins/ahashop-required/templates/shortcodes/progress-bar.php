<?php
/**
 * Template for shortcode [ahashop_progress_bar]
 *
 * @package Ahashop
 * @var array  $atts
 * @var string $el_class
 */

?>
<div class="progress-bars <?php echo esc_attr( $el_class ); ?>">
	<?php if ( $atts['title'] ) : ?>
		<h6><?php echo esc_html( $atts['title'] ); ?> <span><?php echo absint( $atts['value'] ); ?>%</span></h6>
	<?php endif; ?>

	<div class="progress meter">
		<div aria-valuemax="100" aria-valuemin="0" aria-valuenow="<?php echo absint( $atts['value'] ); ?>" class="progress-bar" role="progressbar">
			<span class="sr-only">
				<?php
				printf(
					esc_html__( '%s Complete', 'ahashop' ),
					absint( $atts['value'] ) . '%'
				);
				?>
			</span>
		</div>
	</div>
</div>
