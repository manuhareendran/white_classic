<?php
/**
 * Site footer template
 *
 * @package Ahashop
 */

?>

	<?php if ( ! is_404() ) : ?>
				</div> <!-- end row -->
			</div> <!-- end container -->
		</section> <!-- end blog standard -->
	<?php endif; ?>

	<!-- Footer Type-1 -->
	<footer class="footer footer-type-1 bg-white">
		<?php
		/**
		 * Hook ahashop_footer_top
		 *
		 * @hooked ahashop_footer_columns() - 10
		 */
		do_action( 'ahashop_footer_top' );
		?>

		<?php get_template_part( 'template-parts/footer/footer-text' ); ?>

		<?php
		/**
		 * Hook ahashop_footer
		 */
		do_action( 'ahashop_footer' );
		?>
	</footer> <!-- end footer -->

	<?php
	/**
	 * Hook ahashop_site_wrapper_end
	 */
	do_action( 'ahashop_site_wrapper_end' );
	?>

</main> <!-- end main wrapper -->


<?php wp_footer(); ?>

</body>
</html>
