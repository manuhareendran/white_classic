<?php
/**
 * Template part for footer columns
 *
 * @package Ahashop
 */

$number = ahashop_option( 'footer_columns_number' );

if ( 6 == $number ) {
	$css_class = 'col-md-2 col-sm-4 col-xs-6';
} else {
	$css_class = sprintf(
		'col-sm-%d col-xs-6',
		intval( 12 / $number )
	);
}
?>
<div class="container footer-columns-container">
	<div class="footer-widgets pb-mdm-20">
		<div class="row">

			<?php for ( $i = 1; $i <= $number; $i++ ) : ?>
				<div class="<?php echo esc_attr( $css_class ); ?>">
					<?php
					if ( 1 === $i ) {
						dynamic_sidebar( 'footer-column' );
					} else {
						dynamic_sidebar( 'footer-column-' . $i );
					}
					?>
				</div>
			<?php endfor; ?>

		</div>
	</div>
</div> <!-- end container -->
