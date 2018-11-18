<?php
/**
 * Template part for footer columns 5 columns
 *
 * @package Ahashop
 */

?>
<div class="container footer-columns-container">
	<div class="footer-widgets pb-mdm-20">
		<div class="row">

			<div class="col-md-2 col-sm-4 col-xs-6 col-xxs-12">
				<?php dynamic_sidebar( 'footer-column' ); ?>
			</div>

			<div class="col-md-2 col-sm-4 col-xs-6 col-xxs-12">
				<?php dynamic_sidebar( 'footer-column-2' ); ?>
			</div>

			<div class="col-md-2 col-sm-4 col-xs-6 col-xxs-12">
				<?php dynamic_sidebar( 'footer-column-3' ); ?>
			</div>

			<div class="col-md-3 col-sm-6 col-xs-6">
				<?php dynamic_sidebar( 'footer-column-4' ); ?>
			</div>

			<div class="col-md-3 col-sm-6 col-xs-6">
				<?php dynamic_sidebar( 'footer-column-5' ); ?>
			</div> <!-- end stay in touch -->

		</div>
	</div>
</div> <!-- end container -->
