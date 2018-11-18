<?php
/**
 * Single template
 *
 * @package Ahashop
 */

get_header();
?>

	<!-- content -->
	<div class="post-content mb-50" id="main" role="main">

		<?php do_action( 'ahashop_before_single' ); ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/loop/content', 'single' ); ?>

		<?php endwhile; ?>

		<?php
		/**
		 * Hook ahashop_after_single
		 *
		 * @hooked ahashop_after_single() - 10
		 */
		do_action( 'ahashop_after_single' );
		?>

	</div> <!-- end col -->

<?php
get_sidebar();
get_footer();
