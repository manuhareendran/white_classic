<?php
/**
 * Template for search page
 *
 * @package Ahashop
 */

get_header();
?>

	<div class="post-content mb-50" id="main" role="main">

		<h1 class="archive-title">
			<?php printf( esc_html__( 'Search results for: %s', 'ahashop' ), esc_html( get_search_query() ) ); ?>
		</h1>

		<?php
		if ( have_posts() ) :

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/loop/content', 'search' );

			endwhile;

			ahashop_pagination();

		else :

			get_template_part( 'template-parts/loop/content', 'none' );

		endif;
		?>

	</div> <!-- end col -->

<?php
get_sidebar();
get_footer();
