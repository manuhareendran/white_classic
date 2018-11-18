<?php
/**
 * Template for 404 page
 *
 * @package Ahashop
 */

get_header();
?>

	<!-- 404 -->
    <section class="section-wrap page-404">
		<div class="container">

			<div class="row text-center">
				<div class="col-md-6 col-md-offset-3">
					<h1><?php esc_html_e( '404', 'ahashop' ); ?></h1>

					<h2 class="mb-50"><?php esc_html_e( 'Page Not Found', 'ahashop' ); ?></h2>

					<p class="mb-20"><?php printf( esc_html__( 'You can go back to %s or use search', 'ahashop' ), '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Homepage', 'ahashop' ) . '</a>' ) ?></p>

					<?php get_search_form(); ?>
				</div>
			</div>

		</div>
	</section> <!-- end 404 -->

<?php
get_footer();
