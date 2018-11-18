<?php
/**
 * Template part for footer text
 *
 * @package Ahashop
 */

?>
<div class="bottom-footer bg-white">
	<div class="container">
		<div class="footer-text">
			<div class="row">
				<div class="col-sm-6 copyright sm-text-center">
					<span>
						<?php ahashop_copyright(); ?>
					</span>
				</div>

				<div class="col-sm-6 col-xs-12 footer-text-right footer-payment-systems text-right sm-text-center mt-sml-10">
					<?php
					/**
					 * Hook ahashop_footer_text_right
					 *
					 * @hooked ahashop_footer_text_right() - 10
					 */
					do_action( 'ahashop_footer_text_right' );
					?>
				</div>
			</div>
		</div>
	</div>
</div> <!-- end bottom footer -->
