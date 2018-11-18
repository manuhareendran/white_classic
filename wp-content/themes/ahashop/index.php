<?php
/**
 * Template for index page
 *
 * @package Ahashop
 */

get_header();
?>

	<div class="post-content mb-50" id="main" role="main">

		<?php
		if ( have_posts() ) :

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/loop/content', get_post_format() );

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
